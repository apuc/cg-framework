<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use core\Debug;
use workspace\modules\product\models\Product;
use workspace\modules\product\models\ProductPhoto;
use workspace\modules\product\models\VirtualProduct;
use workspace\modules\product\requests\ProductRequest;
use workspace\modules\product\requests\ProductSearchRequest;
use workspace\modules\product\services\ProductXML;

class ProductController extends Controller
{
    public $viewPath = '/modules/product/views/product';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/product';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Товары', 'url' => 'product']);
    }

    public function actionIndex()
    {
        $request = new ProductSearchRequest();
        $model = Product::search($request);

        $options = [
            'serial' => '#',
            'fields' => [
                'name' => [
                    'label' => 'Название'
                ],
                'price' => ['label' => 'Цена', 'value' => function ($model) {
                    return isset($model->vp->first()->price) ? $model->vp->first()->price : null;
                }],
            ],
            'baseUri' => 'product',
        ];

        return $this->render('product.tpl', ['h1' => 'Товар', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Product::where('id', $id)->first();

        $options = [
            'fields' => [
                'id' => 'Номер товара',
                'name' => 'Название',
                'description' => 'Описание',
                'price' => ['label' => 'Цена', 'value' => function ($model) {
                    $vp = VirtualProduct::where('product_id', $model->id)->first();

                    return !empty($vp->price) ? $vp->price : null;
                }],
                'status' => 'Статус',
            ],
        ];

        return $this->render('view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        $request = new ProductRequest();
        if ($request->isPost() && $request->validate()) {
            $model = new Product();
            $model->name = $request->name;
            $model->title = $request->name;
            $model->description = $request->description;
            $model->status = $request->status;
            $model->save();
            $virtual_product = new VirtualProduct();
            $virtual_product->product_id = $model->id;
            $virtual_product->price = $request->price;
            $virtual_product->save();
            $this->redirect('admin/product');
        } else
            return $this->render('store.tpl', [
                'h1' => 'Добавить товар',
                'errors' => $request->getMessagesArray()
            ]);
    }

    public function actionEdit($id)
    {
        $model = Product::where('id', $id)->first();
        $virtual_product = VirtualProduct::where('product_id', $id)->first();

        $request = new ProductRequest();
        if ($request->isPost() && $request->validate()) {
            $model->name = $request->name;
            $model->title = $request->name;
            $model->description = $request->description;
            $model->status = $request->status;
            $model->save();
            $virtual_product->product_id = $model->id;
            $virtual_product->price = $request->price;
            $virtual_product->save();
            $this->redirect('admin/product');
        } else
            return $this->render('edit.tpl', [
                'h1' => 'Редактировать: ',
                'model' => $model,
                'virtual_product' => $virtual_product,
                'errors' => $request->getMessagesArray()
            ]);
    }

    public function actionDelete()
    {
        ProductPhoto::where('product_id', $_POST['id'])->delete();
        VirtualProduct::where('product_id', $_POST['id'])->delete();
        Product::where('id', $_POST['id'])->delete();
    }

    public function actionDownload()
    {
        ProductXML::run()->executeXML();
        $this->redirect('admin/product');
    }
}
