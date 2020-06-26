<?php

namespace workspace\classes;


use Illuminate\Support\Collection;

class Modules
{
    public $name;
    public $version;
    public $description;
    public $status;

    /**
     * @param string $name
     * @param string $version
     * @param string $description
     * @param string $status
     */
    public function init($name, $version, $description, $status)
    {
        $this->name = $name;
        $this->version = $version;
        $this->description = $description;
        $this->status = $status;
    }

    /**
     * @param ModulesSearchRequest $request
     * @return Collection
     */
    public static function search(ModulesSearchRequest $request, array $modules)
    {
        $all = array();
        $hasRequest = false;

        if ($request->name) {
            $hasRequest = true;
            foreach ($modules as $value)
                if (stristr($value->name, $request->name))
                    array_push($all, $value);
        }
        if ($request->version) {
            $hasRequest = true;
            foreach ($modules as $value)
                if (stristr($value->version, $request->version))
                    array_push($all, $value);
        }
        if ($request->description) {
            $hasRequest = true;
            foreach ($modules as $value)
                if (stristr($value->description, $request->description))
                    array_push($all, $value);
        }
        if ($request->status) {
            $hasRequest = true;
            foreach ($modules as $value)
                if (stristr($value->status, $request->status))
                    array_push($all, $value);
        }

        if(empty($all) && !$hasRequest)
            $all = $modules;

        return new Collection($all);
    }
}