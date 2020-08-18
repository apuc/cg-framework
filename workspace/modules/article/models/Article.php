<?php


namespace workspace\modules\article\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\article\requests\ArticleSearchRequest;

class Article extends Model
{
    protected $table = "article";

    public $fillable = ['id', 'name', 'text' , 'language_id', 'image_name', 'image', 'parent_id', 'title', 'description', 'keywords', 'url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function language()
    {
        return $this->belongsTo('workspace\models\Language');
    }

    /**
     * @param ArticleSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(ArticleSearchRequest $request)
    {
        $query = self::query();

        if ($request->name)
            $query->where('name', 'LIKE', "%$request->name%");

        if ($request->text)
            $query->where('text', 'LIKE', "%$request->text%");

        if ($request->lang) {
            $query->whereHas('language', function ($q) use ($request){
                $q->where('name', 'LIKE', "%$request->lang%");
            });
        }

        if ($request->title)
            $query->where('title', 'LIKE', "%$request->title%");

        if ($request->description)
            $query->where('description', 'LIKE', "%$request->description%");

        if ($request->keywords)
            $query->where('keywords', 'LIKE', "%$request->keywords%");

        if ($request->url)
            $query->where('url', 'LIKE', "%$request->url%");

        return $query->get();
    }

    public static function saveLocalArticle($model, $data)
    {
        $model = self::saveArticleInfo($model, $data);

        self::saveCategoriesInfo($model, $data);
    }

    public static function saveData($model, $data)
    {
        $model->name = $data->name;
        $model->text = $data->text;
        $model->image_name = $data->image;
        $model->image = '<img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/'. $data->image .'" />';
        $model->parent_id = $data->parent_id;
        $model->language_id = self::getItemId(Language::where('name', $data->language)->first(), new Language(), 'name',  $data->language);

        $settings = Settings::where('key', 'title')->first();

        $model->title = ((isset($data->title) && $data->title) ? $data->title : $data->name . ' | ' . $settings->value);
        $model->description = $data->description;
        $model->keywords = $data->keywords;
        $model->url = ((isset($data->url) && $data->url) ? $data->url : $_SERVER['SERVER_NAME'].'/read/'.$model->id);
        $model->save();

        $existing_categories = array();
        $existing = ArticleCategory::where('article_id', $model->id)->get();
        if($existing)
            foreach ($existing as $item)
                $existing_categories[$item->category_id] = $item->category_id;

        foreach ($data->categories as $value) {
            $category_id = self::getItemId(Category::where('category', $value)->first(), new Category(), 'category',  $value);
            if(in_array($category_id, $existing_categories))
                unset($existing_categories[$category_id]);
            else {
                $ac = new ArticleCategory();
                $ac->article_id = $model->id;
                $ac->category_id = $category_id;
                $ac->save();
                unset($existing_categories[$category_id]);
            }
        }

        if(isset($existing_categories) && $existing_categories) {
            foreach ($existing_categories as $existing_category) {
                $ec = ArticleCategory::where('article_id', $model->id)->where('category_id', $existing_category)->first();
                ArticleCategory::destroy($ec->id);
            }
        }
    }

    public static function saveArticleInfo($model, $data)
    {
        $model->name = $data->name;
        $model->text = $data->text;
        $model->image_name = $data->image;
        $model->image = '<img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/'. $data->image .'" />';
        $model->parent_id = $data->parent_id;
        $model->language_id = $data->language_id;
        $model->title = $data->title;
        $model->description = $data->description;
        $model->keywords = $data->keywords;
        $model->url = $data->url;
        $model->save();

        return $model;
    }

    public static function saveCategoriesInfo($model, $data)
    {
        $existing_categories = array();
        $existing = ArticleCategory::where('article_id', $model->id)->get();
        if($existing)
            foreach ($existing as $item)
                $existing_categories[$item->category_id] = $item->category_id;

        foreach ($data->category_id as $value) {

            if(in_array($value, $existing_categories))
                unset($existing_categories[$value]);
            else {
                $ac = new ArticleCategory();
                $ac->article_id = $model->id;
                $ac->category_id = $value;
                $ac->save();
                unset($existing_categories[$value]);
            }
        }

        if(isset($existing_categories) && $existing_categories) {
            foreach ($existing_categories as $existing_category) {
                $ec = ArticleCategory::where('article_id', $model->id)->where('category_id', $existing_category)->first();
                ArticleCategory::destroy($ec->id);
            }
        }
    }

    public static function getItemId($existing, $new, $field, $item)
    {
        if($existing)
            return $existing->id;
        else {
            $new->$field = $item;
            $new->save();

            return $new->id;
        }
    }
}