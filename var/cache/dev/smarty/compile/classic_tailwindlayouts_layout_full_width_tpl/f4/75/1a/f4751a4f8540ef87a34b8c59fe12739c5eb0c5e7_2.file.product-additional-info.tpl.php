<?php
/* Smarty version 4.3.4, created on 2025-04-08 14:31:34
  from 'C:\xampp\htdocs\Naturamedicatrix\themes\classic\templates\catalog\_partials\product-additional-info.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f51726722be6_27185909',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f4751a4f8540ef87a34b8c59fe12739c5eb0c5e7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Naturamedicatrix\\themes\\classic\\templates\\catalog\\_partials\\product-additional-info.tpl',
      1 => 1744034906,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f51726722be6_27185909 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="product-additional-info js-product-additional-info">
  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductAdditionalInfo','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

</div>
<?php }
}
