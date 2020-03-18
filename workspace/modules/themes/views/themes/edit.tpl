{assign var="url" value="{'themes/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->theme, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->theme}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/themes/update/{$model->id}">
        <div class="form-group">
            <label for="firstname">Название темы:</label>
            <input type="text" name="theme" id="theme" class="form-control" required="required" value="{$model->theme}" />
        </div>
        <div class="form-group">
            <label for="lastname">Версия:</label>
            <textarea rows="7" name="version" id="version" class="form-control" required="required">{$model->version}</textarea>
        </div>
        <div class="form-group">
            <label for="lastname">Описание:</label>
            <textarea rows="7" name="description" id="description" class="form-control" required="required">{$model->description}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>