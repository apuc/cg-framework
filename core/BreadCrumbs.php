<?php


namespace core;


class BreadCrumbs extends Widget
{
    public $module;
    public $name;
    public $action;

    public function setParams($module, $name = '', $action = '')
    {
        $this->module = $module;
        $this->name= $name;
        $this->action = $action;

        return $this;
    }

    public function run()
    {
        if(isset($name) && isset($action))
        return '<a href="/'.$this->module.'">'.$this->module.'</a> > ' . $this->name . ' > ' . $this->action;
    }
}