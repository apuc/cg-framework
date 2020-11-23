<?php


namespace workspace\console\controllers;


use core\console\ConsoleController;


class InitController extends ConsoleController
{
    public function actionInit()
    {
        $config = new ModController();
        $config->actionInit();

        $config = new ConfigController();
        $config->actionInit();

        $config = new MigrationController();
        $config->actionInit();
    }
}