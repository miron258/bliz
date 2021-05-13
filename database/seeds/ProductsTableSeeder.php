<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Product;
use App\Models\Admin\Catalog;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker) {


        for ($i = 0; $i < 200; $i++) {

            $arrCatalogs = array(1, 2, 3, 4);
            DB::table('products')->insert([
                'meta_tag_title' => $faker->title,
                'meta_tag_description' => $faker->title,
                'meta_tag_keywords' => $faker->title,
                'name' => $faker->name,
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
                'author' => 'Александр Миронов',
                'update_author' => 'Александр Миронов',
                'anons' => $faker->text,
                'description' => $faker->text,
                'hidden' => 1,
                'index' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
        }
    }

}
