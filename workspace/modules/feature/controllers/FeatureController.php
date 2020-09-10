<?php


namespace workspace\modules\feature\controllers;


use core\App;
use core\Controller;
use workspace\modules\feature\models\Feature;
use workspace\modules\feature\requests\FeatureSearchRequest;

class FeatureController extends Controller
{
    protected function init()
    {
        $this->viewPath = '/modules/feature/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Feature', 'url' => 'admin/feature']);
    }

    public function actionIndex()
    {
        $request = new FeatureSearchRequest();
        $model = Feature::search($request);

        $options = $this->setOptions();

        return $this->render('feature/index.tpl', ['h1' => 'Feature', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Feature::where('id', $id)->first();

        $options = $this->setOptions();

        return $this->render('feature/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if($this->validation()) {
            $model = new Feature();
            $model->_save();

            $this->redirect('admin/feature');
        } else
            return $this->render('feature/store.tpl', ['h1' => 'Добавить']);
    }

    public function actionEdit($id)
    {
        $model = Feature::where('id', $id)->first();

        if($this->validation()) {
            $model->_save();

            $this->redirect('admin/feature');
        } else
            return $this->render('feature/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        Feature::where('id', $_POST['id'])->delete();
    }

    public function setOptions()
    {
        return [
            'serial' => '#',
            'fields' => [
                'id' => 'Id',
                'tour_id' => 'Tour_id',
                'feature' => 'Feature',
                'type' => 'Type',
                'created_at' => 'Created_at',
                'updated_at' => 'Updated_at',
            ],
            'baseUri' => 'feature'
        ];
   }

   public function validation()
   {
       return (isset($_POST["tour_id"]) && isset($_POST["feature"]) && isset($_POST["type"])) ? true : false;
   }
}