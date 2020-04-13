<?php


use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class title_to_article extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->table('article', function (Blueprint $table) {
            $table->string('title')->nullable();;
            $table->string('description')->nullable();;
            $table->string('keywords')->nullable();
            $table->string('url')->nullable();;
        });
    }
}