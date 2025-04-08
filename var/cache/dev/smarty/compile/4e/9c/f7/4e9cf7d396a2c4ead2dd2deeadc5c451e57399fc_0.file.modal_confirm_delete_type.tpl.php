<?php
/* Smarty version 4.3.4, created on 2025-04-08 14:45:18
  from 'C:\xampp\htdocs\Naturamedicatrix\admin123\themes\default\template\controllers\images\modal_confirm_delete_type.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f51a5eea9df8_47166119',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e9cf7d396a2c4ead2dd2deeadc5c451e57399fc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Naturamedicatrix\\admin123\\themes\\default\\template\\controllers\\images\\modal_confirm_delete_type.tpl',
      1 => 1744032049,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f51a5eea9df8_47166119 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-body">
  <div class="form-group">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"If you delete this image format, the theme won't be able to use it anymore. This will result in a degraded experience on your front office.",'d'=>"Admin.Design.Notification"),$_smarty_tpl ) );?>

  </div>

  <div class="modal-checkbox">
    <input type="checkbox" id="delete_linked_images" name="delete">
    <label for="delete_linked_images"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Delete the images linked to this image setting",'d'=>"Admin.Design.Notification"),$_smarty_tpl ) );?>
</label>
  </div>
</div>
<?php }
}
