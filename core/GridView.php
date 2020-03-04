<?php


namespace core;


class GridView extends Widget
{
    protected $model;
    protected $options;
    /*
           available params for $options:
           ['fields' => ['#', 'crud_view', 'crud_edit', 'crud_delete', 'crud', 'model_attr_1', ..., 'model_attr_m']],
           ['table_class' => ['class_1 class_2 ... class_m']],
           ['thead_class' => ['class_1 class_2 ... class_m']],
     */

    public function run()
    {
        foreach ($this->options as $option) {
            if(isset($option['fields'])) {
                $fields = array();
                foreach ($option as $value) {
                    for($i = 0; $i < count($value); $i++) {
                       array_push($fields, $value[$i]);
                    }
                }
            } elseif(isset($option['table_class'])) {
                $table_class = '';
                foreach ($option as $value)
                    for($i = 0; $i < count($value); $i++)
                        $table_class .= $value[$i];
            }
            elseif(isset($option['thead_class'])) {
                $thead_class = '';
                foreach ($option as $value)
                    for($i = 0; $i < count($value); $i++)
                        $thead_class .= $value[$i];
            }
        }

        $crud_edit = "<a href='#' style='color: black; text-decoration:none;'><i class=\"nav-icon fas fa-edit\"></i></a>";
        $crud_view = "<a href='#' style='color: black; text-decoration:none;'><i class=\"nav-icon fas fa-eye\"></i></a>";
        $crud_delete = "<a href='#' style='color: black; text-decoration:none;'><i class=\"nav-icon fas fa-trash\"></i></a>";
        $crud = $crud_edit .' '. $crud_view .' '. $crud_delete;
        $crud_head = '<i class="nav-icon fas fa-edit"></i> <i class="nav-icon fas fa-eye"></i> <i class="nav-icon fas fa-trash"></i>';

        if(isset($table_class))
            $table = '<table class="'.$table_class.'">';
        else  $table = '<table class="table table-striped custom-table">';

        if(isset($thead_class))
            $table .= '<thead class="'.$thead_class.'">';
        else  $table .= '<thead class="thead-dark">';
        $table .= '<tr>';

        if(!isset($fields)) {
            return self::tableWithoutOptions($table, $crud_head, $crud);
        } else {
            if(in_array('#', $fields))
                $table .= '<th scope="col">#</th>';
            if(in_array('crud_view', $fields) || in_array('crud_edit', $fields)
                || in_array('crud_delete', $fields) || in_array('crud', $fields))
                $table .= '<th scope="col">'.$crud_head.'</th>';

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
                if (in_array('#', $fields)) {
                    $table .= '<td>'.$j.'</td>';
                    $j++;
                }
                if(in_array('crud_view', $fields) || in_array('crud_edit', $fields)
                    || in_array('crud_delete', $fields) || in_array('crud', $fields)) {
                    $table .= '<td>';

                    if(in_array('crud_view', $fields))
                        $table .= $crud_view.' ';

                    if(in_array('crud_edit', $fields))
                        $table .= $crud_edit.' ';

                    if(in_array('crud_delete', $fields))
                        $table .= $crud_delete.' ';

                    if(in_array('crud', $fields))
                        $table .= $crud;

                    $table .= '</td>';
                }
                foreach ($attrs['fillable'] as $attr) {
                    if(in_array('all', $fields))
                        $table .= '<td>' . $value->$attr . '</td>';
                    else {
                        if(in_array($attr, $fields))
                            $table .= '<td>' . $value->$attr . '</td>';
                    }
                }
                $table .= '</tr>';
            }
            $table .= '</table>';
        }
        return $table;
    }

    public function tableWithoutOptions($table, $crud_head, $crud)
    {
        $table .= '<th scope="col">#</th>';
        $table .= '<th scope="col">'.$crud_head.'</th>';
        foreach ($this->model as $value) {
            $attrs = get_object_vars($value);
            foreach ($attrs['fillable'] as $attr) {
                $table .= '<th>'.$attr.'</th>';
            }
            break;
        }
        $table .= '</tr></thead>';

        $i = 1;
        foreach ($this->model as $value) {
            $attrs = get_object_vars($value);
            $table .= '<tr><th>'.$i.'</th>';
            $i++;
            $table .= '<td>'.$crud.'</td>';
            foreach ($attrs['fillable'] as $attr) {
                $table .= '<td>'.$value->$attr.'</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</table>';
        return $table;
    }

    public function setParams($data = [], $options = [])
    {
        $this->model = $data;
        $this->options = $options;
        return $this;
    }
}