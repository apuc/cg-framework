<?php


namespace workspace\modules\adminlte\widgets;


use core\Widget;

class LeftMenu extends Widget
{
    public $viewPath = '/modules/adminlte/widgets/views/';

    public function run()
    {
        echo $this->render('leftMenu.tpl');
    }
}