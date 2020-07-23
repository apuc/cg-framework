<?php


namespace workspace\modules\elfinder\widgets;


class ElfinderBtnWidget extends ElfinderWidget
{
    protected $name;
    protected $value;
    protected $label = 'Файлы';
    protected $btnClass = 'btn btn-dark';
    protected $btnValue = 'Выбрать';

    public function run()
    {
        $this->regCss();
        $this->regJs();
        return $this->view->getTpl('select-form.tpl', [
            'name' => $this->name,
            'value' => $this->value,
            'label' => $this->label,
            'btnClass' => $this->btnClass,
            'btnValue' => $this->btnValue,
        ]);
    }

}