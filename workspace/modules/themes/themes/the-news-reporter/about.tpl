<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        <div class="content_area">
          This is a news site.
        </div>
</div>
</body>
</html>