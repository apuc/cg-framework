<?php


namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use workspace\models\OrderProduct;
use workspace\modules\order\models\Order;
use workspace\modules\order\services\Ftp;
use workspace\modules\order\services\OrderXml;
use workspace\modules\product\models\Product;
use workspace\modules\product\models\VirtualProduct;

class TestFrontController extends Controller
{
    public $viewPath = '/modules/product/views/front';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/front';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Список товаров', 'url' => 'testfront']);
    }

    public function actionCatalog(){
        {
            $model = Product::all();

            $options = [
                'serial' => '#',
                'fields' => [
                    'name' => [
                        'label' => 'Название'
                    ],
                    'price' => ['label' => 'Цена', 'value' => function ($model) {
                        $vp = VirtualProduct::where('product_id', $model->id)->first();
                        return !empty($vp->price) ? $vp->price : null;
                    }],
                    'buy'=>[
                        'label' => 'КУПИТЬ',
                        'value' => function($model){ return "<a href='/testfront/order/$model->id' class='btn btn-dark'>Купить</a>";}
                    ]
                ],
                'baseUri' => 'product'
            ];

            return $this->render('catalog.tpl', ['h1' => 'Товар', 'model' => $model, 'options' => $options]);
        }
    }
    public function actionOrder($id)
    {
        $options = [
            'serial' => '#',
            'fields' => [
                'name' => [
                    'label' => 'Название'
                ],
                'price' => ['label' => 'Цена', 'value' => function ($product) {
                    $vp = VirtualProduct::where('product_id', $product->id)->first();
                    return !empty($vp->price) ? $vp->price : null;
                }],
            ],
            'baseUri' => 'product'
        ];
        $product = Product::where('id',$id)->take(1)->get();
        if(isset($_POST['city']) && isset($_POST['email']) && isset($_POST['fio']) && isset($_POST['phone']) && isset($_POST['pay']) && isset($_POST['delivery']) && isset($_POST['shop_id']) && isset($_POST['delivery_date']) && isset($_POST['delivery_time']) && isset($_POST['address']) && isset($_POST['comment']) && isset($_POST['quantity'])) {
            $model = new Order();
            $product = Product::where('id',$id)->first();
            $vproduct = VirtualProduct::where('product_id',$id)->first();
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
            $model->total_price = $vproduct->price*$_POST['quantity'];
            $model->save();
            $prodmodel = new OrderProduct();
            $prodmodel->order_id = $model->id;
            $prodmodel->product_id = $product->id;
            $prodmodel->quantity = $_POST['quantity'];
            $prodmodel->save();
            //Debug::dd(OrderXml::run()->createXml($model,$prodmodel)->get());
            $xml =  OrderXml::run()->createXml($model,$prodmodel);
            $xml->save();
//            $data = [
//                'host' => '31.28.9.200',
//                'port' => '21',
//                'login' => 'web-ftp',
//                'pass' => '123edsaqw'
//            ];
            $data = [
                'host' => '95.181.135.186',
                'port' => '1525',
                'login' => 'adminloved',
                'pass' => 'vOU847PwYnG0'
            ];
            Ftp::run($data)->putFile(ROOT_DIR.DIRECTORY_SEPARATOR.'test.xml', 'orders'.DIRECTORY_SEPARATOR.'order_'.$model->id.'.xml');
            //ProductXML::run()->executeXML();
            //FtpExchange::run()->sendFile();

            $options = [
                'serial' => '#',
                'fields' => [
                    'name' => [
                        'label' => 'Название'
                    ],
                    'price' => ['label' => 'Цена', 'value' => function ($product) {
                        $vp = VirtualProduct::where('product_id', $product->id)->first();
                        return !empty($vp->price) ? $vp->price : null;
                    }],
                ],
                'baseUri' => 'product'
            ];

            $this->redirect('catalog');
        } else
            return $this->render('order.tpl', ['h1' => 'Отправить заказ','options'=>$options,'product'=>$product]);
    }

}