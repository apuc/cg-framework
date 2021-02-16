{assign var="url" value="{'/admin/roles'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->key, 'url' => $url])}

<div class="h1">{$model->key}</div>
{core\DetailView::widget()->setParams($model, $options)->run()}

<a href="/admin/roles/update/{$model->id}" class="btn btn-dark">Edit</a>
<p></p>

<div class="h1">Права</div>
{core\GridView::widget()->setParams($rules['data'], $rules)->run()}

<div class="h1">Пользователи с этой ролью:</div>
{core\GridView::widget()->setParams($users['data'], $users)->run()}