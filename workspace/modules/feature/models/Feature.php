<?php


namespace workspace\modules\feature\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\feature\requests\FeatureSearchRequest;

class Feature extends Model
{
    protected $table = "feature";

    public $fillable = ['tour_id', 'feature', 'type', 'created_at', 'updated_at'];

    public function _save()
    {
            $this->tour_id = $_POST["tour_id"];
            $this->feature = $_POST["feature"];
            $this->type = $_POST["type"];

        $this->save();
    }

    /**
     * @param FeatureSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(FeatureSearchRequest $request)
    {
        $query = self::query();

        if($request->id)
            $query->where('id', 'LIKE', "%$request->id%");

        if($request->tour_id)
            $query->where('tour_id', 'LIKE', "%$request->tour_id%");

        if($request->feature)
            $query->where('feature', 'LIKE', "%$request->feature%");

        if($request->type)
            $query->where('type', 'LIKE', "%$request->type%");

        if($request->created_at)
            $query->where('created_at', 'LIKE', "%$request->created_at%");

        if($request->updated_at)
            $query->where('updated_at', 'LIKE', "%$request->updated_at%");


        return $query->get();
    }
}