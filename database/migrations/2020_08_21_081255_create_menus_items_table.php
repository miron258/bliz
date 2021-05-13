<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateMenusItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('menus_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('route')->nullable();
            $table->string('url');
            $table->tinyInteger('position')->default(0);
            $table->string('class')->nullable();
            $table->string('icon')->nullable();
            $table->string('attr')->nullable();
            $table->boolean('hidden')->default(false);
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')
                    ->references('id')
                    ->on('menus')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('menus_items');
    }

}
