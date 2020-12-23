<?php


namespace core;


class Select2 extends Widget
{
    protected $model;
    protected $options;
    protected $selected;

    public function run()
    {
        if(is_array($this->model)) {
            return $this->getSelectByArray();
        } else {
            return $this->getSelect();
        }
    }

    public function setParams($data = [], $options = [], $selected = [])
    {
        $this->model = $data;
        $this->options = $options;
        $this->selected = $selected;

        return $this;
    }

    public function getSelect()
    {
        $result = '<div class="form-group"><label for="' . $this->options['id'] . '">' . $this->options['label'] . '</label>
            <select id="' . $this->options['id'] . '" name="'.$this->options['id'].'[]" multiple="multiple" class="select2 selectpicker form-control' . $this->options['class']
            . '" required="required" multiple data-live-search="true">';

        $val = $this->options['value'];
        $val_id = $this->options['value_id'];
        foreach ($this->model as $value) {
            if (in_array($value->$val_id, $this->selected))
                $result .= '<option value=' . $value->$val_id . ' selected>' . $value->$val . '</option>';
            else
                $result .= '<option value=' . $value->$val_id . '>' . $value->$val . '</option>';
        }

        $result .= '</select></div>';

        return $result;
    }

    public function getSelectByArray()
    {
        $result = '';

        if(isset($this->options['id']) && isset($this->options['label'])) {
            $result .= '<div class="form-group"><label for="' . $this->options['id'] . '">' . $this->options['label']
                . '</label>
                <select type="text" id="' . $this->options['id'] . '" name="'.$this->options['id']
                . '" class="select2 selectpicker form-control' . $this->options['class']
                . '" required="required" >';
        } else {
            $result .= '<select type="text" text="Select tag" name="' . $this->options['id'] .
                'Search" class="select2 selectpicker form-control' . $this->options['class']
                . '" value="" >';
            $result .= '<option></option>'; //TODO
        }

        foreach ($this->model as $key => $value) {
            if (!empty($this->selected) && in_array($key, $this->selected))
                $result .= '<option value=' . $key . ' selected>' . $value . '</option>';
            else
                $result .= '<option value=' . $key . '>' . $value . '</option>';
        }



        $result .= isset($this->options['label']) ? '</select></div>' : '</select>';
        return $result;
    }
}
