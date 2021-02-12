<div class="h1">Пользователи</div>
<a href="/admin/users/create" class="btn btn-dark">Создать</a>
{core\GridView::widget()->setParams($model, $options)->run()}
{*{core\Cjax::widget(['id' => 'cjax', 'data' => core\GridView::widget($options)->run()])->run()}*}
