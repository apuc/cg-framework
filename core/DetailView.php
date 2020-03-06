<?php


namespace core;


class DetailView extends Widget
{
    protected $model;
    protected $options;

    public function run()
    {
        return self::getTable();
    }

    public function setParams($data = [], $options = [])
    {
        $this->model = $data;
        $this->options = $options;
        return $this;
    }

    public function getTable()
    {
        $table = '';
        $table .= self::setTableSettings($table, 'table', 'table_class', 'table table-striped');
        $table .= self::setTableSettings($table, 'thead', 'thead_class', 'thead-dark');
        $table .= '<tr><th scope="col">Ключ</th><th scope="col">Значение</th></tr></thead>';

        foreach ($this->options['fields'] as $option) {
            $table .= '<tr>';
            $key = array_search($option, $this->options['fields']); //key of current element
            if(isset($this->model->$key)) //if model contains key of current element
                $table .= '<td>'.$this->options['fields'][$key].'</td>'
                        . '<td>'.$this->model->$key.'</td>';
            else //if key of current element is calculated value
                $table .= '<td>'.$this->options['fields'][$key]['label'].'</td>'
                        . '<td>'.call_user_func($this->options['fields'][$key]['value'], $this->model).'</td>';
            $table .= '</tr>';
        }
        $table .= '</table>';

        return $table;
    }

    public function setTableSettings($table, $tag, $class, $default_class)
    {
        if(isset($this->options[$class]))
            $table .= '<'.$tag.' class="'.$this->options[$class].'">';
        else  $table .= '<'.$tag.' class="'.$default_class.'">';

        return $table;
    }
}