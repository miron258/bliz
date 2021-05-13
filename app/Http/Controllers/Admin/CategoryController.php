<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = Category::get()->toTree();
        //Передаем в представление наш массив со страницами
        return view('auth.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::get()->toTree();
        return view('auth.category.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request) {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();

        $category = new Category();
        $category->meta_tag_title = (empty($params['meta_tag_title'])) ? $params['name'] : $params['meta_tag_title'];
        $category->meta_tag_description = $params['meta_tag_description'];
        $category->meta_tag_keywords = $params['meta_tag_keywords'];
        $category->name = $params['name'];
        $category->url = $params['url'];
        $category->parent_id = ($params['parent_id'] == 0 || $params['parent_id'] == '') ? null : $params['parent_id'];
        $category->anons = $params['anons'];
        $category->description = $params['description'];
        $category->index = 1;
        $category->hidden = 1;
        $category->author = $user->name;
        $category->update_author = $user->name;

        if ($request->has('image')) {
            $path = $request->file('image')->store('categories');
            $category->img = $path;
        }

        //Fields Settings Category
        $category->position = $params['position'];
        $category->sort = $params['sort'];
        $category->sort_order = $params['sort_order'];
        $category->per_page = $params['per_page'];
        //End Fields Settings Category

        Category::fixTree();
        $category->save();
        return redirect()->route('category.create')->with('message', 'Категория успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category) {
        return view('auth.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category) {
        $categories = Category::get()->toTree();
        return view('auth.category.form', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category) {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();

        $id = $params['categoryId'];

        $category = Category::find($id);
        $category->meta_tag_title = (empty($params['meta_tag_title'])) ? $params['name'] : $params['meta_tag_title'];
        $category->meta_tag_description = $params['meta_tag_description'];
        $category->meta_tag_keywords = $params['meta_tag_keywords'];
        $category->name = $params['name'];
        $category->url = $params['url'];
        $category->anons = $params['anons'];
        $category->parent_id = ($params['parent_id'] == 0 || $params['parent_id'] == '') ? null : $params['parent_id'];
        $category->description = $params['description'];
        $category->index = $request->has('index');
        $category->hidden = $request->has('hidden');
        $category->author = $category->author;
        $category->update_author = $user->name;

        //Fields Settings Catalog
        $category->position = $params['position'];
        $category->sort = $params['sort'];
        $category->sort_order = $params['sort_order'];
        $category->per_page = $params['per_page'];
        //End Fields Settings Catalog

        if ($request->has('image')) {
            $isDelete = Storage::delete($category->img);
            $path = $request->file('image')->store('categories');
            $category->img = $path;
        }
        Category::fixTree();
        $category->save();
        return redirect()->route('category.edit', $category->id)->with('message', 'Категория ' . $category->name . ' успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('category.index')->with('message', 'Категория ' . $category->name . ' успешно удалена');
    }

}
