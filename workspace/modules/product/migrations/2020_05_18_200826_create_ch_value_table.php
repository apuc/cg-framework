<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('ch_value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('characteristic_id')->unsigned();
            $table->string('value',255);
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
        App::$db->schema->table('ch_value', function ($table) {
            $table->dropForeign(['characteristic_id']);
        });
        App::$db->schema->dropIfExists('ch_value');
    }
}
