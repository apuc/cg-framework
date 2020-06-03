<?php


namespace core\helpers;


class Form
{

    

    private static function generateAdditionalParams($data)
    {
        $params = '';
        foreach ((array)$data as $key => $datum) {
            $params .= $key . '="' . $datum . '" ';
        }

        return $params;
    }

}