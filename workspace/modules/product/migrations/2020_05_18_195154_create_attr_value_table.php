<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttrValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('attr_value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attr_id')->unsigned();
            $table->string('value',255);
            $table->foreign('attr_id')->references('id')->on('attribute');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App::$db->schema->table('attr_value', function ($table) {
            $table->dropForeign(['attr_id']);
        });
        App::$db->schema->dropIfExists('attr_value');
    }
}
