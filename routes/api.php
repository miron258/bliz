<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\API\Admin\MenuItems;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(
    [
//            'middleware' => 'auth:api',
        'prefix' => 'v1',
        'namespace' => 'API'
    ],
    function () {

/// TABLE PRODUCTS
//    Route::get('admin/table_products', 'Admin\ProductController@tableProducts');


        Route::apiResource('menuitems', 'Admin\MenuItemsController');
        Route::get('listitems/{idMenu}', 'Admin\MenuItemsController@listItems')->name('menuitems.list');
        Route::get('listitemsexclude/{idMenu}/{idItem}', 'Admin\MenuItemsController@listItemsExclude')->name('menuitemsexclude.list');

        //Получить список всех отзывов
        Route::get('reviews', 'Admin\ReviewController@getReviews')->name('reviews.list');

        //MENU ITEMS
        Route::get('menu_items', function () {
            return view('auth.menuitems.index');
        })->name('menitems.index');

        Route::get('menu_items_select_options', function () {
            return view('auth.menuitems.select_options_menu_items');
        })->name('menitemsselectoptions.index');

        //MENU ITEM SELECT OPTIONS
        Route::get('menu_items_form', function () {
            return view('auth.menuitems.form');
        })->name('menitems.form');

        Route::get('menu_items_nodes', function () {
            return view('auth.menuitems.nodes_renderer');
        })->name('menitems.nodes');


        //List Route For Upload Img Gallery
        Route::get('galleryimages', function () {
            return view('auth.galleryimgs.list-imgs');
        })->name('gallery.images');
        Route::post('dropzone/upload', 'Admin\DropzoneGalleryController@upload')->name('dropzone.upload'); //Загрузка изображения
        Route::get('dropzone/images/{idGallery}', 'Admin\DropzoneGalleryController@getImages')->name('dropzone.images'); //Получить список изображения
        Route::delete('dropzone/delete/{idImg}', 'Admin\DropzoneGalleryController@delete')->name('dropzone.delete'); //Удалить изображение
        Route::post('dropzone/save/{idImg}', 'Admin\DropzoneGalleryController@saveImg')->name('dropzone.save'); //Сохранить данные изображения
        //End List Route For Upload Img Gallery
    });
