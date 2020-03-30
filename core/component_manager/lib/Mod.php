<?php

namespace core\component_manager\lib;


use core\component_manager\interfaces\Rep;

class Mod
{
    /**
     * @var
     */
    public $mod;

    /**
     * @var
     */
    public $file;

    /**
     * Mod constructor.
     */
    public function __construct()
    {
        $this->load();
    }

    /**
     *
     */
    public function load()
    {
        $this->file = ROOT_DIR . "/mods.json";
        $mods = file_get_contents($this->file);
        $this->mod = json_decode($mods, true);
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getVersion(string $slug)
    {
        return $this->mod[$slug]['version'];
    }

    /**
     * @param string $status
     * @return array
     */
    public function getByStatus(string $status)
    {
       $allStatus = [];
        foreach ($this->mod as $key => $value) {
            if (in_array($status, $value)){
                $allStatus[$key] = $value;
            }
        }
        return $allStatus;
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function getLocMod(string $slug): bool
    {
        $file = ROOT_DIR . "/unpack/modules/" . $slug .  "/manifest.json";
        if (file_exists($file)){
            $mods = file_get_contents($file);
        }
        return (true ?: $mod = json_decode($mods, true)?: false);
    }

    /**
     * @return mixed
     */
    public function getAllVersions()
    {
        $onlyVersion = [];
        foreach ($this->mod as $key => $value) {
            $onlyVersion[] = $value['version'];
        }
        return $onlyVersion;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getSlug(string $slug)
    {
        $slug = array_search($slug, $this->getAllSlug());
        return $this->getAllSlug()[$slug];
    }

    /**
     * @return mixed
     */
    public function getAllSlug()
    {
        $onlySlug = [];
        foreach ($this->mod as $key => $value) {
             $onlySlug[] = $key;
        }
        return $onlySlug;
    }

    /**
     * @param string $slug
     * @param array $data
     * @return bool
     */
    public function save(string $slug, array $data = []): bool
    {
        foreach ($data as $key => $value) {
            $this->mod[$slug][$key] = $value;
        }

        return file_put_contents($this->file, json_encode($this->mod));
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function delete(string $slug): bool
    {
        unset($this->mod[$slug]);
        return file_put_contents($this->file, json_encode($this->mod));

    }

    /**
     * @param string $slug
     * @param array $data
     * @return bool
     */
    public function changeStatus(string $slug, array $data = []): bool
    {
        return $this->save($slug, $data);
    }

    /**
     * @param string $slug
     * @param array $data
     * @return bool
     */
    public function changeVersion(string $slug, array $data = []): bool
    {
        return $this->save($slug, $data);
    }
}