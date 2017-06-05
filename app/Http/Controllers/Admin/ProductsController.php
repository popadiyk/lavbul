<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Manufacture;
use App\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Tests\Bundle\NamedBundle;
use TCG\Voyager\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use Carbon\Carbon;

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
        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'groups', 'manufactures'));

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

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'groups', 'manufactures'));
    }

    public function store(Request $request)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        Voyager::canOrFail('add_'.$dataType->name);
        //Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);
        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }
        // save in data base
        $newProduct = $request->all();
        $newProduct = new Product($newProduct);
        $newProduct['main_photo']->move('products_photo', $newProduct['marking'].'.jpg');
        $newProduct['main_photo'] = '/products_photo/'.$newProduct['marking'].'.jpg';
        $newProduct->save();

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

        // save in data base
        $changedProduct = $request->all();
        $newProduct = Product::all()->where('id', $id)->first();
        if( $request->hasFile('main_photo')) {
            $changedProduct['main_photo']->move('products_photo', $request['marking'] . '.jpg');
            $changedProduct['main_photo'] = '/products_photo/' . $request['marking'] . '.jpg';
        }
        $newProduct->update($changedProduct);

        return redirect()
            ->route('voyager.'.$dataType->slug.'.index')
            ->with([
                'message'    => "Зміни успішно збережені!",
                'alert-type' => 'success',
            ]);
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
