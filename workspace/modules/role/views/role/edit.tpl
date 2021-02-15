{assign var="url" value="{'/admin/roles/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->key, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->key}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post"
          action="/admin/roles/update/{$model->id}">
        <div class="form-group">
            <label for="firstname">Name:</label>
            <input type="text" name="key" id="key" class="form-control" required="required" value="{$model->key}"/>
        </div>

        <div>
{*            {$selectRules}*}
        </div>

        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>