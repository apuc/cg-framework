<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualProductAttrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('virtual_product_attr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attr_value_id')->unsigned();
            $table->integer('virtual_product_id')->unsigned();
            $table->tinyInteger('status');
            $table->foreign('attr_value_id')->references('id')->on('attr_value');
            $table->foreign('virtual_product_id')->references('id')->on('virtual_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App::$db->schema->table('virtual_product_attr', function ($table) {
            $table->dropForeign(['attr_value_id']);
            $table->dropForeign(['virtual_product_id']);
        });
        App::$db->schema->dropIfExists('virtual_product_attr');
    }
}
