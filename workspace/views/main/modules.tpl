<a href="/" class="back">вернуться на главную</a>
<div class="module-action">
    <h2 class="title-center ">Выбор активных модулей</h2>
    <div class="content-center"><a href="/update-manifest" class="btn btn-dark">Активировать модули</a></div>

    {core\Cjax::widget(['id' => 'cjax', 'data' => core\GridView::widget($options)->run()])->run()}

{*    {core\Cjax::widget(['id' => 'cjax1', 'point' => 'start'])->run()}*}
{*    <div>*}
{*        <p></p>*}
{*    </div>*}
{*    {core\Cjax::widget(['point' => 'end'])->run()}*}
</div>