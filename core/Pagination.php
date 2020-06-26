<?php


namespace core;


class Pagination extends Widget
{
    private $amount_of_data;
    private $amount_of_buttons;
    private $per_page;
    private $page;
    private $buttons;
    private $options;
    private $url;

    public function setParams($url, $amount_of_data, $options)
    {
        $this->amount_of_data = $amount_of_data;
        $this->options = $options;
        $this->url = $url;
        $this->per_page = (isset($this->options['per_page']) && $this->options['per_page']) ? $this->options['per_page'] : 20;
        $this->setPage();

        $this->amount_of_buttons = ceil($this->amount_of_data / $this->per_page);
        $this->generateButtons();

        return $this;
    }

    public function run()
    {
        return $this->getButtons();
    }

    public function getAmountOfData()
    {
        return $this->amount_of_data;
    }

    public function getPerPage()
    {
        return $this->per_page;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage()
    {
        if(isset($_GET['page']) && $_GET['page'])
            $this->page = $_GET['page'];
        else $this->page = 1;
    }

    public function generateButtons()
    {
        $start = '<<';
        $prev = '<';
        $next = '>';
        $end = '>>';
        $class_control = ((isset($this->options['class-control']) && $this->options['class-control']) ? $this->options['class-control'] : 'btn btn-outline-dark');

        $this->buttons = '';

        if($this->page - 1 > 0)
            $this->buttons .= '<div><a href="' .  $this->url . '?page=' . 1 . '" class="' . $class_control .'" title="start">'
                . $start . '</a> <a href="' . $this->url . '?page=' . ($this->page - 1) .'" class="' . $class_control .'" title="previous">' . $prev . '</a> ';

        for($i = 1; $i <= $this->amount_of_buttons; $i++) {
            if($i == $this->page)
                $this->buttons .= '<a href="' . $this->url . '?page=' . $i . '" class="'
                    . ((isset($this->options['class-active']) && $this->options['class-active']) ? $this->options['class-active'] : 'btn btn-secondary') . '">'.$i.'</a> ';
            else
                $this->buttons .= '<a href="' . $this->url . '?page=' . $i . '" class="'
                    . ((isset($this->options['class']) && $this->options['class']) ? $this->options['class'] : 'btn btn-dark') . '">'.$i.'</a> ';
        }

        if($this->page + 1 <= $this->amount_of_buttons)
            $this->buttons .= '<a href="' .  $this->url . '?page=' . ($this->page + 1) . '" class="' . $class_control .'" title="next">'
                . $next . '</a> <a href="' . $this->url . '?page=' . $this->amount_of_buttons .'" class="' . $class_control . '" title="end">' . $end . '</a></div>';
    }

    public function getButtons()
    {
        if($this->amount_of_buttons > 1)
            return $this->buttons;
    }
}