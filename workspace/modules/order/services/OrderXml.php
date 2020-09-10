<?php
namespace workspace\modules\order\services;

class OrderXml
{
    private $xml;

    public function createXml ($order,$product){
        $this->xml = simplexml_load_file('order.xml');
        $this->xml->attributes()->date = $order->created_at->format("Y-m-d h:m");
        $this->xml->id = $order->id;
        $this->xml->city = $order->city;
        $this->xml->email = $order->email;
        $this->xml->fio = $order->fio;
        $this->xml->phone = $order->phone;
        $this->xml->pay = $order->pay;
        $this->xml->delivery = $order->delivery;
        $this->xml->shop_id = $order->shop_id;
        $this->xml->delivery_date = $order->delivery_date;
        $this->xml->delivery_time = $order->delivery_time;
        $this->xml->address = $order->address;
        $this->xml->comment = $order->comment;
        $this->xml->products->addChild('product')->addAttribute('id',$product->product_id);
        $this->xml->products->product->addChild('amount',$order->total_price);
        $this->xml->products->product->addChild('quantity',$product->quantity);
        return $this;
    }

    public function save() {
        return $this->xml->asXML('test.xml');
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