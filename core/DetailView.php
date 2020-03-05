<?php


namespace core;


class DetailView extends Widget
{
    protected $model;
    protected $options;

    public function run()
    {

    }

    public function setParams($data = [], $options = [])
    {
        $this->model = $data;
        $this->options = $options;
        return $this;
    }
}