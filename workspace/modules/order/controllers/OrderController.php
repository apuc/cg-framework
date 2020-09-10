<?php

namespace workspace\modules\order\controllers;

use core\App;
use core\Controller;
use core\Debug;
use workspace\modules\order\models\OrderProduct;
use workspace\modules\order\models\Order;
use workspace\modules\order\requests\OrderRequest;
use workspace\modules\order\requests\OrderSearchRequest;
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
        $request = new OrderSearchRequest();
        $model = Order::search($request);

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
                    'label' => 'Тип доставки',
                    'showFilter' => false,
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
        $request = new OrderRequest();
        if($request->isPost() && $request->validate()) {
            $model = new Order();
            $model->city = $request->city;
            $model->email = $request->email;
            $model->fio = $request->fio;
            $model->phone = $request->phone;
            $model->pay = $request->pay;
            $model->delivery = $request->delivery;
            $model->shop_id = $request->shop_id;
            $model->delivery_date = $request->delivery_date;
            $model->delivery_time = $request->delivery_time;
            $model->address = $request->address;
            $model->comment = $request->comment;
            $model->total_price = $request->total_price;
            $model->save();
            $prodmodel = new OrderProduct();
            $prodmodel->order_id = $model->id;
            $prodmodel->product_id = $request->product_id;
            $prodmodel->quantity = $request->quantity;
            $prodmodel->save();
            $xml =  OrderXml::run()->createXml($model,$prodmodel);
            $xml->save();

            Ftp::run(App::$config['FTP'])->putFile(ROOT_DIR.DIRECTORY_SEPARATOR.'test.xml', 'orders'.DIRECTORY_SEPARATOR.'order_'.$model->id.'.xml');
            //ProductXML::run()->executeXML();
            //FtpExchange::run()->sendFile();

            $this->redirect('admin/order');
        } else
            return $this->render('order/store.tpl', ['h1' => 'Добавить заказ','errors' => $request->getMessagesArray()]);
    }

    public function actionEdit($id)
    {
        $model = Order::where('id', $id)->first();
        $prodmodel = OrderProduct::where('order_id', $id)->first();
        $request = new OrderRequest();
        if($request->isPost() && $request->validate()) {
            $model->city = $request->city;
            $model->email = $request->email;
            $model->fio = $request->fio;
            $model->phone = $request->phone;
            $model->pay = $request->pay;
            $model->delivery = $request->delivery;
            $model->shop_id = $request->shop_id;
            $model->delivery_date = $request->delivery_date;
            $model->delivery_time = $request->delivery_time;
            $model->address = $request->address;
            $model->comment = $request->comment;
            $model->total_price = $request->total_price;
            $model->save();
            $this->redirect('admin/order');
        } else
            return $this->render('order/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model, 'prodmodel' => $prodmodel, 'errors' => $request->getMessagesArray()]);
    }

    public function actionDelete()
    {
        OrderProduct::where('order_id', $_POST['id'])->delete();
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