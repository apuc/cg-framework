<?php


namespace workspace\modules\tour\requests;


use core\RequestSearch;

/**
 * Class TourSearchRequest
 * @package workspace\modules\tour\requests
 *
 * @property int unsigned id
 * @property varchar(255) name
 * @property text main_description
 * @property text front_description
 * @property varchar(255) front_date
 * @property varchar(255) front_places_remaining
 * @property varchar(255) price
 * @property text difficulties_and_weather
 * @property varchar(255) amount_of_places
 * @property varchar(255) reservation_title
 * @property varchar(255) visa
 * @property int unsigned image_id
 * @property int unsigned title_image_id
 * @property int amount_activities_items_1
 * @property int amount_activities_items_2
 * @property int unsigned bg_image_id
 * @property varchar(255) activities_title
 * @property timestamp created_at
 * @property timestamp updated_at
 */

class TourSearchRequest extends RequestSearch
{
    public $id;
    public $name;
    public $main_description;
    public $front_description;
    public $front_date;
    public $front_places_remaining;
    public $price;
    public $difficulties_and_weather;
    public $amount_of_places;
    public $reservation_title;
    public $visa;
    public $image_id;
    public $title_image_id;
    public $amount_activities_items_1;
    public $amount_activities_items_2;
    public $bg_image_id;
    public $activities_title;
    public $created_at;
    public $updated_at;


    public function rules()
    {
        return [];
    }
}