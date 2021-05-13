<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        if (!Schema::hasTable('materials')) {

            Schema::create('materials', function (Blueprint $table) {
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

                //Set Foreign Key
                $table->unsignedBigInteger('id_category')->default(0);
                $table->foreign('id_category')
                        ->references('id')
                        ->on('categories')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');


//Вся информация об изображениях
                $table->text('img')->nullable(); //Тип поля JSON здесь должны быть название изображения Title и Alt описание
                $table->text('properties')->nullable(); //Свойства товара если есть размер вес цвет и так далее


                $table->string('video', 600)->nullable(); //Видео к товару если есть поле не обязательное
                $table->string('author', 200);
                $table->string('update_author', 200);

                $table->boolean('hidden')->default(1); //Видимость товара
                $table->boolean('index')->default(1); //Идекс странички в поиске

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        if (Schema::hasTable('materials')) {
            Schema::dropIfExists('materials');
        }
    }

}
