<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CategoryController as Category;
use App\Models\Admin\Material;
use App\Models\Admin\Category as CategoryModel;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MaterialRequest as MaterialRequest;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller {

    public function __construct() {
        //Подключение модели продукта
        $this->material = new Material;
    }

    //AJAX QUERY

    public function tableMaterials() {
        return view('auth.material.table');
    }

    public function getMaterials(Request $request) {

        $numPage = $request->input('page'); //Номер страницы
        $idCategory = $request->input('idCategory');
        $name = $request->input('name');

        return $materials = $this->material->getAllMaterials(100, $idCategory, $name);
    }

    public function index() {
        $categories = CategoryModel::get()->toTree();
        $materials = $this->material->getAllMaterials();
        //Передаем в представление наш массив со страницами
        return view('auth.material.index', compact('materials', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = CategoryModel::get()->toTree();
        return view('auth.material.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialRequest $request) {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();

        $material = new Material();
        $material->meta_tag_title = (empty($params['meta_tag_title'])) ? $params['name'] : $params['meta_tag_title'];
        $material->meta_tag_description = $params['meta_tag_description'];
        $material->meta_tag_keywords = $params['meta_tag_keywords'];
        $material->name = $params['name'];
        $material->url = $params['url'];
        $material->id_category = $params['id_category'];
        $material->anons = $params['anons'];
        $material->description = $params['description'];
        $material->video = $params['video'];
        $material->properties = isset($params['properties']) ? $params['properties'] : '';

        $material->index = 1;
        $material->hidden = 1;
        $material->author = $user->name;
        $material->update_author = $user->name;

        $images = array();

        if ($files = $request->file('images')) {
            foreach ($files as $index => $file) {
                $path = $request->images[$index]->store('materials');
                $images[$index] = $path;
            }

            /* Insert your data array images to json */
            $material->img = json_encode($images);
        }

        $material->save();
        return redirect()->route('material.create')->with('message', 'Материал успешно создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material) {
        return view('auth.material.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material) {
        $categories = CategoryModel::get()->toTree();

        if (!empty($material->img)) {
            $materialImages = json_decode($material->img);
        } else {
            $materialImages = array();
        }
        return view('auth.material.form', compact('material', 'categories', 'materialImages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialRequest $request, Material $material) {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();

        $id = $params['materialId'];
        $material = material::find($id);

        $material->meta_tag_title = (empty($params['meta_tag_title'])) ? $params['name'] : $params['meta_tag_title'];
        $material->meta_tag_description = $params['meta_tag_description'];
        $material->meta_tag_keywords = $params['meta_tag_keywords'];
        $material->name = $params['name'];
        $material->url = $params['url'];
        $material->id_category = ($params['id_category'] == 0 || $params['id_category'] == '') ? null : $params['id_category'];
        $material->anons = $params['anons'];
        $material->description = $params['description'];
        $material->video = $params['video'];
        $material->properties = isset($params['properties']) ? $params['properties'] : '';


        $material->index = $request->has('index');
        $material->hidden = $request->has('hidden');
        $material->author = $material->author;
        $material->update_author = $user->name;

        $images = array();

        if ($files = $request->file('images')) {
            //Удаляем все старые изображения товара
            if (!empty($material->img)) {
                $old_images = json_decode($material->img);
                if (is_array($old_images)) {
                    foreach ($old_images as $index => $img) {
                        $isDelete = Storage::delete($img);
                    }
                }
            }

            foreach ($files as $index => $file) {
                $path = $request->images[$index]->store('materials');
                $images[$index] = $path;
            }

            /* Insert your data array images to json */
            $material->img = json_encode($images);
        }

        $material->save();
        return redirect()->route('material.edit', $material->id)->with('message', 'Материал ' . $material->name . ' успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids) {
        if ($ids && !empty($ids)) {
            $ids = explode(",", $ids);
            Material::find($ids)->each(function ($material, $key) {
//Удаляем сам материал
                $material->delete();
            });

            $materials = $this->material->getAllMaterials();
            return response()->json([
                        'success' => true,
                        'materials' => $materials,
                        'message' => '<div class="alert alert-success">Материал(ы) успешно удалены</div>',
                            ], 200);
        } else {
            return response()->json([
                        'success' => false,
                        'message' => '<div class="alert alert-danger">Не удалось удалить материал(ы)</div>',
                            ], 500);
        }
    }

}
