<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
{include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/assets/resources.tpl"}
<head>
    {$smarty.capture.meta}
    <title>The News Reporter</title>
    {$smarty.capture.css}
    {$smarty.capture.js_head}
</head>
<body>
<div class="body_wrapper">
    <div class="center">
        {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/layouts/header.tpl"}
        {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/layouts/menu.tpl"}
        <div class="content_area">
            {foreach from=$articles item=item}
                <div class="single_left_coloum floatleft">
                    {$item->image}
                    <h3> {$item->name} </h3>
                    <div class="article_text_small"><p> {$item->text} </p></div>
                    <a class="readmore" href="/read/{$item->id}">read more</a>
                </div>
            {/foreach}
        </div>
        {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/layouts/footer.tpl"}
    </div>
</body>
</html>