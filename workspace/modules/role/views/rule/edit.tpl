{assign var="url" value="{'/admin/rules/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->key, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->key}</div>

{if isset($errors)}
    {foreach from=$errors item=error}
        <div class="alert alert-danger" role="alert">
            {$error}
        </div>
    {/foreach}
{/if}

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/rules/update/{$model->id}">
        <div class="form-group">
            <label for="firstname">Key:</label>
            <input type="text" name="key" id="key" class="form-control" required="required" value="{$model->key}" />
        </div>
        <div>
            <select class="form-control select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" tabindex="-1" aria-disabled="false" name="roles[]" id="roles" multiple="multiple">
                {foreach from=$roles item=role}
                    <option value="{$role->key}" {if $linked_roles->containsStrict('id', $role->id) }selected{/if}>{$role->key}</option>
                {/foreach}
            </select>
        </div>
        <p></p>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>