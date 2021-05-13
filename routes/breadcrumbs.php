<?php

// Главная
Breadcrumbs::for('/', function ($trail) {
    $trail->push('Главная', route('site.index'));
});

//Результаты поиска
Breadcrumbs::for('search', function ($trail) {
    $trail->parent('/');
    $trail->push('Результаты поиска');
});


//Вывод статических страниц
Breadcrumbs::for('page', function ($trail, $page) {
    $trail->parent('/');
    $trail->push($page->name, route('page_site.index', $page->url));
});

//Вывод каталогов
Breadcrumbs::for('catalog', function ($trail, $catalog) {
    if ($catalog->parent) {
        $trail->parent('catalog', $catalog->parent);
    } else {
        $trail->parent('/');
    }
    $trail->push($catalog->name, route('catalog_site.index', $catalog->url));
});

//Вывод товаров
Breadcrumbs::for('product', function ($trail, $product) {
    $trail->parent('catalog', $product->catalog);
    $trail->push($product->name, route('product_site.index', $product->url));
});

//Вывод катагорий
Breadcrumbs::for('category', function ($trail, $category) {
    if ($category->parent) {
        $trail->parent('category', $category->parent);
    } else {
        $trail->parent('/');
    }
    $trail->push($category->name, route('catalog_site.index', $category->url));
});
//Вывод материалов
Breadcrumbs::for('material', function ($trail, $material) {
    $trail->parent('material', $material->catalog);
    $trail->push($material->name, route('material_site.index', $material->id));
});


