{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
<div class="h1">{$h1}</div>

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/article/create">
        <div class="form-group">
            <label for="name">Заголовок:</label>
            <input type="text" name="name" id="name" class="form-control" required="required" />
        </div>
        <div class="form-group">
            <label for="text">Статья:</label>
            <textarea rows="7" name="text" id="text" class="form-control" required="required"></textarea>
        </div>
        <div class="form-group">
            <label for="language_id">Язык:</label>
            <select class="form-control" name="language_id" id="language_id">
                {foreach from=$language key=key item=item}
                    <option value="{$key}">{$item}</option>
                {/foreach}
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>