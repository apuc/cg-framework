<?php
/* Smarty version 3.1.33, created on 2020-02-07 12:31:35
  from '/var/www/cgframe.loc/workspace/views/main/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e3d2e77127546_52227142',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f0f281f98b85a723aa286f8901946123d0bad72' => 
    array (
      0 => '/var/www/cgframe.loc/workspace/views/main/index.tpl',
      1 => 1581067894,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e3d2e77127546_52227142 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['view']->value->setTitle('Title из index.php');?>

<?php echo $_smarty_tpl->tpl_vars['view']->value->addMeta('description','описание главной страницы');?>

<h1 class="h1"><?php echo $_smarty_tpl->tpl_vars['h1']->value;?>
</h1><?php }
}
