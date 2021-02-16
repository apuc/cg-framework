{assign var="url" value="{'users/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->username, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}

<div class="h1">{$h1} {$model->username}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/users/update/{$model->id}">
        <div class="form-group">
            <label for="username">Логин:</label>
            <input type="text" name="username" id="username" class="form-control" required="required" value="{$model->username}" />
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" class="form-control" required="required" value="{$model->email}" />
        </div>
        <div>
            <label for="rules">Select roles:</label>
            <select class="form-control select2-selection select2-selection--multiple" name="roles[]" id="roles"
                    multiple="multiple">
                {foreach from=$roles item=role}
                    <option value="{$role->key}" {if $linked_roles->containsStrict('id', $role->id) }selected{/if}>{$role->key}</option>
                {/foreach}
            </select>
        </div>
        <p></p>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>