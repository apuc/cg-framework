{assign var="url" value="{'admin/order/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->fio, 'url' => $url])}
<div class="h1">{$model->fio}</div>

{core\DetailView::widget()->setParams($model, $options)->run()}