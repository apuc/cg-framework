<?php

namespace workspace\classes;


class Button
{
    public function button($action, $title, $id, $data_name, $icon)
    {
        return  '<a class="custom-link ' . $action
            .'" title="'. $title
            .'" id="' . $id
            .'" href="#" data-name="'. $data_name
            .'"><i class="nav-icon fas fa-'. $icon .'"></i></a> ';
    }
}