<?php


namespace core;


use Illuminate\Support\Arr;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteCollector;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class App
 * @package core
 * @property Header $header
 */
class App
{
    public $routList;

    /**
     * @var array
     */
    static $config = [];

    /**
     * @var $collector CgRouteCollector
     */
    static $collector;

    /**
     * @var array
     */
    static $configList;
    static $responseType = ResponseType::TEXT_HTML;
    static $header;

    /**
     * @var $db Database
     */
    static $db;

    public function setConfig($configListFile = 'list.php')
    {
        App::$configList = (include  (CONFIG_DIR . '/' . $configListFile));
        foreach (App::$configList as $item){
            App::$config = array_merge(App::$config, (include  (CONFIG_DIR . '/' . $item)));
        }
        App::$header = new Header();
        App::$collector = new CgRouteCollector();
        return $this;
    }

    public function setRouting($routListFile = 'list.php')
    {
        $this->routList = (include (ROUTING_DIR . '/' . $routListFile));
        foreach ($this->routList as $item){
            include  (ROUTING_DIR . '/' . $item);
        }
        return $this;
    }

    public function run()
    {
        App::$db = new Database();
        $dispatcher =  new Dispatcher(App::$collector->getData());
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