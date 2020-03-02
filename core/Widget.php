<?php


namespace core;


class Widget
{
    /**
     * @var View
     */
    public $view;

    public function __construct()
    {
        $this->view = new View();

        $this->view->setViewPath(WORKSPACE_DIR . '/widgets/views/');
    }

    public function run(){}

    public static function widget()
    {
        $class = get_called_class();
        return new $class;
    }

}