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
use samejack\PHP\PHP_ArgvParser;

class MigrationController extends ConsoleController
{
    //create migrations table
    public function actionCreateMigrationTable()
    {
        App::$db->schema->create('migrations', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('migration', 255);
            $table->integer('batch');
        });
    }

    // create migrations
    public function actionCreate()
    {
        $m = new MigrationCreator(new Filesystem());
        $m->create($this->argv['name'], WORKSPACE_DIR . '/console/migrations', $this->argv['name']);
    }

    //execute migrations
    public function actionRun()
    {
        $dmr = new DatabaseMigrationRepository(App::$db->capsule->getDatabaseManager(), 'migration');

        $m = new Migrator($dmr, App::$db->capsule->getDatabaseManager(), new Filesystem());
        $m->run(WORKSPACE_DIR . '/console/migrations/');
    }
}