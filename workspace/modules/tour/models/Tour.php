<?php


namespace workspace\modules\tour\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\tour\requests\TourSearchRequest;

class Tour extends Model
{
    protected $table = "tour";

    public $fillable = ['name', 'main_description', 'front_description', 'front_date', 'front_places_remaining', 'price', 'difficulties_and_weather', 'amount_of_places', 'reservation_title', 'visa', 'image_id', 'title_image_id', 'amount_activities_items_1', 'amount_activities_items_2', 'bg_image_id', 'activities_title', 'created_at', 'updated_at'];

    public function _save()
    {
            $this->name = $_POST["name"];
            $this->main_description = $_POST["main_description"];
            $this->front_description = $_POST["front_description"];
            $this->front_date = $_POST["front_date"];
            $this->front_places_remaining = $_POST["front_places_remaining"];
            $this->price = $_POST["price"];
            $this->difficulties_and_weather = $_POST["difficulties_and_weather"];
            $this->amount_of_places = $_POST["amount_of_places"];
            $this->reservation_title = $_POST["reservation_title"];
            $this->visa = $_POST["visa"];
            $this->image_id = $_POST["image_id"];
            $this->title_image_id = $_POST["title_image_id"];
            $this->amount_activities_items_1 = $_POST["amount_activities_items_1"];
            $this->amount_activities_items_2 = $_POST["amount_activities_items_2"];
            $this->bg_image_id = $_POST["bg_image_id"];
            $this->activities_title = $_POST["activities_title"];

        $this->save();
    }

    /**
     * @param TourSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(TourSearchRequest $request)
    {
        $query = self::query();

        if($request->id)
            $query->where('id', 'LIKE', "%$request->id%");

        if($request->name)
            $query->where('name', 'LIKE', "%$request->name%");

        if($request->main_description)
            $query->where('main_description', 'LIKE', "%$request->main_description%");

        if($request->front_description)
            $query->where('front_description', 'LIKE', "%$request->front_description%");

        if($request->front_date)
            $query->where('front_date', 'LIKE', "%$request->front_date%");

        if($request->front_places_remaining)
            $query->where('front_places_remaining', 'LIKE', "%$request->front_places_remaining%");

        if($request->price)
            $query->where('price', 'LIKE', "%$request->price%");

        if($request->difficulties_and_weather)
            $query->where('difficulties_and_weather', 'LIKE', "%$request->difficulties_and_weather%");

        if($request->amount_of_places)
            $query->where('amount_of_places', 'LIKE', "%$request->amount_of_places%");

        if($request->reservation_title)
            $query->where('reservation_title', 'LIKE', "%$request->reservation_title%");

        if($request->visa)
            $query->where('visa', 'LIKE', "%$request->visa%");

        if($request->image_id)
            $query->where('image_id', 'LIKE', "%$request->image_id%");

        if($request->title_image_id)
            $query->where('title_image_id', 'LIKE', "%$request->title_image_id%");

        if($request->amount_activities_items_1)
            $query->where('amount_activities_items_1', 'LIKE', "%$request->amount_activities_items_1%");

        if($request->amount_activities_items_2)
            $query->where('amount_activities_items_2', 'LIKE', "%$request->amount_activities_items_2%");

        if($request->bg_image_id)
            $query->where('bg_image_id', 'LIKE', "%$request->bg_image_id%");

        if($request->activities_title)
            $query->where('activities_title', 'LIKE', "%$request->activities_title%");

        if($request->created_at)
            $query->where('created_at', 'LIKE', "%$request->created_at%");

        if($request->updated_at)
            $query->where('updated_at', 'LIKE', "%$request->updated_at%");


        return $query->get();
    }
}