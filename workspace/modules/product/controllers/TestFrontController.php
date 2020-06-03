<?php


namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use workspace\modules\order\models\OrderProduct;
use workspace\modules\order\models\Order;
use workspace\modules\order\services\Ftp;
use workspace\modules\order\services\OrderXml;
use workspace\modules\product\models\Product;
use workspace\modules\product\models\ProductPhoto;
use workspace\modules\product\models\VirtualProduct;
use workspace\modules\product\requests\FrontRequest;

class TestFrontController extends Controller
{
    public $viewPath = '/modules/product/views/front';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/front';
        //$this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Список товаров', 'url' => 'testfront']);
    }

    public function actionCatalog(){
        {
            $model = Product::all();

            $options = [
                'serial' => '#',
                'fields' => [
                    'photo' => ['label' => 'Фото', 'value' => function ($model) {
                        $photo = ProductPhoto::where('product_id', $model->id)->first();
                        return !empty($photo->photo) ? "<img src='$photo->photo' style='max-width: 100px'/>" : null;
                    }],
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
                    ],
                    'show'=>[
                        'label' => 'Просмотреть',
                        'value' => function($model){ return "<a href='/testfront/oneproduct/$model->id' class='btn btn-dark'>Просмотреть</a>";}
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
        $request = new FrontRequest();
        if($request->isPost() && $request->validate()) {
            $model = new Order();
            $product = Product::where('id',$id)->first();
            $vproduct = VirtualProduct::where('product_id',$id)->first();
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
            $model->total_price = $vproduct->price*$request->quantity;
            $model->save();
            $prodmodel = new OrderProduct();
            $prodmodel->order_id = $model->id;
            $prodmodel->product_id = $product->id;
            $prodmodel->quantity = $request->quantity;
            $prodmodel->save();
            $xml =  OrderXml::run()->createXml($model,$prodmodel);
            $xml->save();
            Ftp::run(App::$config['FTP'])->putFile(ROOT_DIR.DIRECTORY_SEPARATOR.'test.xml', 'orders'.DIRECTORY_SEPARATOR.'order_'.$model->id.'.xml');

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
            return $this->render('order.tpl', [
                'h1' => 'Отправить заказ',
                'options'=>$options,
                'product'=>$product,
                'errors' => $request->getMessagesArray(),
                ]);
    }

    public function actionOneProduct($id)
    {
        $model = Product::where('id', $id)->first();
        $photo = ProductPhoto::where('product_id', $model->id)->first();
        $options = [
            'fields' => [
                'id'=>'Номер товара',
                'photo' => ['label' => 'Фото', 'value' => function ($model) {
                    $photo = ProductPhoto::where('product_id', $model->id)->first();
                    return !empty($photo->photo) ? "<img src='/$photo->photo' style='max-width: 100px'/>" : null;
                }],
                'name' => 'Название',
                'description' => 'Описание',
                'price' => ['label' => 'Цена', 'value' => function ($model) {
                    $vp = VirtualProduct::where('product_id', $model->id)->first();

                    return !empty($vp->price) ? $vp->price : null;
                }],
                'status' => 'Статус',
                'buy'=>[
                    'label' => 'КУПИТЬ',
                    'value' => function($model){ return "<a href='/testfront/order/$model->id' class='btn btn-dark'>Купить</a>";}
                ]
            ],
        ];

        return $this->render('product.tpl', ['model' => $model, 'options' => $options, 'photo'=>$photo]);
    }

}