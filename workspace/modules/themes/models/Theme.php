<?php


class Theme
{
    public $id;
    public $theme;
    public $description;
    public $img;
    public $version;

    public function __construct($id, $theme, $description, $img, $version)
    {
        $this->id = $id;
        $this->theme = $theme;
        $this->description = $description;
        $this->img = $img;
        $this->version = $version;
    }
}