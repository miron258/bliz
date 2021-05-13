<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Catalog;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CatalogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $catalogs = Catalog::get()->toTree();
        //Передаем в представление наш массив со страницами
        return view('auth.catalog.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $catalogs = Catalog::get()->toTree();
        return view('auth.catalog.form', compact('catalogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatalogRequest $request) {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();

        $catalog = new Catalog();
        $catalog->meta_tag_title = (empty($params['meta_tag_title'])) ? $params['name'] : $params['meta_tag_title'];
        $catalog->meta_tag_description = $params['meta_tag_description'];
        $catalog->meta_tag_keywords = $params['meta_tag_keywords'];
        $catalog->name = $params['name'];
        $catalog->url = $params['url'];
        $catalog->parent_id = ($params['parent_id'] == 0 || $params['parent_id'] == '') ? null : $params['parent_id'];
        $catalog->anons = $params['anons'];
        $catalog->description = $params['description'];
        $catalog->index = 1;
        $catalog->hidden = 1;
        $catalog->author = $user->name;
        $catalog->update_author = $user->name;


        if ($request->has('image')) {
            $path = $request->file('image')->store('catalogs');
            $catalog->img = $path;
        }

        //Fields Settings Catalog
        $catalog->position = $params['position'];
        $catalog->sort = $params['sort'];
        $catalog->sort_order = $params['sort_order'];
        $catalog->per_page = $params['per_page'];
        //End Fields Settings Catalog

        Catalog::fixTree();
        $catalog->save();
        return redirect()->route('catalog.create')->with('message', 'Каталог успешно создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog) {
        return view('auth.catalog.show', compact('catalog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $catalog) {
        $catalogs = Catalog::get()->toTree();
        return view('auth.catalog.form', compact('catalog', 'catalogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(CatalogRequest $request, Catalog $catalog) {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();
// Если получать в Facade то так $user = Auth::user();

        $id = $params['catalogId'];

//        dd($params['parent_id']);

        $catalog = Catalog::find($id);
        $catalog->meta_tag_title = (empty($params['meta_tag_title'])) ? $params['name'] : $params['meta_tag_title'];
        $catalog->meta_tag_description = $params['meta_tag_description'];
        $catalog->meta_tag_keywords = $params['meta_tag_keywords'];
        $catalog->name = $params['name'];
        $catalog->url = $params['url'];
        $catalog->anons = $params['anons'];
        $catalog->description = $params['description'];
        $catalog->index = $request->has('index');
        $catalog->hidden = $request->has('hidden');
        $catalog->author = $catalog->author;
        $catalog->update_author = $user->name;


        //Fields Settings Catalog
        $catalog->position = $params['position'];
        $catalog->sort = $params['sort'];
        $catalog->sort_order = $params['sort_order'];
        $catalog->per_page = $params['per_page'];
        //End Fields Settings Catalog

        if ($request->has('image')) {
            $isDelete = Storage::delete($catalog->img);
            $path = $request->file('image')->store('catalogs');
            $catalog->img = $path;
        }
        $catalog->parent_id = $params['parent_id'];
        Catalog::fixTree();
        $catalog->save();
        return redirect()->route('catalog.edit', $catalog->id)->with('message', 'Каталог ' . $catalog->name . ' успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog) {
        $catalog->delete();
        return redirect()->route('catalog.index')->with('message', 'Каталог ' . $catalog->name . ' успешно удален');
    }

}
