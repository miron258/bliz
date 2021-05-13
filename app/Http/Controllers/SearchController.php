<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Catalog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function index(Request $request) {

        //Поисковый запрос
        $query = $request->all()['query'];
      
        if (!empty($query)) {
            $products = Product::search($query)->paginate(6);

            if (is_null($products)) {
                return response()
                                ->view(
                                        'search.index',
                                        [
                                            'products' => $products,
                                            'message' => 'По вашему запросу ничего не найдено', 'meta_tag_title' => 'По вашему запросу ничего не найдено'
                                        ],
                                        200);
            } else {
                return view('search.index', compact('products'));
            }
        } else {
            return response()
                            ->view(
                                    'search.index',
                                    [
                                        'products' => '',
                                        'message' => 'По вашему запросу ничего не найдено', 'meta_tag_title' => 'По вашему запросу ничего не найдено'
                                    ],
                                    200);
        }
    }

}
