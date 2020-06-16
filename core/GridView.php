<?php

namespace workspace\modules\settings;


use core\App;

namespace core;


class GridView extends Widget
{
    public $actionsBtn = [
        'view' => ['class' => 'custom-link', 'id' => '', 'icon' => '<i class="nav-icon fas fa-eye"></i>',
            'url' => '/{id}'],
        'edit' => ['class' => 'custom-link', 'id' => '', 'icon' => '<i class="nav-icon fas fa-edit"></i>',
            'url' => '/update/{id}'],
        'delete' => ['class' => 'custom-link __delete', 'id' => 'delete',
            'icon' => '<i class="nav-icon fas fa-trash"></i>', 'url' => '/delete/{id}'],
    ];

    protected $model;
    protected $options;
    protected $defaultOptions = [
        'filters' => true,
    ];

    /**
     * @var $pagination Pagination
     * available params for $options:
     * 'serial' => '#',
     * 'actions' => 'view, edit, delete',
     * 'table_class' => 'class_1 class_2 ... class_m',
     * 'thead_class' => 'class_1 class_2 ... class_m',
     * 'baseUri' => 'url',
     * 'fields' => ['attr_1', ..., 'attr_m']
     */
    protected $pagination;

    public function run()
    {
        $this->view->registerJs('/resources/js/gridView.js', [], true);

        return self::getTable() . $this->pagination->run();
    }

//    public function setParams($data = [], $options = [])
//    {
//        $this->model = $data;
//        $this->options = array_merge($this->defaultOptions, $options);
//        $this->pagination = Pagination::widget();
//
//        return self::getTable() . $this->pagination->run();
//    }

    public function setParams($data = [], $options = [])
    {
        $this->model = $data;
        $this->options = array_merge($this->defaultOptions, $options);

        $this->pagination = Pagination::widget();

        return $this;
    }

    public function getTable()
    {
        $table = '';
        $table .= self::setTableSettings($table, 'table', 'table_class', 'table table-striped');
        $table .= self::setTableSettings($table, 'thead', 'thead_class', 'thead-dark');

        $table .= '<tr>';

        (isset($this->options['serial'])) ? $table .= '<th scope="col">' . $this->options['serial'] . '</th>' : $table .= '';

        (!empty($this->actionsBtn)) ? $table .= '<th scope="col"></th>' : $table .= '';

        foreach ($this->options['fields'] as $key => $field)
            $table .= '<th scope="col">'
                . ((isset($this->options['fields'][$key]['label']))
                    ? $this->options['fields'][$key]['label']
                    : $this->options['fields'][$key]) . '</th>';

        $table .= '</tr>';
        $table .= '</thead>';

        $this->pagination->setParams($this->options['baseUri'], count($this->model),
            isset($this->options['pagination']) ? $this->options['pagination'] : []);

        $end = $this->pagination->getPage() * $this->pagination->getPerPage();
        $start = ($end - ($this->pagination->getPerPage() - 1)) - 1;

        if ($end > $this->pagination->getAmountOfData())
            $end = $this->pagination->getAmountOfData();

        if ($this->options['filters']) {
            $table .= $this->createFilters($this->options);
        }

        for ($i = $start; $i < $end; $i++) {
            $table .= '<tr>';

            (isset($this->options['serial'])) ? $table .= '<td>' . ($i + 1) . '</td>' : $table .= '';

            if (!empty($this->actionsBtn)) {
                $table .= '<td>';
                foreach ((array)$this->actionsBtn as $item)
                    $table .= $this->createBtn($item, $this->options['baseUri'], $this->model[$i]->id);
                $table .= '</td>';
            }

            foreach ($this->options['fields'] as $key => $option)
                if(isset($this->model[$i]->$key))
                    $table .= '<td>' . $this->model[$i]->$key . '</td>';
                elseif(isset($this->options['fields'][$key]['label']))
                    $table .= '<td>' . call_user_func($this->options['fields'][$key]['value'], $this->model[$i])
                        . '</td>';
                else
                    $table .= '<td></td>';

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

    public function createFilters($options)
    {
        $html = '<tr><form class="__filterForm">';
        $html .= isset($options['serial']) ? '<td></td>' : '';
        $html .= !empty($this->actionsBtn) ? '<td></td>' : '';
        foreach ($options['fields'] as $key => $field) {
            if (isset($field['showFilter']) && !$field['showFilter']) {
                $html .= '<td></td>';
            } else {
                $val = isset($_GET[$key . 'Search']) ? $_GET[$key . 'Search'] : '';
                $html .= '<td><input class="form-control __filter" type="text" name="' . $key . 'Search" value="'. $val .'"></td>';
            }
        }
        $html .= '</form></tr>';

        return $html;
    }

    protected function createBtn($btn, $url, $id)
    {
        $uri = $url . str_replace('{id}', $id, $btn['url']);
        $data_url = $url . str_replace('{id}', '', $btn['url']);

        return '<a class="' . $btn['class'] . '" id="' . $btn['id'] . '" href="' . $uri . '" data-id="' . $id
            . '" data-url="' . $data_url . '">' . $btn['icon'] . '</a> ';
    }

    public function setTableSettings($table, $tag, $class, $default_class)
    {
        $table .= '<' . $tag . ' class="' . ((isset($this->options[$class])) ? $this->options[$class] : $default_class) . '">';

        return $table;
    }

    private function generateAdditionalParams($data)
    {
        $params = '';
        foreach ((array)$data as $key => $datum) {
            $params .= $key . '="' . $datum . '" ';
        }

        return $params;
    }
}