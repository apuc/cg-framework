<?php


namespace core;


class GridView extends Widget
{
    protected $model;
    protected $options;
    /*
           available params for $options:
           ['show' => ['#', 'view', 'edit', 'delete', 'model_attr_1', ..., 'model_attr_m']],
           ['table_class' => ['class_1', ..., 'class_m']],
           ['thead_class' => ['class_1', ..., 'class_m']],
           ['th_class' => ['class_1', ..., 'class_m']],
           ['tr_class' => ['class_1', ..., 'class_m']],
           ['td_class' => ['class_1', ..., 'class_m']]
           ['class' => ['class_1', ..., 'class_m']]
       */

    public function run()
    {
        //Debug::prn($this->options);

        echo '<table class="table table-striped custom-table">';
        echo '<thead class="thead-dark"><tr><th scope="col">#</th>';
        foreach ($this->model as $value) {
            $attrs = get_object_vars($value);
            foreach ($attrs['fillable'] as $attr) {
                echo '<th scope="col">'.$attr.'</th>';
            }
            break;
        }
        echo '</tr></thead>';

        $i = 0;
        foreach ($this->model as $value) {
            $attrs = get_object_vars($value);
            echo '<tr><th scope="row">'.$i.'</th>';
            $i++;
            foreach ($attrs['fillable'] as $attr) {
                echo '<td>'.$value->$attr.'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    public function setParams($data = [], $options = [])
    {
        $this->model = $data;
        $this->options = $options;
        return $this;
    }
}