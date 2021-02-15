<?php

namespace workspace\modules\users\controllers;

use core\App;
use core\Controller;
use core\Debug;
use Illuminate\Database\Eloquent\Model;
use workspace\models\Role;
use workspace\models\User;
use workspace\models\UserRoleRelations;
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
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['roles'])) {

            User::storeUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['roles']);

            $this->redirect('admin/users');
        } else {
            return $this->render('users/store.tpl');
        }
    }

/*    public function addRoles($id)
    {
        if (isset($_POST['roles'])) {
            $roles = $_POST['roles'];

            foreach ($roles as $role) {
                $user = User::findOrFail($id);
                $user_role_relations = new UserRoleRelations();
                $user_role_relations->_save($user->username, $role->key);
            }
        }
    }*/

    public function actionEdit($id) //TODO
    {

        if (isset($_POST['username']) && isset($_POST['email'])) {

            User::updateUser($id, $_POST['username'], $_POST['email']);

            $this->redirect('admin/users');
        } else
            return $this->render('users/edit.tpl', ['h1' => 'Редактировать: ', 'model' => User::findOrFail($id)]);

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
            'baseUri' => '/admin/rules',
            'actionBtn' => 'del_all'
        ];
    }
}