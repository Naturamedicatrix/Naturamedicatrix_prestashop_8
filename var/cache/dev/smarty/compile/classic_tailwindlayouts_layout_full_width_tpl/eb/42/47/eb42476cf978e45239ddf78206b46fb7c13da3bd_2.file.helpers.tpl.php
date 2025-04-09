<?php
/* Smarty version 4.3.4, created on 2025-04-09 16:13:10
  from 'C:\xampp\htdocs\Naturamedicatrix\themes\classic\templates\_partials\helpers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f68076456a91_69148720',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eb42476cf978e45239ddf78206b46fb7c13da3bd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Naturamedicatrix\\themes\\classic\\templates\\_partials\\helpers.tpl',
      1 => 1744034904,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f68076456a91_69148720 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'renderLogo' => 
  array (
    'compiled_filepath' => 'C:\\xampp\\htdocs\\Naturamedicatrix\\var\\cache\\dev\\smarty\\compile\\classic_tailwindlayouts_layout_full_width_tpl\\eb\\42\\47\\eb42476cf978e45239ddf78206b46fb7c13da3bd_2.file.helpers.tpl.php',
    'uid' => 'eb42476cf978e45239ddf78206b46fb7c13da3bd',
    'call_name' => 'smarty_template_function_renderLogo_81118434467f68076446007_67404814',
  ),
));
?> 

<?php }
/* smarty_template_function_renderLogo_81118434467f68076446007_67404814 */
if (!function_exists('smarty_template_function_renderLogo_81118434467f68076446007_67404814')) {
function smarty_template_function_renderLogo_81118434467f68076446007_67404814(Smarty_Internal_Template $_smarty_tpl,$params) {
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

  <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['index'], ENT_QUOTES, 'UTF-8');?>
">
    <img
      class="logo img-fluid"
      src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['logo_details']['src'], ENT_QUOTES, 'UTF-8');?>
"
      alt="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
"
      width="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['logo_details']['width'], ENT_QUOTES, 'UTF-8');?>
"
      height="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['logo_details']['height'], ENT_QUOTES, 'UTF-8');?>
">
  </a>
<?php
}}
/*/ smarty_template_function_renderLogo_81118434467f68076446007_67404814 */
}
