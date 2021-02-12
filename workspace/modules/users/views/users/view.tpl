{assign var="url" value="{'users/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->username, 'url' => $url])}
<div class="h1">{$model->username}</div>

{core\DetailView::widget()->setParams($model, $options)->run()}

<div class="h1">Роли</div>
<a href="/admin/roles/create?user_name={$model->username}" class="btn btn-dark">Добавить Роль</a>
{*{core\DetailView::widget()->setParams($roles, $role_options)->run()}*}
{core\GridView::widget()->setParams($role_options['data'], $role_options)->run()}

<div class="h1">Права</div>
{core\GridView::widget()->setParams($rule_options['data'], $rule_options)->run()}



