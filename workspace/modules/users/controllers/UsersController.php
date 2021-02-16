<?php

namespace workspace\modules\users\controllers;

use core\App;
use core\Controller;
use core\Debug;
use Illuminate\Database\Eloquent\Model;
use workspace\models\Role;
use workspace\models\User;
use workspace\models\UserRoleRelations;
use workspace\modules\role\sevices\RoleService;
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

//        $service = new RoleService($model);
//        Debug::dd($service->hasRole('admin'));

        return $this->render('users/view.tpl', ['model' => $model, 'options' => $this->setOptions($model),
            'role_options' => $this->setRoleOptions($model->roles),
            'rule_options' => $this->setRuleOptions($model->getRules()),
        ]);
    }

    public function actionStore()
    {
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['roles'])) {

            User::storeUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['roles']);

            $this->redirect('admin/users');
        } else {
            return $this->render('users/store.tpl', ['roles' => Role::all()]);
        }
    }


    public function actionEdit($id) //TODO
    {

        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['roles'])) {

            User::updateUser($id, $_POST['username'], $_POST['email'], $_POST['roles']);

            $this->redirect("admin/users/{$id}");
        } else {
            return $this->render('users/edit.tpl',
                [
                    'h1' => 'Редактировать: ',
                    'model' => User::findOrFail($id),
                    'roles' => Role::all(),
                    'linked_roles' => User::findOrFail($id)->roles
                ]
            );
        }
    }

    public function actionDelete()
    {
        User::deleteUser($_POST['id']);
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
            'baseUri' => '/admin/users',
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
            'baseUri' => '/admin/roles',
            'actionBtn' => 'del_all'
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
            'baseUri' => '/admin/rules',
            'actionBtn' => 'del_all'
        ];
    }
}