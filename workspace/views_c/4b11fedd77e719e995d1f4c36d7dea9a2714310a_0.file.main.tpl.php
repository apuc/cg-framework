<?php
/* Smarty version 3.1.33, created on 2020-02-08 11:18:07
  from '/var/www/cgframe.loc/workspace/views/layouts/main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e3e6ebf18e583_17795222',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b11fedd77e719e995d1f4c36d7dea9a2714310a' => 
    array (
      0 => '/var/www/cgframe.loc/workspace/views/layouts/main.tpl',
      1 => 1581149885,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e3e6ebf18e583_17795222 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['workspace_dir']->value)."/assets/resources.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
<head>
    <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'meta');?>

    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <?php echo $_smarty_tpl->tpl_vars['meta']->value;?>

    <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'css');?>

    <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'js_head');?>

    <?php echo $_smarty_tpl->tpl_vars['jsHead']->value;?>

</head>
<body>
<?php echo $_smarty_tpl->tpl_vars['content']->value;?>


<?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'js_body');?>

<?php echo $_smarty_tpl->tpl_vars['jsEndBody']->value;?>

</body>
</html><?php }
}
