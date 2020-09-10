<div class="h1">{$h1}</div>

<a href="/admin/order/create" class="btn btn-dark">Добавить</a>
{core\GridView::widget()
->addActionBtn(['upload' => ['class' => 'custom-link', 'id' => '', 'icon' => '<i class="fas fa-angle-double-up"></i>', 'url' => '/upload/{id}']])
->setParams($model, $options)
->run()}
{*{core\Pagination::widget()->setParams(5)->run()}*}
