<?php


namespace workspace\modules\tags\requests;


use core\Request;

/**
 * Class TagRequest
 * @package workspace\modules\tags\requests
 */
class TagRequest extends Request
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
        return [
            'name' => 'required|min:3',
            'status' => 'required|numeric',
            'type' => 'required|min:1',
            'type_id' => 'required|numeric',
        ];
    }

}