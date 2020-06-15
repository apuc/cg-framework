<?php
namespace workspace\modules\order\services;


use core\Debug;

class Ftp
{
    private $host;
    private $port;
    private $login;
    private $pass;
    private $connection;

    public function __construct($data)
    {
        $this->host = $data['host'];
        $this->login = $data['login'];
        $this->port = $data['port'];
        $this->pass = $data['pass'];

        $this->connection = ftp_connect($this->host, $this->port);
        if (!ftp_login($this->connection, $this->login, $this->pass))
            exit("Не могу соединиться");
        ftp_pasv($this->connection, true);
    }

    /**
     * @param string $dir
     * @return array|false
     */
    public function getList($dir = "")
    {
        return ftp_nlist($this->connection, $dir);
    }

    /**
     * @param $localFile
     * @param $remoteFile
     * @param int $mode
     * @return bool|null
     */
    public function putFile($localFile, $remoteFile, $mode = FTP_ASCII)
    {
        if (ftp_put($this->connection, $remoteFile, $localFile, $mode)) {
            return true;
        }
        return null;
    }

    /**
     * @param $localFile
     * @param $remoteFile
     * @param int $mode
     * @return bool|null
     */
    public function getFile($localFile, $remoteFile, $mode = FTP_ASCII)
    {
        if (ftp_get($this->connection, $localFile, $remoteFile, $mode)) {
            return true;
        }
        return null;
    }

    /**
     * @param $data
     * @return Ftp
     */
    public static function run($data)
    {
        return new self($data);
    }

}