{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
<div class="h1">{$h1}</div>

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/article/create">
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

        {core\Select2::widget()->setParams($categories_obj, $select_options, [])->run()}

        <div class="form-group">
            <label for="image">Имя картинки:</label>
            <input type="text" name="image" id="image" class="form-control" required="required" />
        </div>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" />
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" class="form-control" />
        </div>
        <div class="form-group">
            <label for="keywords">Keywords:</label>
            <input type="text" name="keywords" id="keywords" class="form-control" />
        </div>
        <div class="form-group">
            <label for="url">Url:</label>
            <input type="text" name="url" id="url" class="form-control" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Сохранить">
        </div>
    </form>
</div>