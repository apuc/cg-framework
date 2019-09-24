<?php


namespace core;


class Controller
{

    public $tpl;
    public $layout = 'layouts/main.tpl';

    public function __construct()
    {
        $this->tpl = new \Smarty();

        $this->tpl->template_dir = WORKSPACE_DIR . '/views/';
        $this->tpl->compile_dir = WORKSPACE_DIR . '/views_c/';
        $this->tpl->config_dir = ROOT_DIR . '/cache';
        $this->tpl->cache_dir = ROOT_DIR . '/config';

        $this->tpl->assign('res_dir', RESOURCES_DIR);
        $this->tpl->assign('workspace_dir', WORKSPACE_DIR);
    }

    public function render($tpl, $data = [])
    {
        foreach ((array)$data as $key => $datum) {
            $this->tpl->assign($key, $datum);
        }

        $content = $this->tpl->fetch($tpl);

        return $this->tpl->fetch($this->layout, ['content' => $content]);
    }

}