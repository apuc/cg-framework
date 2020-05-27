{assign var="url" value="{'categorych/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->name, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->name}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/categorych/update/{$model->id}">
        <div class="form-group">
            <label for="firstname">Category id:</label>
            <input type="text" name="category_id" id="category_id" class="form-control" required="required" value="{$model->category_id}" />
            <label for="firstname">Characteristic id:</label>
            <input type="text" name="characteristic_id" id="characteristic_id" class="form-control" required="required" value="{$model->characteristic_id}" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>