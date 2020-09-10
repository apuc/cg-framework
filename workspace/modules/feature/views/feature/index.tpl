<div class="h1">{$h1}</div>
<a href="/admin/feature/create" class="btn btn-dark">Создать</a>
{core\GridView::widget()->setParams($model, $options)->run()}