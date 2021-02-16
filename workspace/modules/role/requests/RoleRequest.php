<?php


namespace workspace\modules\role\requests;


use core\Request;

class RoleRequest extends Request
{
    /**
     * Properties and m-m relations
     *
     * @var int $id
     * @var string $key
     * @var mixed $rules Collection || BelongToMany
     * @var mixed $users Collection || BelongToMany
     */
    public $id;
    public $key;
    public $rules;
    public $users;

    public function rules()
    {
        return [
            'id' => 'numeric',
            'key' => 'required|min:3',
            'rules' => 'required',
            'users' => 'required'
        ];
    }
}