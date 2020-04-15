<?php

namespace workspace\classes;


class Theme
{
    public $id;
    public $theme;
    public $description;
    public $img;
    public $version;
    public $status;

    public function __construct($id, $theme, $description, $img, $version, $status)
    {
        $this->id = $id;
        $this->theme = $theme;
        $this->description = $description;
        $this->img = $img;
        $this->version = $version;
        $this->status = $status;
    }
}