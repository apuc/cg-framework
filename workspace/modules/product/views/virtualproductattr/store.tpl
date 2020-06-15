{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
<div class="h1">{$h1}</div>

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/virtualproductattr/create">
        <div class="form-group">
            <label for="firstname">Attribute value id:</label>
            <input type="text" name="attr_value_id" id="attr_value_id" class="form-control" required="required"/>
            <label for="firstname">Virtual product id:</label>
            <input type="text" name="virtual_product_id" id="virtual_product_id" class="form-control" required="required"/>
            <label for="firstname">Status:</label>
            <input type="text" name="status" id="status" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>