<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 14.06.19
 * Time: 23:50
 */

namespace workspace\controllers;


use core\App;
use core\Controller;
use core\ResponseType;
use workspace\forms_vue\Forms;

class FormsController extends Controller
{

    public function actionShow($id)
    {
        App::$responseType = ResponseType::APPLICATION_JSON;
        header("Access-Control-Allow-Origin: *");

        return json_encode(Forms::find($id));
    }

}