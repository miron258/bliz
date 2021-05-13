<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //Meta Tags
            $table->string('meta_tag_title');
            $table->string('meta_tag_keywords')->nullable();
            $table->string('meta_tag_description')->nullable();
            //End Meta Tags
            $table->string('art')->nullable();
            $table->string('name', 300);
            $table->mediumText('anons')->nullable();
            $table->text('description');
            $table->string('url');


            $table->integer('price')->default(0);
            $table->integer('old_price')->nullable();

//Вся информация об изображениях
            $table->text('img')->nullable(); //Тип поля JSON здесь должны быть название изображения Title и Alt описание
            $table->text('properties')->nullable(); //Свойства товара если есть размер вес цвет и так далее

            $table->integer('count_stock')->nullable(); //Остаток товара на складе
            $table->string('video', 600)->nullable(); //Видео к товару если есть поле не обязательное
            $table->string('author', 200);
            $table->string('update_author', 200);

//Рейтинг товара
            $table->boolean('sale')->default(0);
            $table->boolean('new')->default(0);
            $table->boolean('popular')->default(0);
            //Конец Рейтинг товара
            $table->boolean('availability')->default(1); //Доступен товар или нет
            $table->boolean('hidden')->default(1); //Видимость товара
            $table->boolean('index')->default(1); //Идекс странички в поиске
            //Set Foreign Key
            $table->unsignedBigInteger('id_catalog');
            $table->foreign('id_catalog')
                    ->references('id')
                    ->on('catalogs')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('products');
    }

}
