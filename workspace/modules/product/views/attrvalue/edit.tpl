{assign var="url" value="{'attrvalue/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->id, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->id}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/attrvalue/update/{$model->id}">
        <div class="form-group">
            <label for="firstname">Атрибут:</label>
            <input type="text" name="attr_id" id="attr_id" class="form-control" required="required" value="{$model->attr_id}" />
            <label for="firstname">Значение:</label>
            <input type="text" name="value" id="value" class="form-control" required="required" value="{$model->value}" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>