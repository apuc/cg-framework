{assign var="url" value="{'tags/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->name, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}

{if isset($errors)}
    {foreach from=$errors item=error}
        <div class="alert alert-danger" role="alert">
            {$error}
        </div>
    {/foreach}
{/if}

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/tags/update/{$model->id}">
        <div class="form-group">
            <label for="name">Тег:</label>
            <input type="text" name="name" id="name" class="form-control" value="{$model->name}" required="required"/>
        </div>
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{$model->slug}" required="required"/>
        </div>

        {$statusSelect}

        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>