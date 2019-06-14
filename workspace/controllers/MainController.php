<?php


namespace workspace\controllers;


use core\App;
use core\Controller;

class MainController extends Controller
{

    public function actionIndex()
    {
        return $this->render('main/index.tpl', ['title' => 'Название страницы 123', 'h1' => 'Проект ' . App::$config['app_name']]);
    }

    public function actionItems($id)
    {
        return $this->render('main/index.tpl', ['title' => 'Название страницы ' . $id, 'h1' => 'Item ' . $id]);
    }

}