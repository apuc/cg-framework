<div class="h1">{$h1}</div>

{if isset($errors)}
    {foreach from=$errors item=error}
        <div class="alert alert-danger" role="alert">
            {$error}
        </div>
    {/foreach}
{/if}

<a href="/admin/rules/create" class="btn btn-dark">Create</a>
{core\GridView::widget()->setParams($model, $options)->run()}

{*{core\Pagination::widget()->setParams(5)->run()}*}
