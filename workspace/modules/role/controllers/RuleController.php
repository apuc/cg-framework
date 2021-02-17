<?php


namespace workspace\modules\role\controllers;


use core\App;
use core\Controller;
use workspace\models\Role;
use workspace\models\Rule;
use workspace\modules\role\sevices\RoleService;

class RuleController extends Controller
{
    public $viewPath = '/modules/role/views/';

    public $service;

    static $PERMISSION_INIT = ['All', 'roleAll'];

    protected function init()
    {
        $this->service = RoleService::initialize();

        if (false !== $this->service &&
            ( $this->service->hasOneOfPermissions(self::$PERMISSION_INIT) )) {

        $this->viewPath = '/modules/role/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Rules', 'url' => 'admin/rules']);

        } else {
            $this->redirect('adminlte');
        }
    }

    public function actionIndex()
    {
        $model = Rule::all();

        return $this->render('rule/rules.tpl', ['h1' => 'Права', 'model' => $model, 'options' => $this->setOptions($model)]);
    }

    public function actionView($id)
    {
        $model = Rule::where('id', $id)->first();

        return $this->render('rule/view.tpl', ['model' => $model, 'options' => $this->setOptions($model), 'roles' => $this->setRoleOptions($model->roles)]);
    }

    public function actionStore()
    {
        if (isset($_POST['key']) && $_POST['roles']) {

            Rule::storeRule($_POST['key'], $_POST['roles']);

            $this->redirect('admin/rules');
        } else
            return $this->render('rule/store.tpl', ['h1' => 'Добавить правило', 'roles' => Role::all()]);
    }

    public function actionEdit($id)
    {
        if (isset($_POST['key']) && isset($_POST['roles'])) {
            Rule::udpateRule($id, $_POST['key'], $_POST['roles']);

            $this->redirect('admin/rules');
        } else {
            $rule = Rule::findOrFail($id);

            return $this->render('rule/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $rule,
                'roles' => Role::all(),
                'linked_roles' => $rule->roles
                ]);
        }
    }

    public function actionDelete()
    {
        Rule::deleteRule($_POST['id']);
    }


    public function setOptions($data): array
    {
        return [
            'data' => $data,
            'serial' => '#',
            'fields' => [
                'key' => 'Ключ',
                'id' => 'ID'
            ],
            'baseUri' => '/admin/rules'
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
}