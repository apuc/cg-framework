<?php

namespace core;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use workspace\modules\users\models\User;



class VueForm
{

    public $form;

    public $model = Model::class;

    public function __construct(){
        $this->form = $this->getForm();
        $this->model = new $this->model();
    }

    public static function find($id)
    {
        if(method_exists(static::class, $id)){
            return static::$id();
        }
        return ['error' => 'form not found'];
    }

    public function getForm()
    {
        return [
        ];
    }

    /**
     * Generate form from object of model's class witch makes from database's data using id
     * @param $id
     */
    public function makeFormByModelById($id)
    {
        $model = $this->model::findOrFail($id);
        $this->form = $this->makeFormByModel($model);
    }

    /**
     * Generate form using object of model's class from arguments
     * @param $model
     * @return array
     */
    public function makeFormByModel($model){
        $form = $this->form;
        for($i = 0; $i < count($form['inputs']); $i++){
            if($model->{$form['inputs'][$i]['name']}){
                $form['inputs'][$i]['value'] = $model->{$form['inputs'][$i]['name']};
            }
        }
        return $form;
    }

    /**
     * Generate and return array of forms in json
     * @return array
     */
    public function getFormArrayByModel(){                  //TODO Переназвать
        $formArray = array();
        $modelArray = $this->model::all();

        for($i = 0; $i < count($modelArray); $i++){
            $model = $modelArray[$i];
            $form = $this->makeFormByModel($model);
            array_push($formArray, $form);
        }
        return $formArray;
    }

    /**
     * @return false|string
     */
    public function getFormJSON()
    {
        return json_encode($this->form);
    }

    /**
     * Create new record in database using params from request
     * @param $request
     */
    public function create($request)
    {
        $this->model->_save($request);
    }

    /**
     * Update record in database using params from request
     * @param $request
     */
    public function update($request)
    {
        $model = $this->model::findOrFail($request->id);
        $model->_save($request);
    }

    /**
     * Delete ecord in database using id from request
     * @param $request
     */
    public function delete($request){
        $model = $this->model::findOrFail($request->id);
        $model->delete();
    }

}