<?php


namespace workspace\modules\tags\requests;


class TagRequestEdit extends TagsRequestSearch
{
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'slug' => 'required|min:3',
            'status' => 'required|numeric',
        ];
    }
}