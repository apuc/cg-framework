{assign var="url" value="{'feature/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->id, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->id}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/feature/update/{$model->id}">
        <div class="form-group">
            <label for="tour_id">Tour_id:</label>
            <input type="text" name="tour_id" id="tour_id" class="form-control" value="{$model->tour_id}" required="required" />
        </div>

        <div class="form-group">
            <label for="feature">Feature:</label>
            <input type="text" name="feature" id="feature" class="form-control" value="{$model->feature}" required="required" />
        </div>

        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" name="type" id="type" class="form-control" value="{$model->type}" required="required" />
        </div>


        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>