const mix = require('laravel-mix');
mix.options({ processCssUrls: false });

// mix.webpackConfig({
//     node: {
//         fs: 'empty'
//     },
//     resolve: {
//         alias: {
//             'vue$': 'vue/dist/vue.runtime.common.js'
//         }
//     }
// });


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
//Из метода js require в переданных файлах читаются в scripts нет
//All Scripts Admin Panel
mix.js('resources/js/admin/angular/menu_items/app.js', 'public/js/admin/angular/appMenuItems.js');
mix.js('resources/js/admin/angular/gallery/app.js', 'public/js/admin/angular/appGallery.js');


mix.js('resources/js/admin/angular/ngApp.js', 'public/js/admin/angular/ngApp.js');
mix.scripts(
    [

//Таблица статических страниц в административной панели
        'resources/js/admin/angular/table_pages/directives/tablePages.js',
        'resources/js/admin/angular/table_pages/controllers/pageCtrl.js',
        'resources/js/admin/angular/table_pages/services/pageSrv.js',
        //Конец Таблица статических страниц в административной панели


        //Таблица материалов в административной панели
        'resources/js/admin/angular/table_materials/directives/tableMaterials.js',
        'resources/js/admin/angular/table_materials/controllers/materialCtrl.js',
        'resources/js/admin/angular/table_materials/services/materialSrv.js',
        //Конец Таблица материалов в административной панели


        //Таблица товаров в административной панели
        'resources/js/admin/angular/table_products/directives/tableProducts.js',
        'resources/js/admin/angular/table_products/controllers/productCtrl.js',
        'resources/js/admin/angular/table_products/services/productSrv.js'
        //Конец Таблица товаров в административной панели
    ],
    'public/js/admin/angular/ngAppScripts.js');


mix.scripts(
    [
        'resources/js/admin/angular/menu_items/controllers/menuItemsCtrl.js',
        'resources/js/admin/angular/menu_items/controllers/formMenuItemsCtrl.js',
        'resources/js/admin/angular/menu_items/directives/menuItems.js',
        'resources/js/admin/angular/menu_items/directives/selectOptionsMenuItems.js',
        'resources/js/admin/angular/menu_items/services/menuItemsSrv.js'
    ],
    'public/js/admin/angular/appMenuItemsScripts.js');


mix.scripts(
    [
        'resources/js/admin/angular/gallery/controllers/dropzoneUploadsCtrl.js',
        'resources/js/admin/angular/gallery/directives/listImgs.js',
        'resources/js/admin/angular/gallery/services/galleryUploadSrv.js'
    ],
    'public/js/admin/angular/appGalleryScripts.js');


mix.scripts(
    [
        'resources/js/jquery-2.2.4.js',
        'node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js',
        'node_modules/angular-ui-tree/dist/angular-ui-tree.js',
        'node_modules/angular-route/angular-route.js',
        'node_modules/angular-messages/angular-messages.js',
        'node_modules/angular-popeye/release/popeye.js',
        'node_modules/ngdropzone/dist/ng-dropzone.js',
        'node_modules/angular-sanitize/angular-sanitize.js'
    ],
    'public/js/admin/plugins.js');
//END All Scripts Admin Panel


//All Styles Admin Panel cyrillic to translit
mix.copy('node_modules/cyrillic-to-translit-js/dist/bundle.js', 'public/js/admin');
mix.copy('node_modules/bootstrap4-notify/bootstrap-notify.js', 'public/js/admin');

/////////////////////Admin Panel Dropzone JS and CSS Files
//Js File
mix.copy('node_modules/ngdropzone/dist/ng-dropzone.js', 'public/js/admin');
//Css File
mix.copy('node_modules/ngdropzone/dist/ng-dropzone.css', 'public/css/admin');
////////////////////////End Admin Panel Dropzone JS and CSS Files


///////////////////////////////////////ADMIN PANEL Plugin JS and CSS CodeMirror
mix.scripts(
    [
        'node_modules/codemirror/lib/codemirror.js',
        'node_modules/codemirror/mode/htmlmixed/htmlmixed.js',
        'node_modules/codemirror/mode/xml/xml.js',
        'node_modules/codemirror/mode/htmlembedded/htmlembedded.js',
        'node_modules/codemirror/mode/css/css.js',
        'node_modules/codemirror/mode/http/http.js',
        'node_modules/codemirror/mode/markdown/markdown.js',
        'node_modules/codemirror/mode/sass.js/sass.js',
        'node_modules/codemirror/mode/vue/vue.js',
        'node_modules/codemirror/mode/javascript/javascript.js',
        'node_modules/codemirror/mode/php/php.js'
    ],
    'public/js/admin/codemirror.js');
mix.copy('node_modules/codemirror/lib/codemirror.css', 'public/css/admin');
mix.copy('node_modules/codemirror/theme/darcula.css', 'public/css/admin');
///////////////////////////////////////END ADMIN PANEL Plugin JS and CSS CodeMirror

mix.styles([
    'node_modules/angular-ui-bootstrap/dist/ui-bootstrap-csp.css',
    'node_modules/angular-ui-tree/dist/angular-ui-tree.css',
    'node_modules/angular-popeye/release/popeye.css'
], 'public/css/admin/plugins.css');
//END All Styles Admin Panel


//////////////////////////////////// SCRIPTS JS AND CSS SITE
mix.scripts(
    [
        'resources/js/plugins/jquery.events.touch.js',
    ],
    'public/js/plugins.js');

mix.styles([
    // 'node_modules/v-modal/dist/v-modal.css',
    // 'resources/sass/plugins/fotorama.scss',

    /////// SLICK CAROUSEL
    'node_modules/slick-carousel/slick/slick.css',
    'node_modules/slick-carousel/slick/slick-theme.css',
    /////// END SLICK CAROUSEL


], 'public/css/plugins.css');


mix.js('resources/js/app.js', 'public/js');

//// Vue JS Components
mix.js('resources/js/components/appComponents.js', 'public/js/vue');
// mix.js('resources/js/components/appServer.js', 'public/js/vue');
// mix.js('resources/js/components/appClient.js', 'public/js/vue');
//// End Vue JS Components

mix.js('resources/js/admin/app_admin.js', 'public/js/admin');
mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/admin/app_admin.scss', 'public/css/admin');


//Scss Page
mix.sass('resources/sass/page.scss', 'public/css');
//Scss Category
mix.sass('resources/sass/category.scss', 'public/css');
//Scss Material
mix.sass('resources/sass/material.scss', 'public/css');
