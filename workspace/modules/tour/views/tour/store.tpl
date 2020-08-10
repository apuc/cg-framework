{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
{*<div class="h1">{$h1}</div>*}

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/tour/create">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="main_description">Main_description:</label>
            <input type="text" name="main_description" id="main_description" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="front_description">Front_description:</label>
            <input type="text" name="front_description" id="front_description" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="front_date">Front_date:</label>
            <input type="text" name="front_date" id="front_date" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="front_places_remaining">Front_places_remaining:</label>
            <input type="text" name="front_places_remaining" id="front_places_remaining" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control"   />
        </div>

        <div class="form-group">
            <label for="difficulties_and_weather">Difficulties_and_weather:</label>
            <input type="text" name="difficulties_and_weather" id="difficulties_and_weather" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="amount_of_places">Amount_of_places:</label>
            <input type="text" name="amount_of_places" id="amount_of_places" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="reservation_title">Reservation_title:</label>
            <input type="text" name="reservation_title" id="reservation_title" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="visa">Visa:</label>
            <input type="text" name="visa" id="visa" class="form-control"   />
        </div>

        <div class="form-group">
            <label for="image_id">Image_id:</label>
            <input type="text" name="image_id" id="image_id" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="title_image_id">Title_image_id:</label>
            <input type="text" name="title_image_id" id="title_image_id" class="form-control"   />
        </div>

        <div class="form-group">
            <label for="amount_activities_items_1">Amount_activities_items_1:</label>
            <input type="text" name="amount_activities_items_1" id="amount_activities_items_1" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="amount_activities_items_2">Amount_activities_items_2:</label>
            <input type="text" name="amount_activities_items_2" id="amount_activities_items_2" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="bg_image_id">Bg_image_id:</label>
            <input type="text" name="bg_image_id" id="bg_image_id" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="activities_title">Activities_title:</label>
            <input type="text" name="activities_title" id="activities_title" class="form-control"  required="required" />
        </div>


        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>