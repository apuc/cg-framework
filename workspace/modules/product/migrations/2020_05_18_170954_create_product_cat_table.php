<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('product_cat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('cat_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('cat_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App::$db->schema->table('product_cat', function ($table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['cat_id']);
        });
        App::$db->schema->dropIfExists('product_cat');
    }
}
