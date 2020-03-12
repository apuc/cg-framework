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
        $main_url = self::getField('main_url');
        $main = self::getField('main');
        $module_url = self::getField('module_url');
        $module = self::getField('module');
        $item_id = self::getField('item_id');
        $item = self::getField('item');
        $action = self::getField('action');

        self::getField('main_url');

        $main_link = ($main_url && $main) ? '<a href="/'.$main_url.'">'.$main.'</a>' : '';

        $module_link = ($module_url && $module) ? (($main_link) ? $separator : '') . '<a href="/'.$module_url.'">'.$module.'</a>' : '';

        $item_link = ($item_id && $item && $module_url) ? (($module_link || $main_link) ? $separator : '') . '<a href="/'.$module_url.'/'.$item_id.'">'.call_user_func($item, $item_id).'</a>' : '';

        $action_link = ($action) ? (($module_link || $main_link || $item_link) ? $separator : '') . $action : '';

        return '<div ' . $class .'>' . $main_link . $module_link . $item_link . $action_link .'</div>';
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