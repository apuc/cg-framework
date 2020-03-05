<?php


namespace core;


class GridView extends Widget
{
    public $actionsBtn = [
        'view' => ['class' => '', 'id' => '', 'icon' => '<i class="nav-icon fas fa-eye"></i>', 'url' => '{id}'],
        'edit' => ['class' => '', 'id' => '', 'icon' => '<i class="nav-icon fas fa-edit"></i>', 'url' => '/update/{id}'],
        'delete' => ['class' => '', 'id' => '', 'icon' => '<i class="nav-icon fas fa-trash"></i>', 'url' => '/delete/{id}'],
    ];

    protected $model;
    protected $options;
    /*
           available params for $options:
           'fields' => ['#', 'crud_view', 'crud_edit', 'crud_delete', 'crud', 'model_attr_1', ..., 'model_attr_m'],
           'table_class' => 'class_1 class_2 ... class_m',
           'thead_class' => 'class_1 class_2 ... class_m',
           'url' => 'url'
     */

    public function run()
    {
        $this->view->registerJs(RESOURCES_DIR . '/js/gridView.js');

        return self::getTable();
    }

    public function getTable()
    {
        Debug::dd($this->options);
        //переделать получение параметров

        //разделить на методы
        $fields = array();
        if(isset($this->options['fields']))
            foreach ($this->options['fields'] as $field)
                array_push($fields, $field);

        if(isset($this->options['table_class']))
            $table = '<table class="'.$this->options['table_class'].'">';
        else  $table = '<table class="table table-striped custom-table">';

        if(isset($this->options['thead_class']))
            $table .= '<thead class="'.$this->options['thead_class'].'">';
        else  $table .= '<thead class="thead-dark">';
        $table .= '<tr>';

        if(isset($fields)) {
            if(in_array('#', $fields))
                $table .= '<th scope="col">#</th>';
            if(in_array('crud_view', $fields) || in_array('crud_edit', $fields)
                || in_array('crud_delete', $fields) || in_array('crud', $fields))
                $table .= '<th scope="col"><i class="nav-icon fas fa-eye"></i> <i class="nav-icon fas fa-edit"></i> <i class="nav-icon fas fa-trash"></i></th>';

            if(in_array('all', $fields))
                foreach ($this->model as $value) {
                    $attrs = get_object_vars($value);
                    foreach ($attrs['fillable'] as $attr)
                        $table .= '<th scope="col">'.$attr.'</th>';
                    break;
                }
            else
                foreach ($this->model as $value) {
                    $attrs = get_object_vars($value);
                    foreach ($attrs['fillable'] as $attr)
                        if(in_array($attr, $fields))
                            $table .= '<th scope="col">'.$attr.'</th>';
                    break;
                }

            $table .= '</tr>';
            $table .= '</thead>';

            $j = 1;
            foreach ($this->model as $value) {
                $attrs = get_object_vars($value);
                if (in_array('#', $fields))
                    $table .= '<td>'.$j++.'</td>';

                if(in_array('crud_view', $fields) || in_array('crud_edit', $fields)
                    || in_array('crud_delete', $fields) || in_array('crud', $fields)) {

                    $table .= '<td>';

                    foreach ($this->actionsBtn as $item)
                        $table .= $this->createBtn($item, $this->options['url'], $value->id);

                    $table .= '</td>';
                }
                foreach ($attrs['fillable'] as $attr)
                    if(in_array('all', $fields))
                        $table .= '<td>' . $value->$attr . '</td>';
                    else
                        if(in_array($attr, $fields))
                            $table .= '<td>' . $value->$attr . '</td>';
                $table .= '</tr>';
            }
            $table .= '</table>';
        }

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

        return '<a class="'. $btn['class'] .'" id="'. $btn['id'] .'" href="'. $uri .'">' . $btn['icon'] . '</a>';
    }

    public function setParams($data = [], $options = [])
    {
        $this->model = $data;
        $this->options = $options;

        return $this;
    }
}