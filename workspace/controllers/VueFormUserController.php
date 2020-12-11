<?php

namespace workspace\controllers;

use core\App;
use core\Controller;
use core\Debug;
use workspace\models\User;
use workspace\models\VueFormUser;
use workspace\requests\VueFormUserRequest;

class VueFormUserController extends VueFormController
{
    public $request = VueFormUserRequest::class;

    public $vueForm = VueFormUser::class;

}
