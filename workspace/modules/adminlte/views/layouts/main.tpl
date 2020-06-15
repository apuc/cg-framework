<html>
{include file="{$workspace_dir}/modules/adminlte/assets/resources.tpl"}
<head>
    {$smarty.capture.meta}
    <title>{$title}</title>
    {$meta}
    {*    <title>{$smarty.capture.title}</title>*}
    {$smarty.capture.css}
    {$smarty.capture.js_head}
    {$jsHead}
</head>
<body>

<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        {workspace\modules\adminlte\widgets\TopMenu::widget()->run()}

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
{*            <li class="nav-item dropdown">*}
{*                <a class="nav-link" data-toggle="dropdown" href="#">*}
{*                    <i class="far fa-comments"></i>*}
{*                    <span class="badge badge-danger navbar-badge">3</span>*}
{*                </a>*}
{*                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">*}
{*                    <a href="#" class="dropdown-item">*}
{*                        <!-- Message Start -->*}
{*                        <div class="media">*}
{*                            <img src="/workspace/modules/adminlte/resources/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">*}
{*                            <div class="media-body">*}
{*                                <h3 class="dropdown-item-title">*}
{*                                    Brad Diesel*}
{*                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>*}
{*                                </h3>*}
{*                                <p class="text-sm">Call me whenever you can...</p>*}
{*                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>*}
{*                            </div>*}
{*                        </div>*}
{*                        <!-- Message End -->*}
{*                    </a>*}
{*                    <div class="dropdown-divider"></div>*}
{*                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>*}
{*                </div>*}
{*            </li>*}
            <!-- Notifications Dropdown Menu -->
{*            <li class="nav-item dropdown">*}
{*                <a class="nav-link" data-toggle="dropdown" href="#">*}
{*                    <i class="far fa-bell"></i>*}
{*                    <span class="badge badge-warning navbar-badge">15</span>*}
{*                </a>*}
{*                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">*}
{*                    <span class="dropdown-item dropdown-header">15 Notifications</span>*}
{*                    <div class="dropdown-divider"></div>*}
{*                    <a href="#" class="dropdown-item">*}
{*                        <i class="fas fa-envelope mr-2"></i> 4 new messages*}
{*                        <span class="float-right text-muted text-sm">3 mins</span>*}
{*                    </a>*}
{*                    <div class="dropdown-divider"></div>*}
{*                    <a href="#" class="dropdown-item">*}
{*                        <i class="fas fa-users mr-2"></i> 8 friend requests*}
{*                        <span class="float-right text-muted text-sm">12 hours</span>*}
{*                    </a>*}
{*                    <div class="dropdown-divider"></div>*}
{*                    <a href="#" class="dropdown-item">*}
{*                        <i class="fas fa-file mr-2"></i> 3 new reports*}
{*                        <span class="float-right text-muted text-sm">2 days</span>*}
{*                    </a>*}
{*                    <div class="dropdown-divider"></div>*}
{*                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>*}
{*                </div>*}
{*            </li>*}
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="/workspace/modules/adminlte/resources/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{core\App::$config['app_name']}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/workspace/modules/adminlte/resources/dist/img/user1-128x128.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{workspace\models\User::getCurrentUserName()}</a>
                    <div class="logout-line"><a href="/logout">Logout</a></div>
                </div>
            </div>

            {workspace\modules\adminlte\widgets\LeftMenu::widget()->run()}

        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {core\BreadCrumbs::widget()->run()}
                {$content}
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
            <b>Version</b> 3.0.2
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

{$smarty.capture.js_body}
{$jsEndBody}
</body>
</html>