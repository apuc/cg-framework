<div class="h1">Themes Module</div>

<h5>Текущая тема: <span class="blue-text">{$model->value}</span></h5> <a href="/themes/edit" class="btn btn-dark">Изменить</a>

<br><br><div>Список доступных тем:</div>
{core\GridView::widget()->setParams($themes, $options)->run()}

{*<div class="container">*}
{*    <form class="form-horizontal" name="themes_form" id="themes_form" method="post" action="/themes/index">*}
{*        <div class="form-group">*}
{*            <label for="theme">Тема:</label>*}
{*            <select class="form-control" name="theme" id="theme">*}
{*                {foreach from=$themes key=key item=item}*}
{*                    {if $key == $model->value}*}
{*                        <option selected value="{$key}">{$item}</option>*}
{*                    {else}*}
{*                        <option value="{$key}">{$item}</option>*}
{*                    {/if}*}
{*                {/foreach}*}
{*            </select>*}
{*        </div>*}
{*        <div class="form-group">*}
{*            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">*}
{*        </div>*}
{*    </form>*}
{*</div>*}