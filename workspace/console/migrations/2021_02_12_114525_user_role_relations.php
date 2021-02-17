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

            $table->unsignedBiginteger('user_id', false);
            $table->unsignedBigInteger('role_id', false);

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('role_id')->references('id')->on('role');


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
