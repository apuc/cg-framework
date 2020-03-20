<div class="h1">Themes Module</div>

<h5>Текущая тема: <span class="blue-text">{$theme->value}</span></h5>
{*<a href="/themes/create" class="btn btn-dark">Изменить текущую тему</a>*}
{*<button id="download" class="btn btn-dark">Загрузить тему</button>*}
{*<a href="#" class="btn btn-dark">Загрузить тему</a>*}

{*<div>Список тем:</div>*}
{core\GridView::widget()->setParams($model, $options)->deleteActionBtn('delete')->deleteActionBtn('edit')->deleteActionBtn('view')->run()}