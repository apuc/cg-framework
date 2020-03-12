<div class="h1">{$h1}</div>

<a href="/settings/create" class="btn btn-dark">Create</a>
{core\GridView::widget()->setParams($model, $options)->run()}
