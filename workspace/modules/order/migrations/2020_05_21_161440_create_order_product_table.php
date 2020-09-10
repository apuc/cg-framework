<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

        public function up()
    {
        App::$db->schema->create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity');
//            $table->foreign('order_id')->references('id')->on('order');
//            $table->foreign('product_id')->references('id')->on('virtual_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        App::$db->schema->table('order_product', function ($table) {
//            $table->dropForeign(['product_id']);
//            $table->dropForeign(['order_id']);
//        });
        App::$db->schema->dropIfExists('order_product');
    }
}
