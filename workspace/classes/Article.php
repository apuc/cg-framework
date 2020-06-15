<?php


namespace workspace\classes;


class Article
{
    public $id;
    public $name;
    public $text;
    public $language_id;
    public $image_name;
    public $image;
    public $parent_id;
    public $category_id;
    public $title;
    public $description;
    public $keywords;
    public $url;

    public function __construct($id, $name, $text, $language_id, $image_name, $image, $parent_id, $category_id = 0,
                                $title = '', $description  = '', $keywords = '', $url = '') {
        $this->id = $id;
        $this->name = $name;
        $this->text = $text;
        $this->language_id = $language_id;
        $this->image_name = $image_name;
        $this->image = $image;
        $this->parent_id = $parent_id;
        $this->category_id = $category_id;
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->url = $url;
    }
}