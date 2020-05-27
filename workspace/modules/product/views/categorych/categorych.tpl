<div class="h1">{$h1}</div>

<a href="/categorych/create" class="btn btn-dark">Create</a>
{core\GridView::widget()->setParams($model, $options)->run()}
{*{core\Pagination::widget()->setParams(5)->run()}*}
