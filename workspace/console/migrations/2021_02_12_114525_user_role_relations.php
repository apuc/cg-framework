<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserRoleRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('user_role_relations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('user_name', 255);
            $table->string('role_key');

            $table->foreign('user_name')->references('username')->on('user');
            $table->foreign('role_key')->references('key')->on('role');


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
        App::$db->schema->dropIfExists('user_role_relations');
    }
}
