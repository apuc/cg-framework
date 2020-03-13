<?php


namespace core;


class Pagination extends Widget
{
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

    public function setParams($total)
    {
        (isset($_GET['item'])) ? $this->itemsPerPage = $_GET['item'] : $this->itemsPerPage = 5;
        $this->range = 5;
        (isset($_GET['current'])) ? $this->currentPage  = $_GET['current'] : $this->currentPage = 1;
        $this->total = $total;
        $this->textNav = false;
        $this->itemSelect = array(5, 25, 50, 100, 'All');
        $this->_navigation = array(
            'next'=>'Next',
            'pre' =>'Pre',
            'ipp' =>'Item per page'
        );
        $this->_link = filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_STRING);

        $this->_pageNumHtml = $this->_getPageNumbers();
        $this->_itemHtml = $this->_getItemSelect();

        return $this;
    }

    public function pageNumbers()
    {
        return $this->_pageNumHtml;
    }

    public function itemsPerPage()
    {
        return $this->_itemHtml;
    }

    private function _getPageNumbers()
    {
        $html = '<ul>';
        if($this->textNav && $this->currentPage > 1)
            echo '<li><a href="'.$this->_link .'?current='.($this->currentPage-1).'">'.$this->_navigation['pre'].'</a></li>';

        if($this->total > $this->range) {
            $start = ($this->currentPage <= $this->range) ? 1 : ($this->currentPage - $this->range);
            $end = ($this->total - $this->currentPage >= $this->range) ? ($this->currentPage+$this->range) : $this->total;
        } else {
            $start = 1;
            $end = $this->total;
        }

        for($i = $start; $i <= $end; $i++)
            echo '<li><a href="' . $this->_link .'?current=' . $i . '" ' . (($i == $this->currentPage) ? 'class="current"' : '') . '>'.$i.'</a></li>';

        if($this->textNav && $this->currentPage < $this->total)
            echo '<li><a href="' . $this->_link . '?current=' . ($this->currentPage + 1) . '">' . $this->_navigation['next'] . '</a></li>';

        $html .= '</ul>';
        return $html;
    }

    private function  _getItemSelect()
    {
        $items = '';
        $ippArray = $this->itemSelect;
        foreach($ippArray as $ippOpt)
            $items .= ($ippOpt == $this->itemsPerPage) ? "<option selected value=\"$ippOpt\">$ippOpt</option>\n" : "<option value=\"$ippOpt\">$ippOpt</option>\n";

        return "<span class=\"paginate\">".$this->_navigation['ipp']."</span>
            <select class=\"paginate\" onchange=\"window.location='$this->_link?current=1&item='+this[this.selectedIndex].value;return false\">$items</select>\n";
    }

    public function run()
    {

    }
}