<?php
namespace workspace\modules\order\requests;

/**
 * Class RegistrationRequest
 * @package workspace\modules\order\requests
 * @property string $city
 * @property string $email
 * @property string $fio
 * @property string $phone
 * @property integer $pay
 * @property integer $delivery
 * @property integer $shop_id
 * @property string $delivery_date
 * @property string $delivery_time
 * @property string $address
 * @property string $comment
 * @property float $total_price
 * @property integer $product_id
 * @property integer $quantity
 */
class OrderRequest extends \core\Request
{
    public $city;
    public $email;
    public $fio;
    public $phone;
    public $pay;
    public $delivery;
    public $shop_id;
    public $delivery_date;
    public $delivery_time;
    public $address;
    public $comment;
    public $total_price;
    public $product_id;
    public $quantity;

    public function rules()
    {
        return [
            'city' => 'required',
            'email' => 'required|email',
            'fio' => 'required',
            'phone' => 'required',
            'pay' => 'required|integer',
            'delivery' => 'required|integer',
            'shop_id' => 'required|integer',
            'delivery_date' => 'required|date',
            'delivery_time' => 'required',
            'address' => 'required',
            'comment' => 'required',
            'total_price' => 'required|numeric',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
        ];
    }
}