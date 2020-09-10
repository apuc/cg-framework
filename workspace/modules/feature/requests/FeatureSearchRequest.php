<?php


namespace workspace\modules\feature\requests;


use core\RequestSearch;

/**
 * Class FeatureSearchRequest
 * @package workspace\modules\feature\requests
 *
 * @property int unsigned id
 * @property int unsigned tour_id
 * @property text feature
 * @property varchar(255) type
 * @property timestamp created_at
 * @property timestamp updated_at
 */

class FeatureSearchRequest extends RequestSearch
{
    public $id;
    public $tour_id;
    public $feature;
    public $type;
    public $created_at;
    public $updated_at;


    public function rules()
    {
        return [];
    }
}