<div class="h1">{$h1}</div>

<a href="/admin/product/create" class="btn btn-dark">Добавить</a>
<a href="/admin/product/download" class="btn btn-dark">Загрузить из 1с</a>
{core\GridView::widget()->setParams($model, $options)->run()}
{*{core\Pagination::widget()->setParams(5)->run()}*}
