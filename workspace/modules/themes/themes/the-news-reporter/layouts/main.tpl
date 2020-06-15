<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
{include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/assets/resources.tpl"}
<head>
    {$smarty.capture.meta}
    <title>{$title}</title>
    {$meta}
    {$smarty.capture.css}
    {$smarty.capture.js_head}
    {$jsHead}
</head>
<body>
{$content}
{$smarty.capture.js_body}
</body>
</html>