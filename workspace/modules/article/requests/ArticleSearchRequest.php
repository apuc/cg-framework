<?php


namespace workspace\modules\article\requests;


use core\RequestSearch;

/**
 * Class ArticleSearchRequest
 * @package workspace\modules\article\requests
 *
 * @property string $name
 * @property string $text
 * @property string $title
 * @property string $lang
 * @property string $description
 * @property string $keywords
 * @property string $url
 */

class ArticleSearchRequest extends RequestSearch
{
    public $name;
    public $text;
    public $lang;
    public $title;
    public $description;
    public $keywords;
    public $url;

    public function rules()
    {
        return [];
    }
}