<div class="h1">{$h1}</div>
<a href="/admin/tags/create" class="btn btn-dark">Создать</a> //TODO href
{core\Cjax::widget(['id' => 'cjax', 'data' => core\GridView::widget($options)->run()])->run()}
