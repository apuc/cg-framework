<?php

namespace workspace\modules\tags\requests;


use core\RequestSearch;

/**
 * Class TagsRequestSearch
 * @package workspace\modules\tags\requests
 *
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property integer $type_id
 * @property integer $status
 */


class TagsRequestSearch extends RequestSearch
{
    public $id;

    public $name;
    public $slug;
    public $status;

    // for tags_relations
    public $type;
    public $type_id;
    public $tag_id;

    public function rules()
    {
        return [];
    }

}