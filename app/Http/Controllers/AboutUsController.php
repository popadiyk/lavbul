<?php

namespace App\Http\Controllers;

use App\AboutUs;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

class AboutUsController extends Controller
{
    use BreadRelationshipParser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $aboutus = AboutUs::all();
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


        return view('admin.aboutus.browse', compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'aboutus'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $aboutus = AboutUs::all()->where('id',1)->first();
        $aboutusform = $request->except(['_token', 'OK']);
        if( $request->hasFile('max_logo')) {
            $file = $request->file('max_logo');
            $file->move('img', $file->getClientOriginalName());
            $aboutus['max_log'] = '/img/'.$file->getClientOriginalName();
        }
        if( $request->hasFile('min_logo')) {
            $file = $request->file('min_logo');
            $file->move('img', $file->getClientOriginalName());
            $aboutus['min_logo'] = '/img/'.$file->getClientOriginalName();
        }

        $aboutus['name'] = $aboutusform['name'];
        $aboutus['description'] = $aboutusform['description'];
        $aboutus['full_description'] = $aboutusform['full_description'];
        $aboutus->save();

        return redirect()
            ->route('voyager.'.$dataType->slug.'.index', compact('aboutus'))
            ->with([
                'message'    => "Зміни успішно збережені!",
                'alert-type' => 'success',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $aboutus = AboutUs::all();
        // GET THE SLUG, ex. 'posts', 'pages', etc.
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
        return view('admin.aboutus.edit-add', compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'aboutus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutUs $aboutUs)
    {
        //
    }
}
