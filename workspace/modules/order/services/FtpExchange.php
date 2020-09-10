<?php


namespace workspace\modules\order\services;


use core\Debug;

class FtpExchange
{
    public $login = "adminloved";
    public $password = "vOU847PwYnG0";
    public $host ="95.181.135.186";
    public $port = 1525;
    private $connection;
    public function __construct()
    {
        $this->connect();
    }

    public function connect(){
         $this->connection = ftp_connect($this->host,$this->port);
        if (ftp_login($this->connection, $this->login, $this->password))
        {
            return $this->connection;
        }
        return null;
    }
    public function sendFile($remote_path = '/war/www/html/xml/', $local_file = 'test.xml'){
        //Debug::dd(ROOT_DIR . '/test.xml');
        return ftp_put($this->connection,$remote_path,$local_file,FTP_ASCII);
    }
    public static function run(){
        return new self();
    }
}