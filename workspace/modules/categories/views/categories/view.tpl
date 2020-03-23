{assign var="url" value="{'categories/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->category, 'url' => $url])}
<div class="h1">{$model->category}</div>

{core\DetailView::widget()->setParams($model, $options)->run()}