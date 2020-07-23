<?php


namespace workspace\modules\elfinder\controllers;


use core\App;
use core\Controller;
use core\Debug;

class ConnectorController extends Controller
{
    public $viewPath = '/modules/elfinder/views/';

    public function init()
    {
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Elfinder', 'url' => 'admin/elfinder']);
    }

    public function actionIndex()
    {
        //echo App::$config['connectorPath'] . 'connector.php';
        include App::$config['connectorPath'] . 'connector.php';
    }

    public function actionMainAdmin()
    {
        //Debug::dd(App::$config['adminLayoutPath']);
        $this->layoutPath = App::$config['adminLayoutPath'];
        return $this->render('connector/main-admin.tpl');
    }

}