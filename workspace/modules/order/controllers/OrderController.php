<?php

namespace workspace\modules\order\controllers;

use core\App;
use core\Controller;
use core\Debug;
use workspace\models\OrderProduct;
use workspace\modules\order\models\Order;
use workspace\modules\order\services\Ftp;
use workspace\modules\order\services\FtpExchange;
use workspace\modules\order\services\OrderXml;
use workspace\modules\product\services\ProductXML;

class OrderController extends Controller
{
    public $viewPath = '/modules/order/views/';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/order/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Заказы']);
    }

    public function actionIndex()
    {
        $model = Order::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'id' => [
                    'label' => 'Номер заказа'
                ],
                'city' => [
                    'label' => 'Город',
                    'showFilter' => false,
                ],
                'email' => [
                    'label' => 'email'
                ],
                'fio' => [
                    'label' => 'ФИО'
                ],
                'phone' => [
                    'label' => 'Телефон'
                ],
                'delivery' => [
                    'label' => 'Тип доставки'
                ],
                'delivery_date' => [
                    'label' => 'Дата доставки',
                    'showFilter' => false,
                ],
            ],
            'baseUri' => 'order',
            //'filters' => false
        ];

        return $this->render('order/order.tpl', ['h1' => 'Заказы', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Order::where('id', $id)->first();

        $options = [
            'fields' => [
                'city' => 'Город',
                'email' => 'Эл. почта',
                'fio' => 'ФИО',
                'phone' => 'Телефон',
                'pay' => 'Тип оплаты',
                'delivery' => 'Тип доставки',
                'shop_id' => 'Номер магазина',
                'delivery_date' => 'Дата доставки',
                'delivery_time' => 'Время доставки',
                'address' => 'Адрес',
                'comment' => 'Комментарий',
                'total_price' => 'Сумма заказа',
            ],
        ];

        return $this->render('order/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['city']) && isset($_POST['email']) && isset($_POST['fio']) && isset($_POST['phone']) && isset($_POST['pay']) && isset($_POST['delivery']) && isset($_POST['shop_id']) && isset($_POST['delivery_date']) && isset($_POST['delivery_time']) && isset($_POST['address']) && isset($_POST['comment']) && isset($_POST['total_price']) && isset($_POST['product_id']) && isset($_POST['quantity'])) {
            $model = new Order();
            $model->city = $_POST['city'];
            $model->email = $_POST['email'];
            $model->fio = $_POST['fio'];
            $model->phone = $_POST['phone'];
            $model->pay = $_POST['pay'];
            $model->delivery = $_POST['delivery'];
            $model->shop_id = $_POST['shop_id'];
            $model->delivery_date = $_POST['delivery_date'];
            $model->delivery_time = $_POST['delivery_time'];
            $model->address = $_POST['address'];
            $model->comment = $_POST['comment'];
            $model->total_price = $_POST['total_price'];
            $model->save();
            $prodmodel = new OrderProduct();
            $prodmodel->order_id = $model->id;
            $prodmodel->product_id = $_POST['product_id'];
            $prodmodel->quantity = $_POST['quantity'];
            $prodmodel->save();
            //Debug::dd(OrderXml::run()->createXml($model,$prodmodel)->get());
            $xml =  OrderXml::run()->createXml($model,$prodmodel);
            $xml->save();

            Ftp::run(App::$config['FTP'])->putFile(ROOT_DIR.DIRECTORY_SEPARATOR.'test.xml', 'orders'.DIRECTORY_SEPARATOR.'order_'.$model->id.'.xml');
            //ProductXML::run()->executeXML();
            //FtpExchange::run()->sendFile();

            $this->redirect('admin/order');
        } else
            return $this->render('order/store.tpl', ['h1' => 'Добавить заказ']);
    }

    public function actionEdit($id)
    {
        $model = Order::where('id', $id)->first();
        $prodmodel = OrderProduct::where('order_id', $id)->first();

        if(isset($_POST['city']) && isset($_POST['email']) && isset($_POST['fio']) && isset($_POST['phone']) && isset($_POST['pay']) && isset($_POST['delivery']) && isset($_POST['shop_id']) && isset($_POST['delivery_date']) && isset($_POST['delivery_time']) && isset($_POST['address']) && isset($_POST['comment']) && isset($_POST['total_price'])) {
            $model->city = $_POST['city'];
            $model->email = $_POST['email'];
            $model->fio = $_POST['fio'];
            $model->phone = $_POST['phone'];
            $model->pay = $_POST['pay'];
            $model->delivery = $_POST['delivery'];
            $model->shop_id = $_POST['shop_id'];
            $model->delivery_date = $_POST['delivery_date'];
            $model->delivery_time = $_POST['delivery_time'];
            $model->address = $_POST['address'];
            $model->comment = $_POST['comment'];
            $model->total_price = $_POST['total_price'];
            $model->save();
            $this->redirect('admin/order');
        } else
            return $this->render('order/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model, 'prodmodel' => $prodmodel]);
    }

    public function actionDelete()
    {
        Order::where('id', $_POST['id'])->delete();
    }

    public function actionUpload($id){
        $model = Order::where('id', $id)->first();
        $prodmodel = OrderProduct::where('order_id', $id)->first();
        $xml =  OrderXml::run()->createXml($model,$prodmodel);
        $xml->save();

        Ftp::run(App::$config['FTP'])->putFile(ROOT_DIR.DIRECTORY_SEPARATOR.'test.xml', 'orders'.DIRECTORY_SEPARATOR.'order_'.$model->id.'.xml');
        $this->redirect('admin/order');
    }
}