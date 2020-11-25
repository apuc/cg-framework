{*<div class="loader"></div>*}
<div class="module-action">
    <h3 class="title-center ">Версии ядра</h3>
    <div class="content-center">
        <a href="/" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> на главную</a>
        <a href="/update-core-mods" class="btn btn-dark"><i class="fas fa-edit"></i> подтянуть активное ядро</a>
    </div>
    {core\Cjax::widget(['id' => 'cjax', 'data' => core\GridView::widget($options)->run()])->run()}
    <br>
</div>