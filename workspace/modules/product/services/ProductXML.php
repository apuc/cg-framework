<?php
namespace workspace\modules\product\services;

use core\App;
use core\Debug;
use SplFileInfo;
use workspace\modules\order\services\Ftp;
use workspace\modules\product\models\Product;
use workspace\modules\product\models\ProductPhoto;
use workspace\modules\product\models\VirtualProduct;

class ProductXML
{
   private $xml;

   public function executeXML($path = 'product.xml'){
       Ftp::run(App::$config['FTP'])->getFile('product.xml','orders/product.xml');
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
               $file_name = md5(time(). rand(0, 999999));
               $dir = "resources".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."product".DIRECTORY_SEPARATOR."product_".$product->id.DIRECTORY_SEPARATOR;
               if (!file_exists($dir))
                   mkdir($dir, 0775);
               $info =  new SplFileInfo((string)$img->attributes()->src);

               Ftp::run(App::$config['FTP'])->getFile(ROOT_DIR.DIRECTORY_SEPARATOR.$dir.$file_name.".".$info->getExtension(), (string)$img->attributes()->src, FTP_BINARY);
               $photo = new ProductPhoto();
               $photo->product_id = (int)$prod->attributes()->id;
               $photo->photo = $dir.$file_name.".".$info->getExtension();
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