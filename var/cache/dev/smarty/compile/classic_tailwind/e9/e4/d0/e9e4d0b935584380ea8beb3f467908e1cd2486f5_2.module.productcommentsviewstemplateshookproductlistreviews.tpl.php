<?php
/* Smarty version 4.3.4, created on 2025-04-09 16:13:07
  from 'module:productcommentsviewstemplateshookproductlistreviews.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f680738a54a6_18392881',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9e4d0b935584380ea8beb3f467908e1cd2486f5' => 
    array (
      0 => 'module:productcommentsviewstemplateshookproductlistreviews.tpl',
      1 => 1744032472,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f680738a54a6_18392881 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin C:\xampp\htdocs\Naturamedicatrix/modules/productcomments/views/templates/hook/product-list-reviews.tpl -->

<div class="product-list-reviews" data-id="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id'], ENT_QUOTES, 'UTF-8');?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['product_comment_grade_url']->value;?>
">
  <div class="grade-stars small-stars"></div>
  <div class="comments-nb"></div>
</div>
<!-- end C:\xampp\htdocs\Naturamedicatrix/modules/productcomments/views/templates/hook/product-list-reviews.tpl --><?php }
}
