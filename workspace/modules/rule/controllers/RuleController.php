<?php


namespace workspace\modules\rule\controllers;


use core\App;
use core\Controller;
use workspace\models\Role;
use workspace\models\Rule;

class RuleController extends Controller
{
    public $viewPath = '/modules/rule/views/';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/rule/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Rules', 'url' => 'admin/rules']);
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
        if (isset($_POST['key'])) {
            $rule = new Rule();
            $rule->key = $_POST['key'];
            $rule->save();

            $this->redirect('admin/rules');
        } else
            return $this->render('rule/store.tpl', ['h1' => 'Добавить правило']);
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