<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RoleRuleRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('role_rule_relations', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->unsignedBigInteger('role_id', false);
            $table->unsignedBigInteger('rule_id', false);

            $table->foreign('role_id')->references('id')->on('role');
            $table->foreign('rule_id')->references('id')->on('rule');

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
        App::$db->schema->dropIfExists('role_rule_relations');
    }
}
