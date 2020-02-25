<html>
{include file="{$workspace_dir}/assets/resources.tpl"}
<head>
    {$smarty.capture.meta}
    <title>{$title}</title>
    {$meta}
{*    <title>{$smarty.capture.title}</title>*}
    {$smarty.capture.css}
    {$smarty.capture.js_head}
    {$jsHead}
</head>
<body>
{$content}

{$smarty.capture.js_body}
{$jsEndBody}
</body>
</html>