{assign var="url" value="{'/admin/promocode/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->name, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->name}</div>

<div class="container">

    {if !empty($errors)}
        {foreach from=$errors item=error}
            <div class="alert alert-danger" role="alert">
                {$error}
            </div>
        {/foreach}
    {/if}

    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/promocode/update/{$model->id}">
        <div class="form-group">
            <label for="firstname">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required="required" value="{$model->name}" />
        </div>
        <div class="form-group">
            <label for="lastname">Discount:</label>
            <input type="text" name="discount" id="discount" class="form-control" required="required" value="{$model->discount}"/>
        </div>
        <div class="form-group">
            <label for="lastname">Active from:</label>
            <input type="date" name="active_from" id="active_from" class="form-control" required="required" value="{$model->active_from}"/>
        </div>
        <div class="form-group">
            <label for="lastname">Active to:</label>
            <input type="date" name="active_to" id="active_to" class="form-control" required="required" value="{$model->active_to}"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>