<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Product;
use App\Models\Admin\Catalog;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();
        
        //Запуск наполнителя для таблицы с товарами
        $this->call(ProductsTableSeeder::class);
    }

}
