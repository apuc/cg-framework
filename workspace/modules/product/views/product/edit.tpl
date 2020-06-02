{assign var="url" value="{'product/'}{$model->id}"}
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
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/product/update/{$model->id}">
        <div class="form-group">
            <label for="name">Название:</label>
            <input type="text" name="name" id="name" class="form-control" required="required" value="{$model->name}" />
            <label for="description">Описание:</label>
            <input type="text" name="description" id="description" class="form-control" required="required" value="{$model->description}" />
            <label for="status">Статус:</label>
            <input type="number" name="status" id="status" class="form-control" required="required" value="{$model->status}" />
            <label for="price">Цена:</label>
            <input type="number" name="price" id="price" class="form-control" required="required" value="{$virtual_product->price}" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Обновить">
        </div>
    </form>
</div>