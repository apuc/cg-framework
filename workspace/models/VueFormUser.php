<?php

namespace workspace\models;

use core\VueForm;
use workspace\requests\VueFormUserRequest;

class VueFormUser extends VueForm
{
    public $model = User::class;

    public function getForm()
    {
        return [
            'accept-charset' => 'utf-8',
            'autocomplete' => 'off',             // on | off
            'enctype' => 'text/plain',
            'method' => 'get',                  // get | post
            'name' => 'formName',
            'novalidate' => '',
            'inputs' =>
                [
                    [
                        'name' => 'username',
                        'type' => 'text',
                        'value' => ''
                    ],
                    [
                        'name' => 'email',
                        'type' => 'text',
                        'value' => ''
                    ],
                    [
                        'name' => 'role',
                        'type' => 'text',
                        'value' => ''
                    ]
                ]
        ];
    }

}