<div class="h1">{$h1}</div>

{core\GridView::widget()
->deleteActionBtn('edit')
->deleteActionBtn('view')
->deleteActionBtn('delete')
->setParams($model, $options)
->run()}
{*core\Pagination::widget()->setParams(1,5,['per_page'=>1])->run()*}
