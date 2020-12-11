<?php


namespace workspace\controllers;


use core\App;
use core\Controller;
use core\interfaces\VueFormControllerInterface;
use core\Request;
use core\VueForm;
use workspace\models\VueFormUser;
use workspace\requests\VueFormRequest;
use workspace\requests\VueFormUserRequest;

class VueFormController implements VueFormControllerInterface
{
    public $request = VueFormRequest::class;

    public $vueForm = VueForm::class;

    public function __construct()
    {
        $this->request = new $this->request();
        $this->vueForm = new $this->vueForm();
    }

    public function create(){
        $this->vueForm->create($this->request);
    }

    public function update($id){
        $this->request->id = $id;
        $this->vueForm->update($this->request);
    }

    public function show($id){
        $this->vueForm->makeFormByModelById($id);
        App::$header->add("Content-Type", "application/json");
        return json_encode($this->vueForm->form);
    }

    public function index(){
        App::$header->add("Content-Type", "application/json");
        return json_encode($this->vueForm->getFormArrayByModel());
    }

    public function delete($id){
        $this->request->id = $id;
        $this->vueForm->delete($this->request);
    }

    public function init()
    {

    }

}