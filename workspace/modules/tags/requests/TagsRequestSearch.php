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
    /**
     * Columns of tags
     *
     * @var int|string $id
     * @var string $name
     * @var string $slug
     * @var int|string $status
     */
    public $id;
    public $name;
    public $slug;
    public $status;

    /**
     * Columns of tag_relations
     *
     * needs for creating tag
     *
     * @var $type
     * @var $type_id
     */
    public $type;
    public $type_id;

    /**
     * Rules are needed to validate data
     * @return string[]
     */
    public function rules()
    {
        return [];
    }

}