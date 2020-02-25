<?php


namespace workspace\console\controllers;


use core\App;
use core\console\ConsoleController;
use core\Debug;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Illuminate\Filesystem\Filesystem;

class MigrationController extends ConsoleController
{

    public function actionRun()
    {
        //Debug::dd(App::$db);
//        App::$db->schema->create('widgets', function(Blueprint $table){
//            // Auto-increment id
//            $table->increments('id');
//            $table->integer('serial_number');
//            $table->string('name');
//            // Required for Eloquent's created_at and updated_at columns
//            $table->timestamps();
//        });

//        $m = new MigrationCreator(new Filesystem());
//        $m->create('test', WORKSPACE_DIR . '/console/migration/', 'test');

        $dmr = new DatabaseMigrationRepository(App::$db->capsule->getDatabaseManager(), 'migration');

        $m = new Migrator($dmr, App::$db->capsule->getDatabaseManager(), new Filesystem());
        $m->run(WORKSPACE_DIR . '/console/migrations/');
    }

}