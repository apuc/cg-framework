{assign var="url" value="{'tags/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->username, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->username}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/tags/update/{$model->id}">
        <div class="form-group">
            <label for="name">Логин:</label>
            <input type="text" name="username" id="username" class="form-control" required="required" value="{$model->name}" />
        </div>
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" class="form-control" required="required" value="{$model->slug}" />
        </div>
        <div class="form-group">
            <label for="status">Статус:</label>
            <input type="text" name="status" id="status" class="form-control" required="required" value="{$model->status}" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>