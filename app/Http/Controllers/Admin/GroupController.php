<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use Carbon\Carbon;
use HelperForImage;

class GroupController extends Controller
{
    use BreadRelationshipParser;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $groups = new Group;
        $rootCategories = $groups->rootCategories();
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
        $view = 'voyager::bread.browse';
        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return view('admin.groups.browse', compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'groups', 'rootCategories'));

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $groups = Group::all();
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
        $view = 'voyager::bread.edit-add';
        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }
        return view('admin.groups.edit-add', compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'groups'));
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
        $group = Group::all()->where('id', $id)->first();
        $group->timestamps = false;
        $groupForm = $request->except(['_token', 'OK']);

        //dd($groupForm);
        $group['title'] = $groupForm['title'];
        $group['group_id'] = $groupForm['parent_id'];
        $group['meta_title'] = $groupForm['meta_title'];
        $group['meta_keyword'] = $groupForm['meta_keyword'];

        if (isset($request->all()['main_photo'])) {
            $image = $request->all()['main_photo'];
            // сохраняем фото
            HelperForImage::groupImage($image, $id);
        }


        $group->save();

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
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        Voyager::canOrFail('add_'.$dataType->name);
        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? new $dataType->model_name()
            : false;
        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);
        return view('admin.groups.edit-add', compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'groups'));
    }
    // POST BRE(A)D
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
        $formgroup = $request->except(['_token', 'OK']);

        DB::table('groups')->insert([
            'title' => $formgroup['title'],
            'group_id' => $formgroup['parent_id'],
            'meta_title' => $formgroup['meta_title'],
            'meta_keyword' => $formgroup['meta_keyword'],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        $groups = Group::all();
        return redirect()
            ->route('voyager.'.$dataType->slug.'.index', compact('groups'))
            ->with([
                'message'    => "Зміни успішно збережені!",
                'alert-type' => 'success',
            ]);
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
