<?php


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
        App::$header->add('Access-Control-Allow-Origin', '*');

        return json_encode(Forms::find($id));
    }
}