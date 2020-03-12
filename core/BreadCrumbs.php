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

    public function getBC()
    {
        $class_name = self::getField('class');
        $class = ($class_name) ? 'class="'.$class_name.'"' : '';
        $separator = self::getField('separator', ' / ');

        $bc = ''; $i = 0;
        foreach ($this->options['items'] as $field)
            ((isset($field['text']) && $field['text'])
                ? ((isset($field['url']) && $field['url'])
                    ? $bc .= (($i++) ? $separator : '').'<a href="/'.$field['url'].'">'.$field['text'].'</a>'
                    : $bc .= (($i++) ? $separator : '').$field['text'])
                : '');

        return '<div ' . $class .'>' . $bc .'</div>';
    }

    public function getField($field_key, $default_value = '')
    {
        return (isset($this->options[$field_key]) && $this->options[$field_key]) ? $this->options[$field_key] : $default_value;
    }

    public function run()
    {
       return self::getBC();
    }
}