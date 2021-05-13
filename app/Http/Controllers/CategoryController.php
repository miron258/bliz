<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Material;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($url) {
        $category = Category::where('url', $url)->publish()->first(); //First значить возврать единственный элмент одну строку массива используется LIMIT
        if (is_null($category)) {
            return response()
                ->view(
                    'errors.404',
                    ['message' =>
                        'Ничего не найдено',
                        'meta_tag_title' => 'Ничего не найдено 404'],
                    404);
        } else {
                $materials = $category->materials()->publish()->paginate(30);


//                dd($materials);

                return view('category.index', compact('category', 'materials'));
        }
    }
}
