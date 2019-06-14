<?php


namespace core;


use Phroute\Phroute\Dispatcher;

class App
{
    static $config;
    public $rout;
    static $responseType = ResponseType::TEXT_HTML;

    public function setConfig($conf)
    {
        App::$config = (include  (CONFIG_DIR . '/' . $conf));
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
        echo $response;
    }

    public static function start()
    {
        return new self();
    }

}