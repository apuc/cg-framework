<?php


namespace workspace\modules\tags\requests;


use core\Request;

class TagRequest extends Request
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
        return [
            'name' => 'required|min:3',
            'status' => 'required|numeric',
            'type' => 'required|min:1',
            'type_id' => 'required|numeric',
        ];
    }

}