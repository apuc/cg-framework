<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 16.06.19
 * Time: 0:22
 */

namespace core;


class Header
{
    protected $list = [];

    public function add($key, $value)
    {
        $this->list[$key] = $value;
    }

    public function set()
    {
        foreach ($this->list as $key=>$v){
            header($key . ": " . $v);
        }
    }

}