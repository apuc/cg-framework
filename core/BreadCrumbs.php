<?php


namespace core;


class BreadCrumbs extends Widget
{
    public $options;

    public function setParams($options = [])
    {
       $this->options = $options;

        return $this;
    }

    public function addItem(array $data)
    {
        if($data && isset($data['text']))
            $this->options['items'][] = $data;
    }

    public function getBC()
    {
        $class_name = $this->getField('class');
        $class = ($class_name) ? 'class="'.$class_name.'"' : '';
        $separator = $this->getField('separator', ' / ');

        $bc = ''; $i = 0;
        foreach ($this->options['items'] as $field)
            if(isset($field['text']) && $field['text'])
                $bc .= (($i++) ? $separator : '') . '<span '
                    . ((isset($field['class']) && $field['class'])
                        ? ' class="'.$field['class'].'">'
                        : '>')
                    . ((isset($field['url']) && $field['url'])
                        ? '<a href="/' . $field['url'] . '">' . $field['text'] . '</a></span>'
                        : $field['text'].'</span>');

        return '<div ' . $class .'>' . $bc .'</div>';
    }

    public function getField($field_key, $default_value = '')
    {
        return (isset($this->options[$field_key]) && $this->options[$field_key]) ? $this->options[$field_key] : $default_value;
    }

    public function run()
    {
       return $this->getBC();
    }
}