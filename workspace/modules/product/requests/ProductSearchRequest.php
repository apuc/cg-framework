<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.06.20
 * Time: 23:59
 */

namespace workspace\modules\product\requests;


use core\RequestSearch;

/**
 * Class ProductSearchRequest
 * @package workspace\modules\product\requests
 * @property string $name
 * @property string $price
 */
class ProductSearchRequest extends RequestSearch
{

    public $name;
    public $price;

    public function rules()
    {
        return [];
    }

}