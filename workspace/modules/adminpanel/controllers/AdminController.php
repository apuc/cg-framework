<?php


namespace workspace\modules\adminpanel\controllers;


use core\Controller;

class AdminController extends Controller
{
    public $viewPath = '/modules/adminpanel/views/';

    public function actionIndex()
    {
        return $this->render('admin/admin.tpl', ['h1' => 'Админка']);
    }

}