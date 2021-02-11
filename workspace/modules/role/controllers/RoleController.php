<?php


namespace workspace\modules\role\controllers;


use core\App;
use core\Controller;
use workspace\models\Role;

class RoleController extends Controller
{
    public $viewPath = '/modules/role/views/';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/role/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Roles', 'url' => 'admin/roles']);
    }

    public function actionIndex()
    {
        $model = Role::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'key' => 'Имя',
                'id' => 'ID'
            ],
            'baseUri' => 'roles'
        ];

        return $this->render('role/roles.tpl', ['h1' => 'Роли', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Role::where('id', $id)->first();

        $options = [
            'fields' => [
                'id' => 'ID',
                'key' => 'Имя'
            ],
        ];

        return $this->render('role/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['key'])) {
            $role = new Role();
            $role->key = $_POST['key'];
            $role->save();

            $this->redirect('admin/roles');
        } else
            return $this->render('role/store.tpl', ['h1' => 'Добавить роль']);
    }

    public function actionEdit($id)
    {
        $role = Role::where('id', $id)->first();

        if(isset($_POST['key'])) {
            $role->key = $_POST['key'];
            $role->save();

            $this->redirect('admin/roles');
        } else
            return $this->render('role/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $role]);
    }

    public function actionDelete()
    {
        Role::where('id', $_POST['id'])->delete();
    }
}