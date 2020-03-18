{assign var="url" value="{'themes/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->theme, 'url' => $url])}
<div class="h1">{$model->theme}</div>

{core\DetailView::widget()->setParams($model, $options)->run()}