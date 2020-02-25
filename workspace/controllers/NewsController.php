<?php


namespace workspace\controllers;


use core\Controller;
use core\Debug;
use core\interfaces\CrudControllerInterface;

class NewsController extends Controller implements CrudControllerInterface
{

    public function actionIndex()
    {
        echo 'news index';
    }

    public function actionStore()
    {
        echo 'news store';
    }

    public function actionView($id)
    {
        echo 'news ' . $id;
    }

    public function actionEdit($id)
    {
        echo 'news edit ' . $id;
    }

    public function actionDelete($id)
    {
        echo 'news delete ' . $id;
    }

}