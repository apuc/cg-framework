<?php


namespace core;


class Widget
{
    /**
     * @var View
     */
    public $view;

    public $viewPath = '/widgets/views/';
    private $defaultViewPath = '/widgets/views/';

    public function __construct()
    {
        $this->view = new View();

        $this->view->setViewPath(WORKSPACE_DIR . $this->viewPath);
    }

    public function run(){}

    public static function widget()
    {
        $class = get_called_class();
        return new $class;
    }

}