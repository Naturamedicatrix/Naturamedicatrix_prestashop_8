<?php
/* Smarty version 4.3.4, created on 2025-04-08 14:37:04
  from 'C:\xampp\htdocs\Naturamedicatrix\admin123\themes\new-theme\template\content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f5187097c738_50255108',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fb8bc413105a38c06818c4b8876dceab7ed20b75' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Naturamedicatrix\\admin123\\themes\\new-theme\\template\\content.tpl',
      1 => 1744032074,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f5187097c738_50255108 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="ajax_confirmation" class="alert alert-success" style="display: none;"></div>
<div id="content-message-box"></div>


<?php if ((isset($_smarty_tpl->tpl_vars['content']->value))) {?>
  <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }
}
}
