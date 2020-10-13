<?php

use core\App;

App::$collector->group(['after' => 'main_group', 'params' => ['AFTER']], function ($router) {
    App::$collector->group(['before' => 'next'], function ($router) {
        App::$collector->get('/', [workspace\controllers\MainController::class, 'actionIndex'],
            ['before' => 'some', 'params' => ['param to some, BEFORE']]);
    });
});
App::$collector->any('sign-up', ['workspace\controllers\MainController', 'actionSignUp']);
App::$collector->any('sign-in', ['workspace\controllers\MainController', 'actionSignIn']);
App::$collector->any('logout', ['workspace\controllers\MainController', 'actionLogout']);

if (App::$config['codegen'] == 'on')
    App::$collector->any('codegen', ['core\controllers\CodegenController', 'actionCodeGenerator']);

if (App::$config['modules_manager'] == 'on')
    App::$collector->cors('modules', ['core\controllers\ModulesController'], ['actionModules']);

App::$collector->any('module-upload', ['core\controllers\ModulesController', 'actionModuleUpload']);
App::$collector->any('module-update', ['core\controllers\ModulesController', 'actionModuleUpdate']);
App::$collector->any('module-download', ['core\controllers\ModulesController', 'actionModuleDownload']);
App::$collector->any('module-set-active', ['core\controllers\ModulesController', 'actionSetActive']);
App::$collector->any('module-set-inactive', ['core\controllers\ModulesController', 'actionSetInactive']);
App::$collector->any('module-delete', ['core\controllers\ModulesController', 'actionModuleDelete']);
App::$collector->any('change-version', ['core\controllers\ModulesController', 'actionChangeVersion']);
App::$collector->any('update-manifest', ['core\controllers\ModulesController', 'actionAddLocalModulesToManifest']);

App::$collector->cors('core-versions', ['core\controllers\CoreController'], ['actionIndexCore']);
App::$collector->any('download-core', ['core\controllers\CoreController', 'actionDownloadCore']);
App::$collector->any('update-core', ['core\controllers\CoreController', 'actionUpdateCore']);
App::$collector->any('upload-core', ['core\controllers\CoreController', 'actionUploadCore']);
App::$collector->any('set-active-core', ['core\controllers\CoreController', 'actionSetActiveCore']);
App::$collector->any('delete-core', ['core\controllers\CoreController', 'actionDeleteCore']);
App::$collector->any('update-core-mods', ['core\controllers\CoreController', 'actionAddLocCoreToMods']);