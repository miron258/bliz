<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Catalog;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller {

    public function index($url) {
        $catalog = Catalog::where('url', $url)->publish()->first(); //First значить возврать единственный элмент одну строку массива используется LIMIT
        if (is_null($catalog)) {
            return response()
                            ->view(
                                    'errors.404',
                                    ['message' =>
                                        'Ничего не найдено',
                                        'meta_tag_title' => 'Ничего не найдено 404'],
                                    404);
        } else {
            //Если каталог Родительский
            if (is_null($catalog->parent)) {
                $catalogs = $catalog->children;
                return view('catalog.index', compact('catalog', 'catalogs'));
            } else {
                $products = $catalog->products()->publish()->paginate(30);
                return view('catalog.index', compact('catalog', 'products'));
            }
        }
    }

}
