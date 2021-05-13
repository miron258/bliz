<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            //Meta Tags
            $table->string('meta_tag_title');
            $table->string('meta_tag_keywords')->nullable();
            $table->string('meta_tag_description')->nullable();
            //End Meta Tags
            $table->string('name', 300);
            $table->mediumText('anons')->nullable();
            $table->text('description');
            $table->text('html')->nullable();
            $table->string('url');
            $table->string('class_page', 100)->nullable();
            $table->string('author', 200);
            $table->string('update_author', 200);
            $table->boolean('hidden')->default(0);
            $table->boolean('index')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('pages');
    }

}
