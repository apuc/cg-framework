<?php


namespace core;


class Controller
{

    public $tpl;
    public $layout = 'layouts/main.tpl';
    public $viewPath = '/views/';
    private $defaultViewPath = '/views/';

    /**
     * @var View
     */
    public $view;

    public function __construct()
    {
        $this->view = new View();

        $this->view->setViewPath(WORKSPACE_DIR . $this->viewPath);
    }

    public function render($tpl, $data = [])
    {
        $this->view->tpl->assign('view', $this->view);

        $view = $this->view->getTpl($tpl, $data);

        $this->view->tpl->assign('title', $this->view->title);
        $this->view->tpl->assign('meta', $this->view->getMetaHtml());
        $this->view->tpl->assign('css', $this->view->getCssHtml());
        $this->view->tpl->assign('jsHead', $this->view->getJsHtml());
        $this->view->tpl->assign('jsEndBody', $this->view->getJsHtml(true));

        if(!$this->view->tpl->templateExists($this->layout)){
            $this->tpl->template_dir = WORKSPACE_DIR . $this->defaultViewPath;
        }

        return $this->view->tpl->fetch($this->layout, ['content' => $view]);
    }

    protected function setViewPath($dir)
    {
        $this->tpl->template_dir = WORKSPACE_DIR . $dir;
    }

}