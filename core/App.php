<?php


namespace core;


use Phroute\Phroute\Dispatcher;

class App
{
    public $config;
    public $rout;

    public function setConfig($conf)
    {
        $this->config = (include  (CONFIG_DIR . '/' . $conf));
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
        echo $response;
    }

    public static function start()
    {
        return new self();
    }

}