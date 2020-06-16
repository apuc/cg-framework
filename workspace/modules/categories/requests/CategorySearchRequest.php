<?php


namespace workspace\modules\categories\requests;


use core\RequestSearch;

/**
 * Class CategorySearchRequest
 * @package workspace\modules\categories\requests
 * @property string $category
 */
class CategorySearchRequest extends RequestSearch
{
    public $category;

    public function rules()
    {
        return [];
    }
}