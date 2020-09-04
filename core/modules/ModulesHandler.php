<?php


namespace core\modules;


use core\Authorization;
use core\component_manager\lib\CM;
use core\component_manager\lib\CmService;
use core\component_manager\lib\Mod;
use core\Debug;
use Exception;

class ModulesHandler
{
    public function getAllModules()
    {
        $mod = new Mod();
        $local_modules = $mod->getLocModByFolder('workspace/modules/');
        $server_modules = json_decode(file_get_contents('http://rep.loc/server-modules'));

        for ($i = 0; $i < count($server_modules); $i++)
            for ($j = 0; $j < count($server_modules[$i]); $j++)
                foreach ($local_modules as $key => $local_module) {
                    $manifest = json_decode(file_get_contents('workspace/modules/' . $local_module . '/manifest.json'));
                    if ($manifest->name == $server_modules[$i][$j]->name && $manifest->version == $server_modules[$i][$j]->version) {
                        $module = new Modules();
                        $module->init($manifest->name, $manifest->version, $manifest->description, $mod->getModInfo($local_module)['status'], 'local');
                        $server_modules[$i][$j] = $module;
                        unset($local_modules[$key]);
                    }
                }
        if (isset($local_modules))
            foreach ($local_modules as $local_module) {
                $manifest = json_decode(file_get_contents('workspace/modules/' . $local_module . '/manifest.json'));
                $module = new Modules();
                $module->init($manifest->name, $manifest->version, $manifest->description, $mod->getModInfo($local_module)['status'], 'local');
                $mod_arr = [];
                array_push($mod_arr, $module);
                array_push($server_modules, $mod_arr);
            }
        file_put_contents('modules.json', json_encode($server_modules));

        return $server_modules;
    }

    public function compare($array, $object)
    {
        foreach ($array as $key => $value)
            if ($value->name == $object->name && $value->version == $object->version)
                return $key;
        return false;
    }

    public function upload()
    {
        try {
            $cm = new CM();
            return json_decode($cm->upload($_POST['data']));
        } catch (Exception $e) {
            return $e;
        }
    }

    public function download()
    {
        try {
            $cm = new CM();
            $cm->download($_POST['data']);

            $data = json_decode($_POST['data']);
            $rel_arr = $this->post_file_get_contents('http://rep.loc/relations',
                ['slug' => $data->name, 'version' => $data->version]);

            foreach ($rel_arr as $value)
                $cm->download(json_encode($value));

        } catch (Exception $e) {
            echo $e;
        }
    }

    public function update()
    {
        try {
            $cm = new CM();
            $cm->update($_POST['data']);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function active()
    {
        try {
            $cm = new CM();
            $cm->modChangeStatusToActive($_POST['data']);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function inactive()
    {
        try {
            $cm = new CM();
            $cm->modChangeStatusToInactive($_POST['data']);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function delete()
    {
        try {
            $cm = new CM();
            $mod = new Mod();
            $data = json_decode($_POST['data']);
            $slug = $data->name;

            $mod->deleteDirectory(ROOT_DIR . '/workspace/modules/' . $slug);
            $cm->modDeleteFromJson($slug);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function addToManifest()
    {
        $mod = new Mod();
        $modules = $mod->getLocModByFolder('workspace/modules/');
        foreach ($modules as $module) {
            $manifest = file_get_contents("workspace/modules/$module/manifest.json");
            $manifest = json_decode($manifest);
            $data = ['version' => $manifest->version, 'status' => 'active', 'type' => 'module'];
            $cm = new CmService();
            $cm->mod->save($module, $data);
        }
    }

    public function versionChanged()
    {
        $data = json_decode($_POST['data']);
        $slug = $data->name;
        $version = $_POST['changed'];

        $fl = 0;
        $modules = json_decode(file_get_contents('modules.json'));
        foreach ($modules as $k => $module)
            if (!$fl)
                foreach ($module as $key => $item) {
                    if ($item->name == $slug && $item->version == $version) {
                        $temp = $module[0];
                        $module[0] = $item;
                        $module[$key] = $temp;
                        $modules[$k] = $module;
                        $fl = 1;
                        break;
                    }
                }
            else break;
        file_put_contents('modules.json', json_encode($modules));

        return $modules;
    }

    public function clearRequest()
    {
        unset($_REQUEST['data']);
        unset($_REQUEST['changed']);
    }

    public function post_file_get_contents($url, $data)
    {
        $opts = array('http' => ['method' => 'POST', 'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($data)]);
        $context = stream_context_create($opts);

        return json_decode(file_get_contents($url, false, $context));
    }
}