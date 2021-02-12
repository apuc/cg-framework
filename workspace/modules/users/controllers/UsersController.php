<?php

namespace workspace\modules\users\controllers;

use core\App;
use core\Controller;
use core\Debug;
use Illuminate\Database\Eloquent\Model;
use workspace\models\Role;
use workspace\models\User;
use workspace\modules\users\requests\UsersSearchRequest;

class UsersController extends Controller
{
    protected function init()
    {
        //if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');
        $this->viewPath = '/modules/users/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Users', 'url' => 'users']);
    }

    public function actionIndex()
    {
        $request = new UsersSearchRequest();
        $model = User::search($request);


        return $this->render('users/index.tpl',
            ['options' => $this->setOptions($model), 'h1' => 'Пользователи', 'model' => $model]);
    }

    public function actionView($id)
    {
        $model = User::where('id', $id)->first();


//        Debug::dd($model->getRoles());

        return $this->render('users/view.tpl', ['model' => $model, 'options' => $this->setOptions($model),
            'role_options' => $this->setRoleOptions($model->roles),
            'rule_options' => $this->setRuleOptions($model->getRules()),
        ]);
    }

    public function actionStore()
    {
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
            $model = new User();
            $model->username = $_POST['username'];
            $model->email = $_POST['email'];
            $model->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $model->save();

            $this->redirect('users');
        } else {
            return $this->render('users/store.tpl');
        }
    }

    public function actionEdit($id) //TODO
    {
        $model = User::where('id', $id)->first();

        if (isset($_POST['username']) && isset($_POST['email'])) {
            $model->username = $_POST['username'];
            $model->email = $_POST['email'];
            $model->save();

            $this->redirect('admin/users');
        } else
            return $this->render('users/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);

    }

    public function actionDelete($id)
    {
        User::where('id', $_POST['id'])->delete();
    }

    public function setOptions($data): array
    {
        return [
            'data' => $data,
            'serial' => '#',
            'fields' => [
                'username' => 'Логин',
                'email' => 'Email'
            ],
            'baseUri' => 'users',
        ];
    }

    public function setRoleOptions($data): array
    {
        return [
            'data' => $data,
            'serial' => '#',
            'fields' => [
                'key' => 'Имя',
                'id' => 'ID'
            ],
            'baseUri' => '/admin/roles'
        ];
    }

    public function setRuleOptions($data): array
    {
        return [
            'data' => $data,
            'serial' => '#',
            'fields' => [
                'key' => 'Ключ',
                'id' => 'ID'
            ],
            'baseUri' => 'rules',
            'actionBtn' => 'del_all'
        ];
    }
}