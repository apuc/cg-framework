<?php

namespace workspace\controllers;

use core\App;
use core\component_manager\lib\Mod;
use core\Controller;
use workspace\modules\users\models\User;
use workspace\requests\LoginRequest;
use workspace\requests\RegistrationRequest;
use workspace\widgets\Language;

class MainController extends Controller
{
    public function actionIndex()
    {
        $mod = new Mod();
        $this->view->setTitle('CG Framework');

        $buttons[0] = '<a href="/codegen" class="btn btn-dark">CodeGen</a>';
        $buttons[1] = '<a href="/modules" class="btn btn-dark">Модули</a>';
        $buttons[2] = '<a href="/core-versions" class="btn btn-dark">Ядро</a>';
        if ($mod->getModInfo('adminlte')['status'] == 'active')
            $buttons[3] = '<a href="/admin/adminlte" class="btn btn-dark">AdminLTE</a>';

        return $this->render('main/index.tpl', ['h1' => App::$config['app_name'], 'buttons' => $buttons]);
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
            $model->_save($request);

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
}