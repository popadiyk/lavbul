<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Manufacture;
use App\Product;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use HelperForImage;
use App\ProductPhoto;

class ProductsController extends Controller
{
    use BreadRelationshipParser;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('browse_'.$dataType->name);

        $getter = $dataType->server_side ? 'paginate' : 'get';

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            $relationships = $this->getRelationships($dataType);

            if ($model->timestamps) {
                $dataTypeContent = call_user_func([$model->with($relationships)->latest(), $getter]);
            } else {
                $dataTypeContent = call_user_func([
                    $model->with($relationships)->orderBy($model->getKeyName(), 'DESC'),
                    $getter,
                ]);
            }

            //Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        $view = 'admin.products.browse';

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));

    }

    public function edit(Request $request, $id)
    {
        $groups = Group::all();
        $manufactures = Manufacture::all();
        $slug = $this->getSlug($request);
        $supPhotos = Product::find($id)->images;

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('edit_'.$dataType->name);

        $relationships = $this->getRelationships($dataType);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? app($dataType->model_name)->with($relationships)->findOrFail($id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'admin.products.edit-add';
        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'groups', 'manufactures', 'supPhotos'));

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $groups = Group::all();
        $manufactures = Manufacture::all();
        $slug = $this->getSlug($request);
        $supPhotos = Product::find($id)->images;

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('read_'.$dataType->name);

        $relationships = $this->getRelationships($dataType);
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $dataTypeContent = call_user_func([$model->with($relationships), 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        //Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'admin.products.read';

        return view($view, compact('supPhotos','dataType', 'dataTypeContent', 'isModelTranslatable', 'groups', 'manufactures'));
    }

    public function store(Request $request)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        Voyager::canOrFail('add_'.$dataType->name);
        //Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);

        $this->validate($request, [
            'marking' => 'required|unique:products|max:255',
            'title' => 'unique:products'
        ]);
        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }
        // save in data base
        $newProduct = $request->all();
        $newProduct = new Product($newProduct);

        if (array_key_exists('main_photo', $request->all()) == true){
            $path = HelperForImage::storeImage($newProduct['main_photo'], $request['marking']);
            $newProduct['main_photo'] = $path;
        }
        $newProduct->save();

        if(array_key_exists('sup_photo_1', $request->all()) == true){
            $sup_photo_1 = new ProductPhoto();
            $path = HelperForImage::storeImage($request['sup_photo_1'], $newProduct['marking'].'(1)');
            $sup_photo_1['product_id'] = $newProduct->id;
            $sup_photo_1['path'] = $path;
            $sup_photo_1->save();
        }

        if(array_key_exists('sup_photo_2', $request->all()) == true){
            $sup_photo_2 = new ProductPhoto();
            $path = HelperForImage::storeImage($request['sup_photo_2'], $newProduct['marking'].'(2)');
            $sup_photo_2['product_id'] = $newProduct->id;
            $sup_photo_2['path'] = $path;
            $sup_photo_2->save();
        }

        return redirect()
            ->route('voyager.'.$dataType->slug.'.index')
            ->with([
                'message'    => "Зміни успішно збережені!",
                'alert-type' => 'success',
            ]);
    }

    /**
     * POST BR(E)AD
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        Voyager::canOrFail('edit_'.$dataType->name);
        //Validate fields with ajax

        $val = $this->validateBread($request->all(), $dataType->editRows);
        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }
        $this->validate($request, [
            'marking' => 'unique:products,marking,' . $id,
            'title' => 'unique:products,title,' . $id,
        ]);
        // save in data base
        $changedProduct = $request->all();
        $myProduct = Product::all()->where('id', $id)->first();
        $myPhotos = Product::find($id)->images;
        if ($myPhotos != null)
        if ($myPhotos->count() == 0){
            if(array_key_exists('sup_photo_1', $request->all()) == true){
                $sup_photo_1 = new ProductPhoto();
                $path = HelperForImage::storeImage($changedProduct['sup_photo_1'], $request['marking'].'(1)');
                $sup_photo_1['product_id'] = $id;
                $sup_photo_1['path'] = $path;
                $sup_photo_1->save();
            }

            if(array_key_exists('sup_photo_2', $request->all()) == true){
                $sup_photo_2 = new ProductPhoto();
                $path = HelperForImage::storeImage($changedProduct['sup_photo_2'], $request['marking'].'(2)');
                $sup_photo_2['product_id'] = $id;
                $sup_photo_2['path'] = $path;
                $sup_photo_2->save();
            }
        }
        if ($myPhotos != null)
        if ($myPhotos->count() == 1){
            if (HelperForImage::whatImage($myPhotos[0]['path']) == 1){
                if(array_key_exists('sup_photo_1', $request->all()) == true){
                    unlink(substr($myPhotos[0]['path'], 1));
                    $sup_photo_1 = $myPhotos[0];
                    $path = HelperForImage::storeImage($changedProduct['sup_photo_1'], $request['marking'].'(1)');
                    $sup_photo_1['product_id'] = $id;
                    $sup_photo_1['path'] = $path;
                    $sup_photo_1->save();
                }

                if(array_key_exists('sup_photo_2', $request->all()) == true){
                    $sup_photo_2 = new ProductPhoto();
                    $path = HelperForImage::storeImage($changedProduct['sup_photo_2'], $request['marking'].'(2)');
                    $sup_photo_2['product_id'] = $id;
                    $sup_photo_2['path'] = $path;
                    $sup_photo_2->save();
                }
            } else {
                if(array_key_exists('sup_photo_1', $request->all()) == true){
                    $sup_photo_1 = new ProductPhoto();
                    $path = HelperForImage::storeImage($changedProduct['sup_photo_1'], $request['marking'].'(1)');
                    $sup_photo_1['product_id'] = $id;
                    $sup_photo_1['path'] = $path;
                    $sup_photo_1->save();
                }

                if(array_key_exists('sup_photo_2', $request->all()) == true){
                    unlink(substr($myPhotos[1]['path'], 1));
                    $sup_photo_2 = $myPhotos[1];
                    $path = HelperForImage::storeImage($changedProduct['sup_photo_2'], $request['marking'].'(2)');
                    $sup_photo_2['product_id'] = $id;
                    $sup_photo_2['path'] = $path;
                    $sup_photo_2->save();
                }
            }
        }
        if ($myPhotos != null)
        if ($myPhotos->count() == 2){
            if(array_key_exists('sup_photo_1', $request->all()) == true){
                unlink(substr($myPhotos[0]['path'], 1));
                $sup_photo_1 = $myPhotos[0];
                $path = HelperForImage::storeImage($changedProduct['sup_photo_1'], $request['marking'].'(1)');
                $sup_photo_1['product_id'] = $id;
                $sup_photo_1['path'] = $path;
                $sup_photo_1->save();
            }
            if(array_key_exists('sup_photo_2', $request->all()) == true){
                unlink(substr($myPhotos[1]['path'], 1));
                $sup_photo_2 = $myPhotos[1];
                $path = HelperForImage::storeImage($changedProduct['sup_photo_2'], $request['marking'].'(2)');
                $sup_photo_2['product_id'] = $id;
                $sup_photo_2['path'] = $path;
                $sup_photo_2->save();
            }
        }

        if (array_key_exists('main_photo', $request->all()) == true){
            if ($myProduct['main_photo'] != '/products_photo/nophoto.jpg'){
                unlink(substr($myProduct['main_photo'], 1));
            }
            $path = HelperForImage::storeImage($changedProduct['main_photo'], $request['marking']);
            $changedProduct['main_photo'] = $path;
        }
        $myProduct->update($changedProduct);

        return redirect()
            ->route('voyager.'.$dataType->slug.'.index')
            ->with([
                'message'    => "Зміни успішно збережені!",
                'alert-type' => 'success',
            ])->with('thread_cookie_test', true);
    }

    /**
     * Add a new item of our Data Type BRE(A)D
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $groups = Group::all();
        $manufactures = Manufacture::all();
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('add_'.$dataType->name);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? new $dataType->model_name()
            : false;

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'admin.products.edit-add';

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'groups', 'manufactures'));
    }

    /**
     * Delete an item BREA(D)
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        Voyager::canOrFail('delete_'.$dataType->name);
        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        // Delete Translations, if present
        if (is_bread_translatable($data)) {
            $data->deleteAttributeTranslations($data->getTranslatableAttributes());
        }
        foreach ($dataType->deleteRows as $row) {
            if ($row->type == 'image') {
                $this->deleteFileIfExists('/uploads/'.$data->{$row->field});
                $options = json_decode($row->details);
                if (isset($options->thumbnails)) {
                    foreach ($options->thumbnails as $thumbnail) {
                        $ext = explode('.', $data->{$row->field});
                        $extension = '.'.$ext[count($ext) - 1];
                        $path = str_replace($extension, '', $data->{$row->field});
                        $thumb_name = $thumbnail->name;
                        $this->deleteFileIfExists('/uploads/'.$path.'-'.$thumb_name.$extension);
                    }
                }
            }
        }
        $data = $data->destroy($id)
            ? [
                'message'    => "Успішно видалено із {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => "Вибачте але є деякі проблеми з видаленням з {$dataType->display_name_singular}",
                'alert-type' => 'error',
            ];
        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }

}
