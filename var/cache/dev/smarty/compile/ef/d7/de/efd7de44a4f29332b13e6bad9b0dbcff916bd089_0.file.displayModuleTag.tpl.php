<?php
/* Smarty version 4.3.4, created on 2025-04-08 14:45:12
  from 'C:\xampp\htdocs\Naturamedicatrix\modules\psxdesign\views\templates\hook\displayModuleTag.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f51a587c6377_18409017',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'efd7de44a4f29332b13e6bad9b0dbcff916bd089' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\hook\\displayModuleTag.tpl',
      1 => 1711028754,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f51a587c6377_18409017 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="module" src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['src']->value,'htmlall','UTF-8' ));?>
"><?php echo '</script'; ?>
>
<?php }
}
