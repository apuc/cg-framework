{*<div class="loader"></div>*}
<div class="module-action">
    <h3 class="title-center ">Версии ядра</h3>
    <div class="content-center">
        <a href="/" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> на главную</a>
    </div>
    {core\Cjax::widget(['id' => 'cjax', 'data' => core\GridView::widget($options)->run()])->run()}
    <br>
</div>