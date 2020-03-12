{core\BreadCrumbs::widget()->setParams($bc_options)->run()}
<div class="h1">{$h1}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/settings/update/{$id}">
        <div class="form-group">
            <label for="firstname">Key:</label>
            <input type="text" name="key" id="key" class="form-control" required="required" value="{$settings->key}" />
        </div>
        <div class="form-group">
            <label for="lastname">Value:</label>
            <textarea rows="7" name="value" id="value" class="form-control" required="required">{$settings->value}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>