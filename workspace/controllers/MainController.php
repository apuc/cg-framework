<?php

namespace workspace\controllers;

use core\App;
use core\Controller;
use core\Debug;
use Illuminate\Database\Capsule\Manager as Capsule;
use workspace\models\User;
use workspace\traits\SmartTitle;

class MainController extends Controller
{

    public function actionIndex()
    {
        //$this->view->setTitle('по новому методу');
        Debug::prn(App::$config);
        $this->view->addMeta('keywords', 'главная', ['some' => 'text']);
        $this->view->registerJs('/resources/js/bodyScript.js', [], true);
        return $this->render('main/index.tpl', ['h1' => 'Проект ' . App::$config['app_name']]);
    }

    public function actionItems($id)
    {
        return $this->render('main/index.tpl', ['title' => 'Название страницы ' . $id, 'h1' => 'Item ' . $id]);
    }

    public function actionUsers()
    {
        $users = User::all();
        Debug::dd($users);
    }

    public function actionUser($id)
    {
        $user = User::where('id', $id)->first();
        return $this->render('main/user.tpl', ['model' => $user]);
    }

}