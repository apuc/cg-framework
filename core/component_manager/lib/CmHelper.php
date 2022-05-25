<?php


namespace core\component_manager\lib;


class CmHelper
{
    public static function clearRequest()
    {
        unset($_REQUEST['data']);
        unset($_REQUEST['changed']);
    }

    public static function post_file_get_contents($url, $data)
    {
        $opts = array('http' => ['method' => 'POST', 'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($data)]);
        $context = stream_context_create($opts);

        return json_decode(file_get_contents($url, false, $context));
    }
}