<div class="module-action">
    <h2 class="title-center ">Выбор активных модулей</h2>
    {core\GridView::widget()->setParams($model, $options)->deleteActionBtn('delete')->deleteActionBtn('edit')->deleteActionBtn('view')->run()}
    <div class="info">
        <a href="https://github.com/apuc/component_rep">GitHub</a>
    </div>
</div>