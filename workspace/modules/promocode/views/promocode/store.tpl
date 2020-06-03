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

    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/promocode/create">
        <div class="form-group">
            <label for="firstname">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="lastname">Discount:</label>
            <input type="text" name="discount" id="discount" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="lastname">Active from:</label>
            <input type="date" name="active_from" id="active_from" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="lastname">Active to:</label>
            <input type="date" name="active_to" id="active_to" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>