<?php

require_once __DIR__ . "/Ftp.php";

$data = [
    'host' => '31.28.9.200',
    'port' => '21',
    'login' => 'web-ftp',
    'pass' => '123edsaqw'
];

/**
 * загружаем файл
 */
$res1 = Ftp::run($data)->putFile('sites.xml', 'html/xml/sites2.xml');
var_dump($res1);

/**
 * скачиваем файл
 */
$res2 = Ftp::run($data)->getFile('index.html', 'html/index.html');
var_dump($res2);


//ftp_close($open); //Закрыли поток