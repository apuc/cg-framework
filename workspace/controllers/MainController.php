<?php


namespace workspace\controllers;


use core\Controller;

class MainController extends Controller
{

    public function actionIndex()
    {
        return $this->render('main/index.tpl', ['title' => 'Название страницы 123', 'h1' => 'Заголовок']);
    }

}