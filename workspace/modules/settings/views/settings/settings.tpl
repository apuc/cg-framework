<div class="h1">{$h1}</div>

<a href="/admin/settings/create" class="btn btn-dark">Создать</a>
{core\GridView::widget()->setParams($model, $options)->run()}
{*{core\Pagination::widget()->setParams(5)->run()}*}
