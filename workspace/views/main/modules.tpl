<div class="module-action">
    <h2 class="title-center ">Выбор активных модулей</h2>
    {core\GridView::widget()->setParams($model, $options)->deleteActionBtn('delete')->deleteActionBtn('edit')->deleteActionBtn('view')->run()}
    <div class="info">
        * Отключение модуля frontend приведет к тому, что на сайте останется только админка. Не откючайте модуль adminlte до тех пор, пока включен хотябы один модуль, кроме frontend.
    </div>
</div>