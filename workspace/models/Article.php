<?php


namespace workspace\models;


use core\Debug;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "article";

    public $fillable = ['name', 'text' , 'language_id', 'image_name', 'image', 'parent_id'];

    public static function saveData($model, $data)
    {
        $model->name = $data->name;
        $model->text = $data->text;
        $model->language_id = $data->language_id;
        $model->image_name = $data->image;
        $model->image = '<img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/'. $data->image .'" />';
        $model->parent_id = $data->parent_id;
        $model->save();

        $existing_categories = array();
        $existing = ArticleCategory::where('article_id', $model->id)->get();
        if($existing)
            foreach ($existing as $item)
                $existing_categories[$item->category_id] = $item->category_id;

        foreach ($data->categories as $value) {
            $category = Category::where('category', $value)->first();

            if(in_array($category->id, $existing_categories)) {
                unset($existing_categories[$category->id]);
                Debug::prn('existing category');
            }
            else {
                $ac = new ArticleCategory();
                $ac->article_id = $model->id;
                $ac->category_id = $category->id;
                $ac->save();
                unset($existing_categories[$category->id]);
                Debug::prn('new category');
            }
        }

        if(isset($existing_categories) && $existing_categories) {
            foreach ($existing_categories as $existing_category) {
                $ec = ArticleCategory::where('article_id', $model->id)->where('category_id', $existing_category)->first();
                ArticleCategory::destroy($ec->id);
                Debug::prn('delete category');
            }
        }
    }
}