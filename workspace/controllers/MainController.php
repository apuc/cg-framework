<?php

namespace workspace\controllers;

use core\App;
use core\Authorization;
use core\code_generator\CodeGeneratorController;
use core\component_manager\lib\CM;
use core\component_manager\lib\CmService;
use core\component_manager\lib\Config;
use core\component_manager\lib\Mod;
use core\Controller;

use core\Debug;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use workspace\classes\Button;
use workspace\classes\Modules;
use workspace\classes\ModulesSearchRequest;
use workspace\models\User;
use workspace\requests\LoginRequest;
use workspace\requests\RegistrationRequest;
use workspace\widgets\Language;

use Exception;
use Illuminate\Database\Capsule\Manager as DB;
use ZipArchive;


class MainController extends Controller
{
    public function actionIndex()
    {
        $mod = new Mod();
        $this->view->setTitle('CG Framework');

        $buttons[0] = '<a href="/codegen" class="btn btn-dark">CodeGen</a>';
        $buttons[1] = '<a href="/modules" class="btn btn-dark">Модули</a>';
        if ($mod->getModInfo('adminlte')['status'] == 'active')
            $buttons[2] = '<a href="/admin/adminlte" class="btn btn-dark">AdminLTE</a>';

        return $this->render('main/index.tpl', ['h1' => App::$config['app_name'], 'buttons' => $buttons]);
    }

    public function actionCodeGenerator()
    {
        $info = '';
        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA = '"
            . App::$config['db']['db_name'] . "'";
        $tables = DB::select($sql);

        if (isset($_POST['table']) && isset($_POST['slug']) && isset($_POST['module']) && isset($_POST['model'])) {
            $cg = new CodeGeneratorController();
            $info = $cg->genModule($_POST['table'], $_POST['slug'], $_POST['module'], $_POST['model']);

            $manifest = json_decode(file_get_contents('workspace/modules/' . $_POST['module'] . '/manifest.json'));
            $data = ['version' => $manifest->version, 'status' => 'inactive', 'type' => 'module'];
            $cm = new CmService();
            $cm->mod->save($_POST['module'], $data);
        }

        return $this->render('main/codegen.tpl', ['info' => $info, 'tables' => $tables]);
    }

    public function actionLanguage()
    {
        Language::widget()->run();
    }

    public function actionSignUp()
    {
        $this->view->setTitle('Sign Up');
        $request = new RegistrationRequest();
        if ($request->isPost() && $request->validate()) {
            $model = new User();
            $model->username = $request->username;
            $model->email = $request->email;
            $model->role = 2;
            $model->password_hash = password_hash($request->password, PASSWORD_DEFAULT);
            $model->save();

            $_SESSION['role'] = $model->role;
            $_SESSION['username'] = $model->username;

            $this->redirect('');
        }

        return $this->render('main/sign-up.tpl', ['errors' => $request->getMessagesArray()]);
    }

    public function actionSignIn()
    {
        $this->view->setTitle('Sign In');

        $mod = new Mod();
        if ($mod->getModInfo('users')['status'] != 'active') {
            $message = 'Чтобы сделать доступной регистрацию и авторизацию установите и активируйте модуль пользователей.';

            return $this->render('main/info.tpl', ['message' => $message]);
        } else {
            $request = new LoginRequest();
            if ($request->isPost() && $request->validate()) {
                $model = User::where('username', $request->username)->first();

                if (password_verify($request->password, $model->password_hash)) {
                    $_SESSION['role'] = $model->role;
                    $_SESSION['username'] = $model->username;

                    $this->redirect('');
                }
            }

            return $this->render('main/sign-in.tpl', ['errors' => $request->getMessagesArray()]);
        }
    }

    public function actionLogout()
    {
        session_destroy();
        $this->redirect('');
    }

    public function actionModules()
    {
        App::$header->add('Access-Control-Allow-Origin', '*');
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Modules', 'url' => 'modules']);

        $content = file_get_contents('https://rep.craft-group.xyz/handler.php');
        $data = json_decode($content);

        $request = new ModulesSearchRequest();
        $mod = new Mod();
        $model = array();

        $local_modules = $this->getModules();
        foreach ($data as $value)
            if ($value->type == 'module') {
                $module = new Modules();
                $module->init($value->name, $value->version, $value->description,
                    $mod->getModInfo($value->name)['status'], '');
                array_push($model, $module);

                if (in_array($value->name, $local_modules))
                    unset($local_modules[array_search($value->name, $local_modules)]);
            }

        foreach ($local_modules as $local_module) {
            $module = new Modules();
            $manifest = file_get_contents('workspace/modules/' . $local_module . '/manifest.json');
            $manifest = json_decode($manifest);
            $module->init($local_module, $manifest->version, $manifest->description,
                $mod->getModInfo($local_module)['status'], 'exists only locally');
            array_push($model, $module);
        }
        $model = Modules::search($request, $model);

        return $this->render('main/modules.tpl', ['model' => $model, 'options' => $this->setModulesOptions()]);
    }

