<?php

namespace workspace\requests;

use core\Request;

class VueFormUserRequest extends VueFormRequest
{
    public $username;
    public $email;
    public $password;
}