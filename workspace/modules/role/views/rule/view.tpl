{assign var="url" value="{'/admin/roles/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->key, 'url' => $url])}
<div class="h1">{$model->key}</div>

{if isset($errors)}
    {foreach from=$errors item=error}
        <div class="alert alert-danger" role="alert">
            {$error}
        </div>
    {/foreach}
{/if}

{core\DetailView::widget()->setParams($model, $options)->run()}

<a href="/admin/rules/update/{$model->id}" class="btn btn-dark">Edit</a>
<p></p>

<div class="h1">Роли, владеющие этим правом:</div>
{core\GridView::widget()->setParams($roles['data'], $roles)->run()}