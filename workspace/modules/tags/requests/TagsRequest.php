<?php

namespace workspace\modules\users\requests;


use core\RequestSearch;

/**
 * Class TagsSearchRequest
 * @package workspace\modules\tags\requests
 *
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property integer $type_id
 * @property integer $status
 */


class TagsSearchRequest extends RequestSearch
{
    public $name;
    public $slug;
    public $type;
    public $type_id;
    public $status;

    public function rules()
    {
        return [];
    }

}