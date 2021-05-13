<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Catalog;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller {

    //Page view Product
    public function index($url) {
        $product = Product::where('url', $url)->publish()->first(); //First значить возврать единственный элмент одну строку массива используется LIMIT
        if (is_null($product)) {
            return response()
                            ->view(
                                    'errors.404',
                                    ['message' =>
                                        'Ничего не найдено',
                                        'meta_tag_title' => 'Ничего не найдено 404'],
                                    404);
        } else {
            if (!empty($product->img)) {
                $productImages = array();
                $productImagesTemp = json_decode($product->img);
                foreach ($productImagesTemp as $k => $v) {
                    $productImages[$k]['title'] = $product->name;
                    $productImages[$k]['url'] = route('product_site.index', $product->url);
                    $productImages[$k]['imageUrl'] = Storage::url($v);
                }
                $productImages = json_encode($productImages);
            } else {
                $productImages = "{}";
            }


            //Вытыскиваем Каталог Запчастей и всех его потомков
            $catalogs = Catalog::where('parent_id', 6)->get(); //Вытаскиваем все дочерние каталоги Каталога Запчастей
            $catalog = Catalog::where('id', $product->id_catalog)->first(); //Получаем текущий каталог
            $products = $catalog->products; //Получаем все продукты этого каталога
            return view('product.index', compact('product', 'catalogs', 'products', 'productImages'));
        }
    }

}
