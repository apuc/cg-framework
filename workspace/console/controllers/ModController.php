<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 27.02.20
 * Time: 23:52
 */

namespace workspace\console\controllers;


use core\App;
use core\console\ConsoleController;

class ModController extends ConsoleController
{

    public function actionList()
    {
        $mods = App::getMods();
        foreach ($mods as $key => $mod) {
            $this->out->r($key . ' ' . $mod['version'], $mod['status'] === 'active' ? 'green' : 'yellow');
        }
    }

}