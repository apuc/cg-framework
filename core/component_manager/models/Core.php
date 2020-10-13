<?php


namespace core\component_manager\models;


class Core
{
    public $version;
    public $status;
    public $localStatus;
    public $type;

    /**
     * @param string $version
     * @param string $status
     * @param string $localStatus
     * @param string $type
     */
    public function __construct(string $version, string $status, string $localStatus, string $type)
    {
        $this->version = $version;
        $this->status = $status;
        $this->localStatus = $localStatus;
        $this->type = $type;
    }
}