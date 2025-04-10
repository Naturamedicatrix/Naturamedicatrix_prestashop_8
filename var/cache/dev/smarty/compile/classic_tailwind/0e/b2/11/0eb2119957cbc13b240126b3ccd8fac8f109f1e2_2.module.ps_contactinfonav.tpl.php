<?php
/* Smarty version 4.3.4, created on 2025-04-10 09:51:02
  from 'module:ps_contactinfonav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f77866869ee4_66964479',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0eb2119957cbc13b240126b3ccd8fac8f109f1e2' => 
    array (
      0 => 'module:ps_contactinfonav.tpl',
      1 => 1744271453,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f77866869ee4_66964479 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin C:\xampp\htdocs\Naturamedicatrix/themes/classic_tailwind/modules/ps_contactinfo/nav.tpl --><div id="_desktop_contact_link">
  <div id="contact-link">
    <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['contact'], ENT_QUOTES, 'UTF-8');?>
" class="contact-button">
      <div class="contact-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
        </svg>
      </div>
      <div class="contact-text">
        <span class="contact-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Contact us','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</span>
        <span class="contact-phone">+33 (0)9 77 42 37 04</span>
      </div>
    </a>
  </div>
</div>
<!-- end C:\xampp\htdocs\Naturamedicatrix/themes/classic_tailwind/modules/ps_contactinfo/nav.tpl --><?php }
}
