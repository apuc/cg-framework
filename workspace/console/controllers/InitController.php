<?php


namespace workspace\console\controllers;


use core\console\ConsoleController;

class InitController extends ConsoleController
{
    public function actionInit() {
        $mods = new ModController();
        $mods->actionInit();

        $config = new ConfigController();
        $config->actionInit();

        $migrations = new MigrationController();
        $migrations->actionInit();
    }
}