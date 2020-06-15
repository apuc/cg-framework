{assign var="url" value="{'virtualproductattr/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->id, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->id}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/virtualproductattr/update/{$model->id}">
        <div class="form-group">
            <label for="firstname">Attribute value id:</label>
            <input type="text" name="attr_value_id" id="attr_value_id" class="form-control" required="required" value="{$model->attr_value_id}" />
            <label for="firstname">Virtual product id:</label>
            <input type="text" name="virtual_product_id" id="virtual_product_id" class="form-control" required="required" value="{$model->virtual_product_id}" />
            <label for="firstname">Status:</label>
            <input type="text" name="status" id="status" class="form-control" required="required" value="{$model->status }" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>