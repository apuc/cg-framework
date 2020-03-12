<?php


namespace core;


class Pagination extends Widget
{
    public $options;

    public $itemsPerPage;
    public $range;
    public $currentPage;
    public $total;
    public $textNav;
    public $itemSelect;

    private $_navigation;
    private $_link;
    private $_pageNumHtml;
    private $_itemHtml;

    public function setParams($options = [])
    {
        $this->options = $options;

        $this->itemsPerPage = 5;
        $this->range        = 5;
        $this->currentPage  = 1;
        $this->total        = 0;
        $this->textNav      = false;
        $this->itemSelect   = array(5,25,50,100,'All');

        //private values
        $this->_navigation  = array(
            'next'=>'Next',
            'pre' =>'Pre',
            'ipp' =>'Item per page'
        );
        $this->_link         = filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_STRING);
        $this->_pageNumHtml  = '';
        $this->_itemHtml     = '';

        return $this;
    }

    public function run()
    {

    }
}