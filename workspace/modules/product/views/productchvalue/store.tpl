{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
<div class="h1">{$h1}</div>

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/productchvalue/create">
        <div class="form-group">
            <label for="firstname">Category id:</label>
            <input type="text" name="ch_value_id" id="ch_value_id" class="form-control" required="required"/>
            <label for="firstname">Product id:</label>
            <input type="text" name="product_id" id="product_id" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>