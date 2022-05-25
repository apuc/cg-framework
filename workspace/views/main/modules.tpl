{*<div class="loader"></div>*}
<div class="module-action">
    <h2 class="title-center ">Менеджер модулей</h2>
    <div class="content-center">
        <a href="/" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> на главную</a>
        <a href="/update-manifest" class="btn btn-dark"><i class="fas fa-edit"></i> подтянуть локальные модули</a>
    </div>
    {core\Cjax::widget(['id' => 'cjax', 'data' => core\GridView::widget($options)->run()])->run()}
</div>