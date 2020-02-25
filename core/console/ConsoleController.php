<?php


namespace core\console;


class ConsoleController
{
    /**
     * @var Out
     */
    public $out;

    public function __construct()
    {
        $this->out = new Out();
    }

}