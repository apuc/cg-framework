{core\BreadCrumbs::widget()->setParams($bc_options)->run()}
<div class="h1">{$h1}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/article/update/{$id}">
        <div class="form-group">
            <label for="name">Заголовок:</label>
            <input type="text" name="name" id="name" class="form-control" required="required" value="{$article->name}" />
        </div>
        <div class="form-group">
            <label for="text">Статья:</label>
            <textarea rows="7" name="text" id="text" class="form-control" required="required">{$article->text}</textarea>
        </div>
        <div class="form-group">
            <label for="language_id">Язык:</label>
            <select class="form-control" name="language_id" id="language_id">
                {foreach from=$language key=key item=item}
                    {if $key == $article->language_id}
                        <option selected value="{$key}">{$item}</option>
                    {else}
                        <option value="{$key}">{$item}</option>
                    {/if}

                {/foreach}
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>