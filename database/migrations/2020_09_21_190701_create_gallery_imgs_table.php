<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryImgsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('gallery_imgs', function (Blueprint $table) {
            $table->id();
            $table->string('alt');
            $table->string('name');
          

            //Set Foreign Key
            $table->unsignedBigInteger('id_gallery')->default(0);
            $table->foreign('id_gallery')
                    ->references('id')
                    ->on('galleries')
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
        Schema::dropIfExists('gallery_imgs');
    }

}
