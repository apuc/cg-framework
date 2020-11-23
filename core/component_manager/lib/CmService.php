<?php

namespace core\component_manager\lib;


use core\App;
use core\component_manager\interfaces\Rep;
use core\component_manager\traits\Delete;
use core\component_manager\traits\Unpack;
use core\HZip;
use Exception;


class CmService
{
    use Unpack;
    use Delete;

    /**
     * @var Rep
     */
    public $rep;

    /**
     * @var
     */
    public $mod;

    /**
     * CmService constructor.
     */
    public function __construct()
    {
        $this->getRep();
        $this->mod = new Mod();
    }

    /**
     * @param string $slug
     * @return string|null
     */
    public function getVersion(string $slug): ?string
    {
        $component = $this->getComponentInfo($slug);

        return $component->version;
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function checkVersion(string $slug): bool
    {
        return ($this->getVersion($slug) === $this->mod->getLocMod($slug)['version']);
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function isInstalled(string $slug): bool
    {
        return ($this->mod->getLocMod($slug)['name'] === $slug);
    }

    /**
     * @param string $slug
     * @param string $data
     * @param string $type
     * @param string $serverPath
     * @param string $savePath
     * @param string $unpackPath
     * @return bool
     */
    public function updateCurrentVersion(string $slug, string $data, string $type, string $serverPath, string $savePath, string $unpackPath): bool
    {
        if ($this->checkVersion($slug) === FALSE)
            return $this->download($data, $type,  $serverPath,  $savePath, $unpackPath);
        else
            return false;
    }

    /**
     * @param string $slug
     * @param string $data
     * @param string $type
     * @param string $serverPath
     * @param string $savePath
     * @param string $unpackPath
     * @return bool
     */
    public function getIsInstalled(string $slug, string $data, string $type, string $serverPath, string $savePath, string $unpackPath): bool
    {
        if ($this->isInstalled($slug) === FALSE)
            return $this->download($data, $type,  $serverPath,  $savePath, $unpackPath);
        else
            return false;
    }

    /**
     * @param string $slug
     * @return array
     */
    public function getLocMod(string $slug): array
    {
        return $this->mod->getLocMod($slug);
    }

    /**
     * @param string $slug
     * @return array
     */
    public function getVersions(string $slug)
    {
        return ['repository' => $this->getVersion($slug),
            'local' => $this->mod->getVersion($slug)];
    }

    /**
     * @return mixed
     */

    public function getAllVersions()
    {
        return $this->mod->getAllVersions();
    }

    /**
     * @param string $slug
     * @return Component
     */
    public function getComponentInfo(string $slug): Component
    {
        $url = Config::get()->byKey('url');
        $url = $url . '/components/' . $slug . '/manifest.json';
        $info = $this->rep->parse($url)->asArray();

        return new Component($info);
    }

    /**
     * @return array
     */
    public function getComponentsInfo()
    {
        $mods = [];
        foreach ($this->mod->getAllSlug() as $slug)
            $mods[] = array_merge(['slug' => $slug], $this->getVersions($slug));

        return $mods;
    }

    /**
     * @param string $status
     * @return array
     */
    public function getByStatus(string $status)
    {
        return $this->mod->getByStatus($status);
    }

    /**
     * @param string $name
     * @return array
     */
    public function getByName(string $name)
    {
        return $this->mod->getByName($name);
    }

    /**
     * @param string $data
     * @param string $type
     * @param string $serverPath
     * @param string $savePath
     * @param string $unpackPath
     * @return bool
     */
    public function download(string $data, string $type, string $serverPath, string $savePath, string $unpackPath): bool
    {
        try {
            $data = json_decode($data);
            $slug = ($type == 'core') ? 'core' : $data->name;
            $version = $data->version;
            $filename = "$slug.zip";

            if($type == 'core') {
                $this->rep->download(App::$config['component_manager']['url'] . "$serverPath/$version/$filename", "$savePath/$version.zip");
                $mods = json_decode(file_get_contents('mods.json'));
                array_push($mods->__core, ['version' => $version, 'status' => 'inactive', 'localStatus' => 'local', 'type' => 'core']);
                file_put_contents('mods.json', json_encode($mods));
            } else {
                $this->rep->download(App::$config['component_manager']['url'] . "$serverPath/$version/$filename", "$savePath/$filename");
                $this->unpack("$savePath/$filename", $unpackPath, $slug);
                unlink($filename);
                $this->mod->save($slug, ['version' => $version, 'status' => 'active', 'type' => 'module']);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param string $data
     * @return bool
     */
    public function update(string $data): bool
    {
        try {
            $mod = new Mod();
            $data = json_decode($data);
            $slug = $data->name;

            $this->rep->download(App::$config['component_manager']['url'] . "/cloud/modules/$slug/$data->version/$slug.zip", "/$slug.zip");
            $this->unpack("/$slug.zip", "/workspace/modules/$slug/temp", $slug);

            HZip::zipDir("workspace/modules/$slug/temp/$slug/core","core.zip");
            $this->unpack("/core.zip", "/workspace/modules/$slug", 'core');

            $mod->deleteDirectory("workspace/modules/$slug/temp/");
            unlink("$slug.zip");
            unlink("core.zip");

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param string $data
     * @return bool
     * @throws Exception
     */
    public function upload(string $data): bool
    {
        $data = json_decode($data);
        $slug = $data->name;
        $version = $data->version;

        HZip::zipDir("workspace/modules/$slug", "$slug.zip");

        $request = curl_init(App::$config['component_manager']['url'] . '/save');
        curl_setopt($request, CURLOPT_POST, true);

        $file = file_get_contents("$slug.zip");

        curl_setopt($request, CURLOPT_POSTFIELDS, ['file' => base64_encode($file), 'slug' => $slug, 'version' => $version]);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($request);
        curl_close($request);

        unlink("$slug.zip");

        return $result;
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function deleteMod(string $slug): bool
    {
        $url = '/modules/' . $slug . '/manifest.json';
        $path = '/modules/' . $slug;
        $folder = '/unpack';
        $delete = $this->delete($url, $path, $folder);
        $modDelete = $this->modDeleteFromJson($slug);

        return (true ?: $delete and $modDelete ?: false);
    }

    /**
     * @param string $slug
     * @param array $data
     * @return bool
     */
    public function save(string $slug, array $data): bool
    {
        return $this->mod->save($slug, $data);
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function modDeleteFromJson(string $slug): bool
    {
        return $this->mod->delete($slug);
    }

    /**
     * @param string $slug
     * @param array $data
     * @return bool
     */
    public function modChangeStatus(string $slug, array $data): bool
    {
        return $this->mod->changeStatus($slug, $data);
    }

    /**
     * @param string $data
     * @return bool
     */
    public function modChangeStatusToActive(string $data): bool
    {
        $data = json_decode($data);
        $slug = $data->name;

        $status = ['status' => 'active'];

        return $this->modChangeStatus($slug, $status);
    }

    /**
     * @param string $data
     * @return bool
     */
    public function modChangeStatusToInactive(string $data): bool
    {
        $data = json_decode($data);
        $slug = $data->name;

        $status = ['status' => 'inactive'];

        return $this->modChangeStatus($slug, $status);
    }

    /**
     * @param string $data
     * @return bool
     */
    public function coreChangeStatusToActive(string $data): bool
    {
        $mods = json_decode(file_get_contents('mods.json'));
        foreach ($mods->__core as $i => $item)
            if($item->version == $data) {
                $mods->__core[$i]->status = 'active';
                break;
            }
        file_put_contents('mods.json', json_encode($mods));

        return 1;
    }

    /**
     * @param string $data
     * @return bool
     */
    public function coreChangeStatusToInactive(string $data): bool
    {
        $mods = json_decode(file_get_contents('mods.json'));
        foreach ($mods->__core as $i => $item)
            if($item->version == $data) {
                $mods->__core[$i]->status = 'inactive';
                break;
            }
        file_put_contents('mods.json', json_encode($mods));

        return 1;
    }

    /**
     * @param string $slug
     * @param array $data
     * @return bool
     */
    public function modChangeVersion(string $slug, array $data): bool
    {
        return $this->mod->changeVersion($slug, $data);
    }

    /**
     *
     */
    private function getRep()
    {
        $class = Config::get()->byKey('repType');
        //$this->rep = new $class();
        $this->rep = new CurlRep();
    }
}