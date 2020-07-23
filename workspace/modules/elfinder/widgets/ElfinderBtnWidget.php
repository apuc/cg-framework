<?php


namespace workspace\modules\elfinder\widgets;


class ElfinderBtnWidget extends ElfinderWidget
{
    protected $name;

    public function run()
    {
        $this->regCss();
        $this->regJs();
        return $this->view->getTpl('select-form.tpl', ['name' => $this->name]);
    }

}