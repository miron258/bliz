<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
//URL::forceSchema('https');
//Routing Site
    Route::get('/', 'MainController@index')->name('site.index'); //главная страница сайта
    Route::get('page/{url}', 'PageController@index')->name('page_site.index');
    Route::get('product/{url}', 'ProductController@index')->name('product_site.index');
    Route::get('catalog/{url}', 'CatalogController@index')->name('catalog_site.index');
    Route::get('material/{url}', 'MaterialController@index')->name('material_site.index');
    Route::get('category/{url}', 'CategoryController@index')->name('category_site.index');
    Route::get('search', 'SearchController@index')->name('search_site.index');
//END Routing Site


//Route::get('modal-add-review', function () {
//    return view('layouts.modal.modalReviews');
//})->name('modal-form-add-review');

//Route::get('form-add-review', function () {
//    return view('layouts.form-add-review');
//})->name('form-add-review');
//Route::get('list-reviews', function () {
//    return view('layouts.list-reviews');
//})->name('list-reviews');


Route::post('saveformorder', 'FormController@saveFormOrder');
Route::post('saveformreview', 'FormController@saveFormReview');


Route::get('sendbasicemail', 'MailController@basic_email');
Route::get('sendhtmlemail', 'MailController@html_email');
Route::get('sendattachmentemail', 'MailController@attachment_email');

Auth::routes();


//Группе маршрутов административной панели
//Чтобы войти на страничку эти маршрутов нужно пройти через посредник в данном случае через аутентификацию
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


//Получение данных путем AJAX после авторизации пользователя
//Route::get('admin/table_products', [
//    'middleware'=>'auth',
//'uses'=>'Admin\ProductController@tableProducts']);


Route::group(
    [
        'middleware' => 'auth',
        'prefix' => 'admin' //Добавляет префик к каждому маршруту в данном случае
        //  Route::resource('page', 'Admin\PageController'); равняется  Route::resource('admin/page', 'Admin\PageController');
    ]
    , function () {

//Здесь перечислены группы наших маршрутов
    //К каждому начала маршрута добавляется префикс admin

    Route::resource('page', 'Admin\PageController');
    Route::resource('catalog', 'Admin\CatalogController');
    Route::resource('category', 'Admin\CategoryController');
    Route::resource('product', 'Admin\ProductController');
    Route::resource('gallery', 'Admin\GalleryController');
    Route::resource('material', 'Admin\MaterialController');
    Route::resource('menu', 'Admin\MenuController');
    Route::resource('review', 'Admin\ReviewController');
    Route::resource('formOrder', 'Admin\FormOrderController');


    Route::get('list_pages', 'Admin\PageController@getPages'); //Получать список статических страни
    Route::get('table_pages', 'Admin\PageController@tablePages'); //Шаблон таблицы со списком страниц


    Route::get('list_materials', 'Admin\MaterialController@getMaterials'); //Получать список материалов
    Route::get('table_materials', 'Admin\MaterialController@tableMaterials'); //Шаблон таблицы со списком материалов


    Route::get('list_products', 'Admin\ProductController@getProducts'); //Получать список товаров
    Route::get('table_products', 'Admin\ProductController@tableProducts'); //Шаблон таблицы со списком товаров
});




