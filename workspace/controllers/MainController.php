<?php

namespace workspace\controllers;

use core\App;
use core\Controller;
use core\Debug;
use Illuminate\Database\Capsule\Manager as Capsule;
use workspace\models\Modules;
use workspace\models\User;
use workspace\traits\SmartTitle;
use workspace\widgets\Main;

class MainController extends Controller
{

    public function actionIndex()
    {
        //$this->view->setTitle('по новому методу');
        //Debug::prn(App::$config);
        //Main::widget()->run();
        $this->view->addMeta('keywords', 'главная', ['some' => 'text']);
        $this->view->registerJs('/resources/js/bodyScript.js', [], true);
        //$this->view->registerCss('/resources/css/new.css');
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

    public function actionSignUp()
    {
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
            $model = new User();
            $model->username = $_POST['username'];
            $model->email = $_POST['email'];
            $model->role = 2;
            $model->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $model->save();

            $_SESSION['role'] = $model->role;
            $_SESSION['username'] = $model->username;
//            $_SESSION['allowed'] = ['adminlte' => [1]];

            $this->redirect('');
        } else {
            return $this->render('main/sign-up.tpl');
        }
    }

    public function actionSignIn()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $model = User::where('username', $_POST['username'])->first();

            if(password_verify ($_POST['password'], $model->password_hash)) {
                $_SESSION['role'] = $model->role;
                $_SESSION['username'] = $model->username;
                App::$rout_filter->setRole($model->role);

                $this->redirect('adminlte');
            } else {
                $this->redirect('sign-in');
            }
        } else {
            return $this->render('main/sign-in.tpl');
        }
    }

    public function actionLogout()
    {
        session_destroy();
        $this->redirect('');
    }

    public function actionModules()
    {
        App::$header->add('Access-Control-Allow-Origin', '*');
        $content = file_get_contents('https://rep.craft-group.xyz/handler.php');
        $data = json_decode($content);

        $model = array();
        foreach ($data as $value)
            array_push($model, new Modules($value));

        $options = [
            'serial' => '#',
            'fields' => [
                'module' => 'Модуль',
            ],
            'baseUri' => 'modules'
        ];

        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Modules', 'url' => 'modules']);

        return $this->render('main/modules.tpl', ['model' => $model, 'options' => $options]);
    }

}