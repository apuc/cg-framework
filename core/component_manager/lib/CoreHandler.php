<?php


namespace core\component_manager\lib;


use core\App;
use core\component_manager\models\Core;
use core\Debug;

class CoreHandler
{
    public static function searchPosition($objects_array, $comparison_object)
    {
        foreach ($objects_array as $i => $object)
            if ($object->version == $comparison_object->version)
                return $i;

        return count($objects_array);
    }

    public static function getCore()
    {
        $active_core = json_decode(file_get_contents('core/manifest.json'))->version;
        $local_cores = json_decode(file_get_contents('mods.json'))->__core;

        $fl = 0;
        foreach ($local_cores as $local_core)
            if($local_core->version == $active_core) {
                $fl = 1;
                break;
            }
        if(!$fl) {
            $cms = new CmService();
            $cms->mod->core_save($active_core);
        }

        $cores = [];
        $server_cores = json_decode(file_get_contents(App::$config['component_manager']['url'] . '/get-core'));
        foreach ($server_cores as $item)
            array_push($cores, new Core($item->version, '', 'server', 'core'));

        foreach ($local_cores as $item) {
            $i = self::searchPosition($cores, $item);
            $cores[$i] = $item;
        }

        return $cores;
    }
}