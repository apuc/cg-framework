<?php


namespace workspace\modules\tags\requests;


class TagRequestEdit extends TagsRequestSearch
{
    /**
     * Rules are needed to validate data
     * @return string[]
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'slug' => 'required|min:3',
            'status' => 'required|numeric',
        ];
    }
}