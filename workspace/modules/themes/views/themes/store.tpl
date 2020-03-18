<div class="container">
    <form class="form-horizontal" name="themes_form" id="themes_form" method="post" action="/themes/create">
        <div class="form-group">
            <label for="theme">Тема:</label>
            <select class="form-control" name="theme" id="theme">
                {foreach from=$themes key=key item=item}
                    {if $key == $current_theme}
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