<?php


namespace workspace\widgets;


use core\Widget;

class Main extends Widget
{

    public function run()
    {
        echo $this->render('main.tpl', ['text' => 'Это виджет']);
    }

}