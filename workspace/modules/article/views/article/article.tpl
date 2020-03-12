{core\BreadCrumbs::widget()->setParams($bc_options)->run()}
<div class="h1">{$h1}</div>

<a href="/article/create" class="btn btn-dark">Create</a>
{core\GridView::widget()->setParams($model, $options)->run()}
