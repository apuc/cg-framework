<?php

namespace workspace\modules\promocode\requests;

use core\Request;

/**
 * Class PromocodeRequest
 * @package workspace\modules\promocode\requests
 * @property string $name
 * @property string $active_from
 * @property string $active_to
 * @property integer $discount
 */
class PromocodeRequest extends Request
{
    public $name;
    public $active_from;
    public $active_to;
    public $discount;

    public function rules()
    {
        return [
            'name' => 'required',
            'active_from' => 'required|date',
            'active_to' => 'required|date',
            'discount' => 'required|integer',
        ];
    }
}