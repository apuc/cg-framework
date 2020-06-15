<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryChTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('category_ch', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('characteristic_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('characteristic_id')->references('id')->on('characteristic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App::$db->schema->table('category_ch', function ($table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['characteristic_id']);
        });
        App::$db->schema->dropIfExists('category_ch');
    }
}
