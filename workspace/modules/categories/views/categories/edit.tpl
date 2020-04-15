{assign var="url" value="{'categories/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->category, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->category}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/categories/update/{$model->id}">
        <div class="form-group">
            <label for="category">Категория:</label>
            <input type="text" name="category" id="category" class="form-control" required="required" value="{$model->category}" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>