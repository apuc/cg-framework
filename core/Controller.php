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
        $this->tpl = new \Smarty();
        $this->view = new View();

        $this->tpl->template_dir = WORKSPACE_DIR . $this->viewPath;
        $this->tpl->compile_dir = WORKSPACE_DIR . '/views_c/';
        $this->tpl->config_dir = ROOT_DIR . '/config';
        $this->tpl->cache_dir = ROOT_DIR . '/cache';

        $this->tpl->assign('res_dir', RESOURCES_DIR);
        $this->tpl->assign('workspace_dir', WORKSPACE_DIR);
        $this->tpl->assign('title', $this->view->title);
    }

    public function render($tpl, $data = [])
    {
        $this->tpl->assign('view', $this->view);
        foreach ((array)$data as $key => $datum) {
            $this->tpl->assign($key, $datum);
        }

        $view = $this->tpl->fetch($tpl);

        $this->tpl->assign('title', $this->view->title);
        $this->tpl->assign('meta', $this->view->getMetaHtml());
        $this->tpl->assign('css', $this->view->getCssHtml());
        $this->tpl->assign('jsHead', $this->view->getJsHtml());
        $this->tpl->assign('jsEndBody', $this->view->getJsHtml(true));

        if(!$this->tpl->templateExists($this->layout)){
            $this->tpl->template_dir = WORKSPACE_DIR . $this->defaultViewPath;
        }

        return $this->tpl->fetch($this->layout, ['content' => $view]);
    }

    public function getTpl($tpl, $data = [])
    {
        foreach ((array)$data as $key => $datum) {
            $this->tpl->assign($key, $datum);
        }

        return $this->tpl->fetch($tpl);
    }

    protected function setViewPath($dir)
    {
        $this->tpl->template_dir = WORKSPACE_DIR . $dir;
    }

}