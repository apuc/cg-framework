<h1 class="h1">{$h1}</h1>

{core\GridView::widget()->setParams($settings, $options)->addActionBtn(['crud_async' => ['class' => '', 'id' => '', 'icon' => '<i class="fas fa-biohazard"></i>', 'url' => '/async/{id}']])->deleteActionBtn('view')->run()}