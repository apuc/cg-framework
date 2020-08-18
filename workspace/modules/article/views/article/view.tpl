{assign var="url" value="{'article/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->name, 'url' => $url])}
<div class="h1">{$model->name}</div>

{core\DetailView::widget()->setParams($model, $options)->run()}