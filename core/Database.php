<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 03.08.19
 * Time: 23:51
 */

namespace core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => App::$config['db']['driver'],
            'host' => App::$config['db']['host'],
            'database' => App::$config['db']['db_name'],
            'user' => App::$config['db']['user'],
            'pass' => App::$config['db']['pass'],
            'charset' => App::$config['db']['charset'],
            'collation' => App::$config['db']['collation'],
            'prefix' => App::$config['db']['prefix'],
        ]);
        // Setup the Eloquent ORM…
        $capsule->bootEloquent();
    }
}