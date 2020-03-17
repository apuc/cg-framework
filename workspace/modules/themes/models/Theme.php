<?php


class Theme
{
    public $id;
    public $theme;

    public function __construct($id, $theme)
    {
        $this->id = $id;
        $this->theme = $theme;
    }
}