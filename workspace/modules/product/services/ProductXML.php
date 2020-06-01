<?php
namespace workspace\modules\product\services;

use core\Debug;
use workspace\modules\product\models\Product;
use workspace\modules\product\models\ProductPhoto;
use workspace\modules\product\models\VirtualProduct;

class ProductXML
{
   private $xml;

   public function executeXML($path = 'product.xml'){
       $this->xml = simplexml_load_file($path);
       foreach ($this->xml->product as $prod){
           if(Product::where('id',(int)$prod->attributes()->id)->first()) continue;
           $product = new Product();
           $product->id = (int)$prod->attributes()->id;
           $product->name = (string)$prod->title;
           $product->title = (string)$prod->title;
           $product->description = (string)$prod->description;
           $virtual_product = new VirtualProduct();
           $virtual_product->product_id = (int)$prod->attributes()->id;
           $virtual_product->price = (float)$prod->price;
           $product->save();
           $virtual_product->save();

           foreach ($prod->images->image as $img){
               $photo = new ProductPhoto();
               $photo->product_id = (int)$prod->attributes()->id;
               $photo->photo =(string)$img->attributes()->src;
               $photo->save();
           }
       }
   }

   public function save(){
       $product = new Product();
   }

    public function getXML(){
        return $this->xml->asXML();
    }

    public function getXmlObj(){
        return $this->xml;
    }

    public static function run(){
        return new self();
    }
}