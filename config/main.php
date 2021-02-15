<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 15.06.19
 * Time: 0:00
 */

return [
    'app_name' => 'Admin Panel',
    'adminLeftMenu' => [
    ],
    'component_manager' => [
        'repType' => '\\core\\component_manager\\lib\\CurlRep',
        'url' => 'https://rep.craft-group.xyz',
        'modulePath' => '/workspace/modules/',
        'themePath' => '/workspace/modules/themes/themes/',
    ]
];
/* Пример настройки локальной базы
return [
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'db_name' => 'cg',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]
];
*/