<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Material;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    //Page view Material
    public function index($url) {
        $material = Material::where('url', $url)->publish()->first(); //First значить возврать единственный элмент одну строку массива используется LIMIT
        if (is_null($material)) {
            return response()
                ->view(
                    'errors.404',
                    ['message' =>
                        'Ничего не найдено',
                        'meta_tag_title' => 'Ничего не найдено 404'],
                    404);
        } else {
            if (!empty($material->img)) {
                $materialImages = array();
                $materialImagesTemp = json_decode($material->img);
                foreach ($materialImagesTemp as $k => $v) {
                    $materialImages[$k]['title'] = $material->name;
                    $materialImages[$k]['url'] = route('material_site.index', $material->url);
                    $materialImages[$k]['imageUrl'] = Storage::url($v);
                }
                $materialImages = json_encode($materialImages);
            } else {
                $materialImages = "{}";
            }

            $category = Category::where('id', $material->id_category)->first(); //Получаем текущую категорию
            return view('material.index', compact('material', 'materialImages', 'category'));
        }
    }
}
