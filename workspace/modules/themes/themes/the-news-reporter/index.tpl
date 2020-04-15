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
            <div class="main_content floatleft">
                <div class="left_coloum floatleft">

                    {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/layouts/main.tpl"}

                    {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/layouts/gallery.tpl"}
                </div>
            </div>
            <div class="sidebar floatright">
                <div class="single_sidebar">
                    <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/add1.png" alt=""/>
                </div>

                {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/layouts/popular.tpl"}

                <div class="single_sidebar">
                    <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/add1.png" alt=""/>
                </div>
                <div class="single_sidebar">
                    <h2 class="title">ADD</h2>
                    <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/add2.png" alt=""/>
                </div>
            </div>
        </div>
        {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/layouts/footer.tpl"}
    </div>
</div>
</body>
</html>