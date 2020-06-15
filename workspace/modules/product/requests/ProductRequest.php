<?php


namespace workspace\modules\product\requests;

use core\Request;

/**
 * Class ProductRequest
 * @package workspace\modules\product\requests
 * @property string $name
 * @property string $description
 * @property string $status
 * @property string $price
 */
class ProductRequest extends Request
{
    public $name;
    public $description;
    public $status;
    public $price;

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required|integer',
            'price' => 'required|numeric',
        ];
    }
}