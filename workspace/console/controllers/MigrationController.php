<?php


namespace workspace\console\controllers;


use core\App;
use core\console\CgMigrationCreator;
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
        App::$db->schema->create('migration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('migration', 255);
            $table->integer('batch');
        });
    }

    // create migrations
    public function actionCreate()
    {
        try {
            if (!isset($this->argv['name'])) {
                throw new \Exception('Missing migration "--name" specified');
            }
            $m = new CgMigrationCreator(new Filesystem());

            $m->create(
                $this->argv['name'],
                WORKSPACE_DIR . '/console/migrations',
                isset($this->argv['table']) ? $this->argv['table'] : null,
                !isset($this->argv['update'])
            );
        } catch (\Exception $e) {
            $this->out->r('Message: ' .$e->getMessage(), 'red');
        }
    }

    //execute migrations
    public function actionRun()
    {
        $dmr = new DatabaseMigrationRepository(App::$db->capsule->getDatabaseManager(), 'migration');

        $m = new Migrator($dmr, App::$db->capsule->getDatabaseManager(), new Filesystem());
        $m->run(WORKSPACE_DIR . '/console/migrations/');
    }

    public function actionRollback()
    {
        $dmr = new DatabaseMigrationRepository(App::$db->capsule->getDatabaseManager(), 'migration');

        $m = new Migrator($dmr, App::$db->capsule->getDatabaseManager(), new Filesystem());
        $m->rollback(WORKSPACE_DIR . '/console/migrations/');
    }
}