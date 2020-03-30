<?php

namespace core\component_manager\lib;

use core\component_manager\interfaces\Rep;
use core\component_manager\traits\Delete;
use core\component_manager\traits\Unpack;


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
     * @return bool
     */
    public function updateCurrentVersion(string $slug):bool
    {
        if ($this->checkVersion($slug) === FALSE){
            return $this->download($slug);
        }
        else{
            return false;
        }
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function getIsInstalled(string $slug):bool
    {
        if ($this->isInstalled($slug) === FALSE){
            return $this->download($slug);
        }
        else{
            return false;
        }
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function getLocMod(string $slug):bool
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
        foreach ($this->mod->getAllSlug() as $slug) {
            $mods[] = array_merge(['slug' => $slug], $this->getVersions($slug));
        }

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
     * @param string $slug
     * @return bool
     */
    public function download(string $slug): bool
    {
        $url = Config::get()->byKey('url');
        $url = $url . '/components/' . $slug . '/manifest.zip';
        $path = Config::get()->byKey('modulePath');
        if (!is_dir('download/modules/' . $slug)) {
            mkdir('download/modules/' . $slug, 0775);
        }
        $path = $path . $slug;
        $this->rep->download($url, $path);
        if (!is_dir('unpack/modules/' . $slug)) {
            mkdir('unpack/modules/' . $slug , 0775);
        }
        $data = ['version' => $this->getVersion($slug),
            'status' => 'active'];
        $this->mod->save($slug, $data);
        $url = $path . '/' . 'manifest.zip';
        if ($this->unpack($url, $path)) {
            $folder = '/download';
            $this->delete($url, $path, $folder);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function deleteMod(string $slug): bool
    {
        $url = '/modules/' . $slug . '/manifest.json' ;
        $path = '/modules/' . $slug;
        $folder = '/unpack';
        $delete = $this->delete($url, $path, $folder);
        $modDelete =  $this->modDeleteFromJson($slug);
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
     * @param string $slug
     * @return bool
     */
    public function modChangeStatusToActive(string $slug): bool
    {
        $data = ['status' => 'active'];
        return $this->modChangeStatus($slug, $data);
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function modChangeStatusToInactive(string $slug): bool
    {
        $data = ['status' => 'inactive'];
        return $this->modChangeStatus($slug, $data);
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
        $this->rep = new $class();
    }
}