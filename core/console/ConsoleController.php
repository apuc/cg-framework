<?php


namespace core\console;


use samejack\PHP\PHP_ArgvParser;

class ConsoleController
{
    /**
     * @var Out
     */
    public $out;
    protected $argv;

    public function __construct()
    {
        $this->out = new Out();
        $argv = $_SERVER['argv'];
        unset($argv[0]);
        unset($argv[1]);
        if(!empty($argv)){
            $argvParser = new PHP_ArgvParser();
            $tmp = implode(" ", $argv);
            $this->argv = $argvParser->parseConfigs($tmp);
        }
    }

}