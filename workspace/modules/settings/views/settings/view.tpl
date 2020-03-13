{assign var="url" value="{'settings/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->key, 'url' => $url])}
<div class="h1">{$model->key}</div>

{core\DetailView::widget()->setParams($model, $options)->run()}