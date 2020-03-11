{$module}
<h1 class="h1">{$module}</h1>
<a href="/settings/create">Create</a>
{core\GridView::widget()->setParams($model, $options)->run()}