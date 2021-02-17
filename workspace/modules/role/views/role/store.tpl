{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
<div class="h1">{$h1}</div>

{if isset($errors)}
    {foreach from=$errors item=error}
        <div class="alert alert-danger" role="alert">
            {$error}
        </div>
    {/foreach}
{/if}

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/roles/create">
        <div class="form-group">
            <label for="key">Name:</label>
            <input type="text" name="key" id="key" class="form-control" required="required"/>
        </div>
        <div>
            <label for="rules">Select rules:</label>
            <select class="form-control select2-selection select2-selection--multiple" name="rules[]" id="rules"
                    multiple="multiple">
                {foreach from=$rules item=rule}
                    <option value="{$rule->id}">{$rule->key}</option>
                {/foreach}
            </select>
        </div>
        <p></p>
        <div>
            <label for="users">Give it to:</label>
            <select class="form-control select2-selection select2-selection--multiple" name="users[]" id="users"
                    multiple="multiple">
                {foreach from=$users item=user}
                    <option value="{$user->id}">{$user->username}</option>
                {/foreach}
            </select>
        </div>
        <p></p>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>