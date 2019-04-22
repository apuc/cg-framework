<html>
{include file="{$workspace_dir}/assets/resources.tpl"}
<head>
    {$smarty.capture.meta}
    <title>{$title}</title>
    {$smarty.capture.css}
    {$smarty.capture.js_head}
</head>
<body>
{$content}

{$smarty.capture.js_body}
</body>
</html>