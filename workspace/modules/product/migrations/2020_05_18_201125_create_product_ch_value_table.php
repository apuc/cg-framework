<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductChValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('product_ch_value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('ch_value_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('ch_value_id')->references('id')->on('ch_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App::$db->schema->table('product_ch_value', function ($table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['ch_value_id']);
        });
        App::$db->schema->dropIfExists('product_ch_value');
    }
}
