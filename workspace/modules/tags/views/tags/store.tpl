{core\App::$breadcrumbs->addItem(['text' => 'Create'])}

{if isset($errors)}
    {foreach from=$errors item=error}
        <div class="alert alert-danger" role="alert">
            {$error}
        </div>
    {/foreach}
{/if}

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/tags/create">
        <div class="form-group">
            <label for="name">Тег:</label>
            <input type="text" name="name" id="name" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="status">Статус:</label>
            <input type="text" name="status" id="status" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" name="type" id="type" class="form-control" required="required" value=""/>
        </div>
        <div class="form-group">
            <label for="type_id">Type_id:</label>
            <input type="text" name="type_id" id="type_id" class="form-control" required="required" value=""/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>