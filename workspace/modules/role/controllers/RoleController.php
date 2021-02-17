<?php


namespace workspace\modules\role\controllers;


use core\App;
use core\Controller;
use core\Debug;
use core\Select2;
use workspace\models\Role;
use workspace\models\RoleRuleRelations;
use workspace\models\Rule;
use workspace\models\User;
use workspace\modules\role\requests\RoleDeleteRequest;
use workspace\modules\role\requests\RoleRequest;
use workspace\modules\role\sevices\RoleService;

class RoleController extends Controller
{
    public $viewPath = '/modules/role/views/';

    public $service;

    static $PERMISSION_INIT = ['All', 'roleAll', 'roleInit'];

    protected function init()
    {
        $this->service = RoleService::initialize();

        if (false !== $this->service &&
            ( $this->service->hasOneOfPermissions(self::$PERMISSION_INIT) )) {

            $this->viewPath = '/modules/role/views/';
            $this->layoutPath = App::$config['adminLayoutPath'];
            App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
            App::$breadcrumbs->addItem(['text' => 'Roles', 'url' => 'admin/roles']);
        } else {
            $this->redirect('adminlte');
        }
    }

    public function actionIndex()
    {
        $model = Role::all();

        return $this->render('role/roles.tpl', ['h1' => 'Роли', 'model' => $model, 'options' => $this->setOptions($model)]);
    }

    public function actionView($id)
    {
        $model = Role::where('id', $id)->first();

        $options = [
            'fields' => [
                'id' => 'ID',
                'key' => 'Имя'
            ]
        ];

        return $this->render('role/view.tpl', ['model' => $model, 'options' => $options,
            'rules' => $this->setRuleOptions($model->rules),
            'users' => $this->setUserOptions($model->users)]);
    }

    public function actionStore()
    {
        $request = new RoleRequest();

        if ($request->validate()) {
            RoleService::storeRole($request);

            $this->redirect('admin/roles');
        } else {
            $errors = $request->isPost() ? $request->errors->all() : null;

            return $this->render('role/store.tpl',
                [
                    'h1' => 'Добавить роль',
                    'rules' => Rule::all(),
                    'users' => User::all(),
                    'errors' => $errors
                ]
            );
        }
    }

    public function actionEdit($id)
    {
        $request = new RoleRequest();
        $request->id = $id;

        if ($request->validate()) {
            RoleService::editRole($request);

            $this->redirect("admin/roles/{$id}");
        } else {
            $role = Role::where('id', $id)->first();
            $rules = $role->rules;

            $errors = $request->isPost() ? $request->errors->all() : null;

            return $this->render('role/edit.tpl',
                [
                    'model' => $role,
                    'linked_rules' => $rules,
                    'rules' => Rule::all(),
                    'users' => User::all(),
                    'linked_users' => $role->users,
                    'errors' => $errors
                ]
            );
        }
    }

    public function actionDelete()
    {
        $request = new RoleDeleteRequest();

        if ($request->validate()) {
            RoleService::deleteRole($request);
        } else {
            //TODO render some(current) tpl, but with errors?
        }
    }

    public function setOptions($data): array
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

    public function setUserOptions($data): array
    {
        return [
            'data' => $data,
            'serial' => '#',
            'fields' => [
                'username' => 'Логин',
                'email' => 'Email'
            ],
            'baseUri' => '/admin/users',
            'actionBtn' => 'del_all'
        ];
    }
}