{core\App::$breadcrumbs->addItem(['text' => 'Create'])}

{if isset($errors)}
    {foreach from=$errors item=error}
        <div class="alert alert-danger" role="alert">
            {$error}
        </div>
    {/foreach}
{/if}

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


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

        {$sel2}
        <!--
                <div class="form-group">
                    <label for="status">Статус:</label>
                    <select type="text" name="status" id="status" class="select2-selection--single form-control" required="required">
                        <option value="1" selected="selected">Активен</--option>
                        <option value="0">Неактивен</--option>
                    </select>
        </div>
        -->
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