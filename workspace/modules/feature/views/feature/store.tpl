{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
{*<div class="h1">{$h1}</div>*}

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/feature/create">
        <div class="form-group">
            <label for="tour_id">Tour_id:</label>
            <input type="text" name="tour_id" id="tour_id" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="feature">Feature:</label>
            <input type="text" name="feature" id="feature" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" name="type" id="type" class="form-control"  required="required" />
        </div>


        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>