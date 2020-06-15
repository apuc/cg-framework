{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
<div class="h1">{$h1}</div>

<div class="container">
    {if !empty($errors)}
        {foreach from=$errors item=error}
            <div class="alert alert-danger" role="alert">
                {$error}
            </div>
        {/foreach}
    {/if}
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/product/create">
        <div class="form-group">
            <label for="name">Название:</label>
            <input type="text" name="name" id="name" class="form-control" required="required"/>
            <label for="description">Описание:</label>
            <input type="text" name="description" id="description" class="form-control" required="required"/>
            <label for="status">Статус:</label>
            <input type="number" name="status" id="status" class="form-control" required="required"/>
            <label for="price">Цена:</label>
            <input type="text" name="price" id="price" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Добавить">
        </div>
    </form>
</div>