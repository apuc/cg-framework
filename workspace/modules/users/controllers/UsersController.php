<?php
namespace workspace\modules\users\controllers;

use core\App;
use core\Controller;
use core\Debug;
use workspace\models\User;

class UsersController  extends Controller
{
    protected function init()
    {
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');
        $this->viewPath = '/modules/users/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Users', 'url' => 'users']);
    }

    public function actionIndex()
    {
        $model = User::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'username' => 'Логин',
                'email' => 'Email',
                'role' => 'Роль',
            ],
            'baseUri' => 'users',
            'pagination' => [
                'per_page' => 25,
            ],
        ];
        return $this->render('users/index.tpl',
            ['model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {

    }

    public function actionStore()
    {
        if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
            $model = new User();
            $model->username = $_POST['username'];
            $model->email = $_POST['email'];
            $model->role = (int)$_POST['role'];
            $model->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $model->save();

            $this->redirect('users');
        } else {
            return $this->render('users/store.tpl');
        }
    }

    public function actionEdit($id)
    {

    }

    public function actionDelete($id)
    {

    }
}