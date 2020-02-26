<?php


namespace workspace\controllers;


use core\Controller;
use workspace\models\Article;

class ApiController extends Controller
{
    public function actionGet()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if($data) {
            $a = new Article();
            $a->name = $data->title;
            $a->text = $data->article;
            $a->language_id = $data->language_id;
            $a->save();
        }
    }
}