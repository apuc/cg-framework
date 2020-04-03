<?php

namespace workspace\classes;


class Modules
{
    public $name;
    public $version;
    public $description;

    public function __construct($name, $version, $description)
    {
        $this->name = $name;
        $this->version = $version;
        $this->description = $description;
    }
}