{*<div class="loader"></div>*}
<div class="module-action">
    <div class="content-center">
        <a href="/" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> на главную</a>
        <a href="../../../index.php" class="btn btn-dark"><i class="fas fa-edit"></i> подтянуть ядро</a>
    </div>
    <h3 class="title-center ">Версии ядра</h3>
    {core\Cjax::widget(['id' => 'cjax', 'data' => core\GridView::widget($options)->run()])->run()}
    <br>
</div>