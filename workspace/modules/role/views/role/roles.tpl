<div class="h1">{$h1}</div>
<a href="/admin/roles/create" class="btn btn-dark">Create</a>

{if isset($errors)}
    {foreach from=$errors item=error}
        <div class="alert alert-danger" role="alert">
            {$error}
        </div>
    {/foreach}
{/if}


{core\GridView::widget()->setParams($model, $options)->run()}

{*{core\Cjax::widget(['id' => 'cjax', 'data' => core\GridView::widget($options)->run()])->run()}*}
{*{core\Pagination::widget()->setParams(5)->run()}*}
