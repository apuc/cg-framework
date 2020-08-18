<a href="/" class="back">вернуться на главную</a>
<div class="module-action">
    <h2 class="title-center ">Выбор активных модулей</h2>
    <div class="content-center"><a href="/activmods" class="btn btn-dark">Активировать модули</a></div>
    {core\GridView::widget()->setParams($model, $options)->deleteActionBtn('delete')->deleteActionBtn('edit')->deleteActionBtn('view')->run()}
    <div class="info">
        <a href="https://github.com/apuc/component_rep">GitHub</a>
    </div>
</div>

<div class="modal fade" id="modalCGCloudUpload" tabindex="-1" role="dialog" aria-labelledby="modalCGCloudUpload" aria-hidden="true" data-name="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <h5>Войти в CGCloud аккунт</h5>
                    <form class="form-horizontal" name="cgcloud-sign-in" id="cgcloud-sign-in" method="post">
                        <div class="form-group">
                            <label for="username">Логин:</label>
                            <input type="text" name="username" id="username" class="form-control" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль:</label>
                            <input type="password" name="password" id="password" class="form-control" required="required" />
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="cgcloud_button" data-name="">Войти</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Отмена</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCGCloudReg" tabindex="-1" role="dialog"
     aria-labelledby="modalCGCloudReg" aria-hidden="true" data-id="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <h5>Зарегестириоваться в CGCloud</h5>
                    <form class="form-horizontal" name="cgcloud-sign-up" id="cgcloud-sign-up" method="post">
                        <div class="form-group">
                            <label for="username">Логин:</label>
                            <input type="text" name="username" id="username" class="form-control" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль:</label>
                            <input type="password" name="password" id="password" class="form-control" required="required" />
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-dark" data-dismiss="modal" id="cgcloudreg_button">Регистрация</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Отмена</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>