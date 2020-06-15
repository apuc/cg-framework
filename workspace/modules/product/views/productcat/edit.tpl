{assign var="url" value="{'productcat/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->id, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->id}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/productcat/update/{$model->id}">
        <div class="form-group">
            <label for="firstname">Category id:</label>
            <input type="text" name="cat_id" id="cat_id" class="form-control" required="required" value="{$model->cat_id}" />
            <label for="firstname">Product id:</label>
            <input type="text" name="product_id" id="product_id" class="form-control" required="required" value="{$model->product_id}" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>