    public function actionModuleDownload()
    {
        try {
            $cm = new CM();
            $cm->download($_POST['slug']);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function actionSetActive()
    {
        try {
            $cm = new CM();
            $cm->modChangeStatusToActive($_POST['slug']);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function actionSetInactive()
    {
        try {
            $cm = new CM();
            $cm->modChangeStatusToInactive($_POST['slug']);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function actionModuleDelete()
    {
        try {
            $cm = new CM();
            $mod = new Mod();
            $mod->deleteDirectory(ROOT_DIR . Config::get()->byKey($mod->getModInfo($_POST['slug'])['type']
                    . 'Path') . $_POST['slug']);
            $cm->modDeleteFromJson($_POST['slug']);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getModules()
    {
        $dirs = scandir('workspace/modules/');
        unset($dirs[0]);
        unset($dirs[1]);

        return $dirs;
    }

    public function activateLocalModules()
    {
        $modules = $this->getModules();
        foreach ($modules as $module) {
            $manifest = file_get_contents('workspace/modules/' . $module . '/manifest.json');
            $manifest = json_decode($manifest);
            $data = ['version' => $manifest->version, 'status' => 'inactive', 'type' => 'module'];
            $cm = new CmService();
            $cm->mod->save($module, $data);
        }
        $this->redirect('modules');
    }

    public function setModulesOptions()
    {
        return [
            'serial' => '#',
            'fields' => [
                'location' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $button = new Button();

                        return ($model->localStatus == '') ?
                            $button->button('', 'Модуль находится в облаке', $model->name, $model->name, 'cloud') :
                            $button->button('', 'Модуль существует только локально', $model->name, $model->name, 'hdd');
                    },
                ],
                'functional' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $mod = new Mod();
                        $button = new Button();

                        return $button->button('module-download', 'Скачать/Переустановить', $model->name, $model->name, 'cloud-download-alt')
                            . $button->button('fixed-width module-update', 'Обновить', $model->name, $model->name, 'redo')
                            . $button->button('fixed-width module-upload', 'Загрузить в облако', $model->name, $model->name, 'cloud-upload-alt');
                    }
                ],
                'action' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $button = new Button();

                        if ($model->status == 'active')
                            return $button->button('module-set-inactive', 'Отключить', $model->name, $model->name, 'toggle-on');
                        elseif ($model->status == 'inactive')
                            return $button->button('module-set-active', 'Включить', $model->name, $model->name, 'toggle-off');
                        else
                            return '<div class="fixed-width"></div>';
                    },
                ],
                'delete' => [
                    'label' => '',
                    'showFilter' => false,
                    'value' => function ($model) {
                        $mod = new Mod();
                        $button = new Button();

                        return ($mod->getModInfo($model->name)['status'] == 'inactive') ?
                            $button->button('fixed-width module-delete', 'Удалить', $model->name, $model->name, 'trash') :
                            '<div class="fixed-width"></div>';
                    },
                ],
                'status' => [
                    'label' => 'Статус',
                    'value' => function ($model) {
                        return '<div class="fixed-width">' . $model->status . '</div>';
                    }
                ],
                'name' => 'Название',
                'description' => 'Описание',
                'version' => 'Версия'
            ],
            'baseUri' => 'modules',
        ];
    }

    public function CGCloud()
    {
        $this->zip('workspace/modules/' . $_POST['module'] . '/', 'temp.zip');

        $res = '';
        switch ($_POST['code']) {
            case 0:
                $res = ($this->send_to_cloud($_POST['module'])) ?
                    'Модуль успешно обновлен' :
                    'При обновлении модуля возникли ошибки';
                break;
            case 1:
                $res = ($this->send_to_cloud($_POST['module'])) ?
                    'Модуль успешно загружен' :
                    'При загрузке модуля возникли ошибки';
                break;
            case 2:
                $res = 'Данный пользователь не сущесвует';
                break;
            case 3:
                $res = 'Неправильно введен пароль';
                break;
            case 4:
                $res = 'Модуль с таким именем уже есть в облаке и вы не являетесь его владельцем.';
                break;
        }

        //unlink('temp.zip');

        return $res;
    }

    public function send_to_cloud($data)
    {
        App::$header->add('Access-Control-Allow-Origin', '*');

        $postdata = http_build_query([
            'module' => $data,
        ]);

        $opts = array('http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $postdata
        ]);

        $context = stream_context_create($opts);

        return file_get_contents('http://rep.loc/save', false, $context);
    }

    public function zip($source, $destination)
    {
        if (!extension_loaded('zip') || !file_exists($source))
            return -1;

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE))
            return -2;

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source),
                RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file) {
                $file = str_replace('\\', '/', $file);

                if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..')))
                    continue;

                $file = realpath($file);
                $file = str_replace('\\', '/', $file);

                if (is_dir($file) === true)
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                elseif (is_file($file) === true)
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        } elseif (is_file($source) === true)
            $zip->addFromString(basename($source), file_get_contents($source));

        return $zip->close();
    }

    public function authentication()
    {
        if(!isset($_SERVER['PHP_AUTH_USER']) && !isset($_SERVER['PHP_AUTH_PW'])) {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="My Realm"');
            exit;
        } else {
            $auth = new Authorization();

            if (!json_decode($auth->getBasicAuthData())) {
                header('HTTP/1.1 401 Authorization Required');
                header('WWW-Authenticate: Basic realm="Access denied"');
                exit;
            }
        }
    }
}