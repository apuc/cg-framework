<?php


namespace workspace\controllers;

use core\App;
use core\component_manager\lib\CM;
use core\component_manager\lib\Mod;
use core\Controller;
use workspace\models\Article;
use workspace\models\Settings;

use workspace\modules\themes\controllers\ThemesController;
use workspace\modules\themes\Themes;
use ZipArchive;


class ApiController extends Controller
{
    public function getDataFromJson()
    {
        //App::$header->add('Access-Control-Allow-Origin', '*');

        $json = file_get_contents('php://input');

        return json_decode($json);
    }

    public function actionTemplates()
    {
        return $this->getDataFromJson();
    }

    public function actionStoreArticle()
    {
        $data = $this->getDataFromJson();

        $existing = Article::where('parent_id', $data->parent_id)->first();

        if(!$existing) {
            $model = new Article();
            Article::saveData($model, $data);

            return 'The article successfully added!';
        } else {
            Article::saveData($existing, $data);

            return 'The article already exist and was successfully updated!';
        }
    }

    public function actionUpdateArticle()
    {
        $data = $this->getDataFromJson();

        $existing = Article::where('parent_id', $data->parent_id)->first();
        if($existing) {
            Article::saveData($existing, $data);

            return 'The article successfully updated!';
        } else {
            $model = new Article();
            Article::saveData($model, $data);

            return 'The article didn\'t exist and was successfully added!';
        }
    }

    public function actionSetOptions()
    {
        $data = $this->getDataFromJson();

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

    public function actionChangeTheme()
    {
        $model = Settings::where('key', 'theme')->first();

        if(isset($_POST['theme'])) {
            $model->value = $_POST['theme'];
            $model->save();

            $this->redirect('themes');
        }
    }

    public function actionSetTheme()
    {
        $data = file_get_contents('php://input');
        $this->saveTheme($data);
    }

    public function actionSetTitle()
    {
       $this->saveData('title', file_get_contents('php://input'));
    }

    public function actionSetKeywords()
    {
        $this->saveData('keywords', file_get_contents('php://input'));
    }

    public function actionSetDescription()
    {
        $this->saveData('description', file_get_contents('php://input'));
    }

    public function actionSetSettings()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data);

        $this->saveData('title', $data->title);
        $this->saveData('keywords', $data->keywords);
        $this->saveData('description', $data->description);
        $this->saveTheme($data->theme);
    }

    public function saveData($key, $data)
    {
        $model = Settings::where('key', $key)->first();
        $model->value = $data;
        $model->save();
    }

    public function saveTheme($data)
    {
        $mod = new Mod();

        if($mod->getModInfo($data)['status'] == 'active')
            return 1;
        elseif($mod->getModInfo($data)['status'] == 'inactive') {
            try {
                $cm = new CM();
                $theme = Settings::where('key', 'theme')->first();
                $cm->modChangeStatusToInactive($theme->value);
                $cm->modChangeStatusToActive($data);
                $theme->value = $data;
                $theme->save();

                return 1;
            } catch (\Exception $e) {
                return $e;
            }
        } else {
            try {
                $cm = new CM();
                $cm->download($data);

                $theme = Settings::where('key', 'theme')->first();
                $cm->modChangeStatusToInactive($theme->value);
                $cm->modChangeStatusToActive($data);
                $theme->value = $data;
                $theme->save();

                return 1;
            } catch (\Exception $e) {
                return $e;
            }
        }
    }
}