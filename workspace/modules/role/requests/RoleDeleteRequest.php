<?php


namespace workspace\modules\role\requests;


class RoleDeleteRequest extends RoleRequest
{
    public function rules()
    {
        return [
            'id' => 'required|numeric'
        ];
    }
}