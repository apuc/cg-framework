<?php


namespace workspace\controllers;

use core\App;
use core\Controller;
use workspace\models\Article;
use workspace\models\Category;
use workspace\models\Settings;
use ZipArchive;


class ApiController extends Controller
{
    public function actionTemplates()
    {
        App::$header->add('Access-Control-Allow-Origin', '*');

        $json = file_get_contents('php://input');

        return json_decode($json);
    }

    public function actionGetArticle()
    {
        App::$header->add('Access-Control-Allow-Origin', '*');

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $category = Category::where('category', $data->categories[0])->first();

        $model = new Article();
        $model->name = $data->name;
        $model->text = $data->text;
        $model->language_id = $data->language_id;
        $model->category_id = $category->id;
        $model->image_name = $data->image;
        $model->image = '<img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/'. $data->image .'" />';
        $model->save();

        return 'success';
    }

    public function actionSetOptions()
    {
        App::$header->add('Access-Control-Allow-Origin', '*');

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if($data)
            foreach ($data as $value)
                foreach ($value as $val) {
                    $current_settings = Settings::where('key', $val->key)->first();
                    if(!$current_settings) {
                        $settings = new Settings();
                        $settings->key = $val->key;
                        $settings->value = $val->value;
                        $settings->save();
                    } else {
                        $current_settings->key = $val->key;
                        $current_settings->value = $val->value;
                        $current_settings->save();
                    }
                }
    }

    public function actionGetOptions()
    {
        $current_settings = Settings::all();
        $current_settings = json_encode($current_settings);
        return $current_settings;
    }

    public function actionEdit()
    {
        header($_POST['url']);
    }

    public function actionDelete()
    {
        return 'Data: '.$_POST['url'];
    }

    public function actionDownload()
    {
        $file = $_POST['theme'] . '.zip';
        $path = WORKSPACE_DIR . '/modules/themes/themes/';

        $ch = curl_init('https://news-parser.craft-group.xyz/themes/' . $file);
        $fp = fopen( $path . $file, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        $zip = new ZipArchive;
        $res = $zip->open($path . $file);
        if ($res === TRUE) {
            $zip->extractTo($path);
            $zip->close();
        }
        unlink($path . $file);
    }

    public function actionSetTheme()
    {
        $model = Settings::where('key', 'theme')->first();

        if(isset($_POST['theme'])) {
            $model->value = $_POST['theme'];
            $model->save();

            $this->redirect('themes');
        }
    }
}