<?php


namespace core;


class GridView extends Widget
{
    public $actionsBtn = [
        'view' => ['class' => 'custom-link', 'id' => '', 'icon' => '<i class="nav-icon fas fa-eye"></i>', 'url' => '/{id}'],
        'edit' => ['class' => 'custom-link', 'id' => '', 'icon' => '<i class="nav-icon fas fa-edit"></i>', 'url' => '/update/{id}'],
        'delete' => ['class' => 'custom-link', 'id' => '', 'icon' => '<i class="nav-icon fas fa-trash"></i>', 'url' => '/delete/{id}'],
    ];

    protected $model;
    protected $options;
    /*
        available params for $options:
            'serial' => '#',
            'actions' => 'view, edit, delete',
            'table_class' => 'class_1 class_2 ... class_m',
            'thead_class' => 'class_1 class_2 ... class_m',
            'baseUri' => 'url',
            'fields' => ['attr_1', ..., 'attr_m']
     */

    public function run()
    {
        $this->view->registerJs(RESOURCES_DIR . '/js/gridView.js');

        return self::getTable();
    }

    public function getTable()
    {
        $table = '';
        $table .= self::setTableSettings($table, 'table', 'table_class', 'table table-striped');
        $table .= self::setTableSettings($table, 'thead', 'thead_class', 'thead-dark');

        $table .= '<tr>';
        if(isset($this->options['serial']))
            $table .= '<th scope="col">'.$this->options['serial'].'</th>';
        if(isset($this->actionsBtn))
            $table .= '<th scope="col"></th>';

        foreach ($this->options['fields'] as $field)
            $fields_keys_array = array_keys($field);

        foreach ($fields_keys_array as $field)
            if(isset($this->options['fields'][0][$field]['label']))
                $table .= '<th scope="col">'.$this->options['fields'][0][$field]['label'].'</th>';
            else
                $table .= '<th scope="col">'.$this->options['fields'][0][$field].'</th>';
        $table .= '</tr>';
        $table .= '</thead>';

        $serial = 1;
        foreach ($this->model as $value) {
            $table .= '<tr>';
            if (isset($this->options['serial']))
                $table .= '<td>'.$serial++.'</td>';

            $table .= '<td>';
            foreach ($this->actionsBtn as $item)
                $table .= $this->createBtn($item, $this->options['baseUri'], $value->id);
            $table .= '</td>';

            foreach ($this->options['fields'][0] as $option) {
                $key = array_search($option, $this->options['fields'][0]); //key of current element
                if(isset($value->$key)) //if model contains key of current element
                    $table .= '<td>'.$value->$key.'</td>';
                else //if key of current element is calculated value
                    $table .= '<td>'.call_user_func($this->options['fields'][0][$key]['value'], $value).'</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</table>';

        return $table;
    }

    public function addActionBtn($data)
    {
        $this->actionsBtn = array_merge($this->actionsBtn, $data);

        return $this;
    }

    public function deleteActionBtn($key)
    {
        unset($this->actionsBtn[$key]);

        return $this;
    }

    protected function createBtn($btn, $url, $id)
    {
        $uri = $url . str_replace('{id}', $id, $btn['url']);

        return '<a class="'. $btn['class'] .'" id="'. $btn['id'] .'" href="'. $uri .'">' . $btn['icon'] . '</a> ';
    }

    public function setParams($data = [], $options = [])
    {
        $this->model = $data;
        $this->options = $options;

        return $this;
    }

    public function setTableSettings($table, $tag, $class, $default_class)
    {
        if(isset($this->options[$class]))
            $table .= '<'.$tag.' class="'.$this->options[$class].'">';
        else  $table .= '<'.$tag.' class="'.$default_class.'">';

        return $table;
    }
}