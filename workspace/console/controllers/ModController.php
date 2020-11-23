<?php


namespace workspace\console\controllers;


use core\App;
use core\component_manager\lib\ModulesHandler;
use core\console\ConsoleController;

class ModController extends ConsoleController
{
    public function actionInit()
    {
        try {
            file_put_contents('mods.json', '');
            $modules = new ModulesHandler();
            $modules->addToManifest();

            $this->out->r("mods.json created successfully", 'green');
        }   catch (\Exception $e){
            $this->out->r($e->getMessage(), 'red');
        }
    }

    public function actionList()
    {
        $mods = App::getMods();
        foreach ($mods as $key => $mod) {
            $this->out->r($key . ' ' . $mod['version'], $mod['status'] === 'active' ? 'green' : 'yellow');
        }
    }
}