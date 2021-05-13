<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
//            $table->string('url', 300); //Ссылка
            $table->string('name', 300); //Название
            $table->string('header', 300); //Заголовок описания
            $table->string('path'); //Каталог с файлами
            $table->mediumText('description')->nullable();
            $table->string('class', 300);
            $table->boolean('hidden')->default(1); //Видимость

            $table->string('author', 200);
            $table->string('update_author', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('galleries');
    }

}
