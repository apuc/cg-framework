<?php


namespace core;


use Illuminate\Support\Arr;
use Phroute\Phroute\Dispatcher;

/**
 * Class App
 * @package core
 * @property Header $header
 */
class App
{
    public $rout;
    static $config;
    static $responseType = ResponseType::TEXT_HTML;
    static $header;

    public function setConfig($conf)
    {
        App::$config = (include  (CONFIG_DIR . '/' . $conf));
        App::$header = new Header();
        return $this;
    }

    public function setRouting($rout)
    {
        $this->rout = (include (ROUTING_DIR . '/' . $rout));
        return $this;
    }

    public function run()
    {
        $dispatcher =  new Dispatcher($this->rout->getData());
        $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        header('Content-Type: ' . App::$responseType);
        App::$header->set();
        echo $response;
    }

    public static function start()
    {
        return new self();
    }

}