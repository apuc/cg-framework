<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 15.06.19
 * Time: 1:59
 */

namespace core;


class VueForm
{

    public static function find($id)
    {
        if(method_exists(static::class, $id)){
            return static::$id();
        }
        return ['error' => 'form not found'];
    }

}