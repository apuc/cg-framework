<?php

namespace workspace\modules\promocode\requests;


use core\RequestSearch;

/**
 * Class PromocodeSearchRequest
 * @package workspace\modules\product\requests
 * @property integer $name
 * @property string $discount
 * @property string $active_from
 * @property string $active_to
 */
class PromocodeSearchRequest extends RequestSearch
{

    public $name;
    public $discount;
    public $active_from;
    public $active_to;

    public function rules()
    {
        return [];
    }

}

