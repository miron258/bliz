<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHtmlToPagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('pages', function (Blueprint $table) {
            $table->text('html')->nullable()->after('description');
            $table->string('class_page', 100)->nullable()->after('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {


        Schema::table('pages', function (Blueprint $table) {
        
                $table->dropColumn('html');
            
         
                $table->dropColumn('class_page');
            
        });
    }

}
