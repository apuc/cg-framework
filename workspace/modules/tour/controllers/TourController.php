<?php


namespace workspace\modules\tour\controllers;


use core\App;
use core\Controller;
use workspace\modules\tour\models\Tour;
use workspace\modules\tour\requests\TourSearchRequest;

class TourController extends Controller
{
    protected function init()
    {
        $this->viewPath = '/modules/tour/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Tour', 'url' => 'admin/tour']);
    }

    public function actionIndex()
    {
        $request = new TourSearchRequest();
        $model = Tour::search($request);

        $options = $this->setOptions();

        return $this->render('tour/index.tpl', ['h1' => 'Tour', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Tour::where('id', $id)->first();

        $options = $this->setOptions();

        return $this->render('tour/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if($this->validation()) {
            $model = new Tour();
            $model->_save();

            $this->redirect('admin/tour');
        } else
            return $this->render('tour/store.tpl', ['h1' => 'Добавить']);
    }

    public function actionEdit($id)
    {
        $model = Tour::where('id', $id)->first();

        if($this->validation()) {
            $model->_save();

            $this->redirect('admin/tour');
        } else
            return $this->render('tour/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        Tour::where('id', $_POST['id'])->delete();
    }

    public function setOptions()
    {
        return [
            'serial' => '#',
            'fields' => [
                'id' => 'Id',
                'name' => 'Name',
                'main_description' => 'Main_description',
                'front_description' => 'Front_description',
                'front_date' => 'Front_date',
                'front_places_remaining' => 'Front_places_remaining',
                'price' => 'Price',
                'difficulties_and_weather' => 'Difficulties_and_weather',
                'amount_of_places' => 'Amount_of_places',
                'reservation_title' => 'Reservation_title',
                'visa' => 'Visa',
                'image_id' => 'Image_id',
                'title_image_id' => 'Title_image_id',
                'amount_activities_items_1' => 'Amount_activities_items_1',
                'amount_activities_items_2' => 'Amount_activities_items_2',
                'bg_image_id' => 'Bg_image_id',
                'activities_title' => 'Activities_title',
                'created_at' => 'Created_at',
                'updated_at' => 'Updated_at',
            ],
            'baseUri' => 'tour'
        ];
   }

   public function validation()
   {
       return (isset($_POST["name"]) && isset($_POST["main_description"]) && isset($_POST["front_description"]) && isset($_POST["front_date"]) && isset($_POST["front_places_remaining"]) && isset($_POST["price"]) && isset($_POST["difficulties_and_weather"]) && isset($_POST["amount_of_places"]) && isset($_POST["reservation_title"]) && isset($_POST["visa"]) && isset($_POST["image_id"]) && isset($_POST["title_image_id"]) && isset($_POST["amount_activities_items_1"]) && isset($_POST["amount_activities_items_2"]) && isset($_POST["bg_image_id"]) && isset($_POST["activities_title"])) ? true : false;
   }
}