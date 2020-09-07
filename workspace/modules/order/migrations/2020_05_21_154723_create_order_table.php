<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city', 255);
            $table->string('email', 255);
            $table->string('fio',255);
            $table->string('phone',255);
            $table->integer('pay');
            $table->integer('delivery');
            $table->integer('shop_id');
            $table->date('delivery_date');
            $table->string('delivery_time',255);
            $table->string('address',255);
            $table->string('comment',255);
            $table->float('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App::$db->schema->dropIfExists('order');
    }
}
