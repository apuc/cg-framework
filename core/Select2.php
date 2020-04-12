<?php


namespace core;


class Select2 extends Widget
{
    protected $model;
    protected $options;

    public function run()
    {
        return $this->getSelect();
    }

    public function setParams($data = [], $options = [])
    {
        $this->model = $data;
        $this->options = $options;

        return $this;
    }

    public function getSelect()
    {
        $result = '<div class="form-group"><label for="' . $this->options['id'] . '">' . $this->options['label'] . '</label>
            <select id="' . $this->options['id'] . '" class="form-control selectpicker ' . $this->options['class']
            . '" required="required" multiple data-live-search="true">';

        $val = $this->options['value'];
        $val_id = $this->options['value_id'];
        foreach ($this->model as $value)
            $result .= '<option value=' . $value->$val_id . '>' . $value->$val . '</option>';

        $result .= '</select></div>';

        return $result;
    }
}