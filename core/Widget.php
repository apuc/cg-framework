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

    public function __construct($data = [])
    {
        $this->view = View::get();

        if (!empty($data)) {
            foreach ($data as $key => $item) {
                $this->{$key} = $item;
                $this->data[$key] = $item;
            }
        }
    }

    public function run()
    {
    }

    public static function widget($data = [])
    {
        $class = get_called_class();
        return new $class($data);
    }

    public function render($tpl, $data = [])
    {
        $currentViewPath = $this->view->getViewPath();
        $this->view->setViewPath(WORKSPACE_DIR . $this->viewPath);
        $res = $this->view->getTpl($tpl, $data);
        $this->view->setViewPath($currentViewPath);

        return $res;
    }
}