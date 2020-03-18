<div class="h1">Themes Module</div>

<h5>Текущая тема: <span class="blue-text">{$theme->value}</span></h5>
<a href="/themes/create" class="btn btn-dark">Изменить текущую тему</a>
<a href="#" class="btn btn-dark">Загрузить тему</a>

<br><br><div>Список доступных тем:</div>
{core\GridView::widget()->setParams($model, $options)->run()}