<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Admin\Product;
use App\Models\Admin\Catalog;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {

    $arrCatalogs = array(1, 2, 3, 4);
    return [
        'meta_tag_title' => $faker->title,
        'meta_tag_description' => $faker->title,
        'meta_tag_keywords' => $faker->title,
        'name' => $faker->title,
        'art' => Str::random(5),
        'price' => $faker->randomNumber(2),
        'old_price' => $faker->randomNumber(2),
        'video' => $faker->name,
        'count_stock' => $faker->randomNumber(3),
        'sale' => 1,
        'new' => 1,
        'popular' => 1,
        'availability' => 1,
        'id_catalog' => array_rand($arrCatalogs),
        'img' => '',
        'properties' => $faker->text,
        'url' => Str::random(7),
        'anons' => $faker->text,
        'description' => $faker->text,
        'hidden' => 1,
        'index' => 1,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime()
    ];
});
