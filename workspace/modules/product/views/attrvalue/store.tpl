{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
<div class="h1">{$h1}</div>

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/attrvalue/create">
        <div class="form-group">
            <label for="firstname">Атрибут:</label>
            <input type="text" name="attr_id" id="attr_id" class="form-control" required="required"/>
            <label for="firstname">Значение:</label>
            <input type="text" name="value" id="value" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>