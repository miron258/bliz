<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            //Meta Tags
            $table->string('meta_tag_title');
            $table->string('meta_tag_keywords')->nullable();
            $table->string('meta_tag_description')->nullable();
            //End Meta Tags
            $table->string('name', 300);
            $table->mediumText('anons')->nullable();
            $table->text('description');
            $table->string('url');


            //Fields Settings Category
            $table->integer('per_page')->default(20); //Ко-во записей на страницу
            $table->integer('position')->nullable();
            $table->tinyInteger('sort')->nullable();
            $table->tinyInteger('sort_order')->nullable();
            //End Fields Settings Category


            $table->text('img')->nullable(); //Тип поля JSON здесь должны быть название изображения Title и Alt описание

            $table->string('author', 200);
            $table->string('update_author', 200);
            $table->boolean('hidden')->default(0); //Показать скрыть каталог
            $table->boolean('index')->default(0); //Показать скрыть из индекса поисковый системы

            NestedSet::columns($table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('categories');
    }

}
