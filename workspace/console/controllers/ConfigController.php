<?php


namespace workspace\console\controllers;


use core\console\ConsoleController;


class ConfigController extends ConsoleController
{
    public function actionInit()
    {
        try {
            $db_name = (isset($this->argv['db_name'])) ? $this->argv['db_name'] : 'cg';
            $user = (isset($this->argv['user'])) ? $this->argv['user'] : 'root';
            $pass = (isset($this->argv['pass'])) ? $this->argv['pass'] : 'root';

            if(!is_dir("config/local"))
                mkdir("config/local");

            $file = file_get_contents("core/stubs/db_config.stub");
            $file = str_replace('{dummyDb}', $db_name, $file);
            $file = str_replace('{dummyUser}', $user, $file);
            $file = str_replace('{dummyPass}', $pass, $file);

            file_put_contents('config/local/main.php', $file);

            $this->out->r("Local config created successfully", 'green');
        } catch (\Exception $e) {
            $this->out->r('Error message: ' .$e->getMessage(), 'red');
        }
    }
}