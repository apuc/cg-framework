{assign var="url" value="{'articles/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->name, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}

<div class="h1">{$h1} {$model->name}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/article/update/{$model->id}">
        <div class="form-group">
            <label for="name">Заголовок:</label>
            <input type="text" name="name" id="name" class="form-control" required="required" value="{$model->name}" />
        </div>
        <div class="form-group">
            <label for="text">Статья:</label>
            <textarea rows="7" name="text" id="text" class="form-control" required="required">{$model->text}</textarea>
        </div>
        <div class="form-group">
            <label for="language_id">Язык:</label>
            <select class="form-control" name="language_id" id="language_id">
                {foreach from=$languages key=key item=item}
                    {if $key == $model->language_id}
                        <option selected value="{$key}">{$item}</option>
                    {else}
                        <option value="{$key}">{$item}</option>
                    {/if}
                {/foreach}
            </select>
        </div>

        {core\Select2::widget()->setParams($categories_obj, $select_options, $selected_categories)->run()}

        <div class="form-group">
            <label for="image">Имя картинки:</label>
            <input type="text" name="image" id="image" class="form-control" required="required" value="{$model->image_name}" />
        </div>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{$model->title}" />
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" class="form-control" value="{$model->description}" />
        </div>
        <div class="form-group">
            <label for="keywords">Keywords:</label>
            <input type="text" name="keywords" id="keywords" class="form-control" value="{$model->keywords}" />
        </div>
        <div class="form-group">
            <label for="url">Url:</label>
            <input type="text" name="url" id="url" class="form-control" value="{$model->url}" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Сохранить">
        </div>
    </form>
</div>