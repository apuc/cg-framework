{assign var="url" value="{'tags/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->name, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}


<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/tags/update/{$model->id}">
        <div class="form-group">
            <label for="name">Тег:</label>
            <input type="text" name="name" id="name" class="form-control" value="{$model->name}" />
        </div>
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{$model->slug}" />
        </div>
        <div class="form-group">
            <label for="status">Статус:</label>
            <input type="text" name="status" id="status" class="form-control" value="{$model->status}" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>