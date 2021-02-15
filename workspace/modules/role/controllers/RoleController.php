<?php


namespace workspace\modules\role\controllers;


use core\App;
use core\Controller;
use core\Debug;
use core\Select2;
use workspace\models\Role;
use workspace\models\RoleRuleRelations;
use workspace\models\Rule;

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
            'rules' => $this->setRuleOptions($model->rules)]);
    }

    public function actionStore()
    {
        if (isset($_POST['key']) && isset($_POST['rules'])) {
            Role::storeRole($_POST['key'], $_POST['rules']);

            $this->redirect('admin/roles');
        } else
            return $this->render('role/store.tpl', ['h1' => 'Добавить роль', 'rules' => Rule::all()]);
    }

    public function actionEdit($id)
    {
        if (isset($_POST['key']) && isset($_POST['rules'])) {

//            Debug::dd($_POST['rules']);

            Role::updateRole($id, $_POST['key'], $_POST['rules']);

            $this->redirect("admin/roles/{$id}");
        } else {
            $role = Role::where('id', $id)->first();

            $rules = $role->rules;
            /*
                        $sel2 = new Select2();
                        $sel2->setParams(
                            $rules,
                            [
                                'label' => 'Права',
                                'id' => 'rule',
                                'class' => '',
                                'value' => $rules[0]->key,
                                'value_id' => $rules[0]->id,
                            ]
                        );
                        $selectList = $sel2->run();*/

            return $this->render('role/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $role,
                'linked_rules' => $rules,
                'rules' => Rule::all()
//                'selectRules' => $selectList
            ]);
        }
    }

    public function actionDelete()
    {
        Role::deleteRole($_POST['id']);
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
}