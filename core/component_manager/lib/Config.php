<?php

namespace core\component_manager\lib;


class Config
{
    /**
     * @var array|mixed
     */
    public $data = [];
    /**
     * @var $instance
     */
    public static $instance;

    /**
     * Config constructor.
     */
    public function __construct(){
        $this->data = include ROOT_DIR . '/config/config.php';
    }

    /**
     * @return Config
     */
    public static function get()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function byKey(string $key) : ?string
    {
        if(isset($this->data[$key])){
            return $this->data[$key];
        }
        return null;
    }
}