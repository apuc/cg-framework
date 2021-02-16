{assign var="url" value="{'/admin/roles/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->key, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->key}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post"
          action="/admin/roles/update/{$model->id}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="firstname">Name:</label>
            <input type="text" name="key" id="key" class="form-control" required="required" value="{$model->key}"/>
        </div>
        <div>
            <select class="form-control select2-selection select2-selection--multiple" role="combobox"
                    aria-haspopup="true" tabindex="-1" aria-disabled="false" name="rules[]" id="rules"
                    multiple="multiple">
                {foreach from=$rules item=rule}
                    <option value="{$rule->key}"
                            {if $linked_rules->containsStrict('id', $rule->id) }selected{/if}>{$rule->key}</option>
                {/foreach}
            </select>
        </div>
        <p></p>
        <div>
            <select class="form-control select2-selection select2-selection--multiple" name="users[]" id="users"
                    multiple="multiple">
                {foreach from=$users item=user}
                    <option value="{$user->username}"
                            {if $linked_users->containsStrict('id', $user->id) }selected{/if}>{$user->username}</option>
                {/foreach}
            </select>
        </div>
        <p></p>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>