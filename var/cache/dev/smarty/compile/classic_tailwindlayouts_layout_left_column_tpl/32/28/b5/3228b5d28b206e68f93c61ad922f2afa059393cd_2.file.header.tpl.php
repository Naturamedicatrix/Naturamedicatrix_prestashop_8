<?php
/* Smarty version 4.3.4, created on 2025-04-08 15:35:40
  from 'C:\xampp\htdocs\Naturamedicatrix\themes\classic_tailwind\templates\_partials\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f5262cab2132_44165414',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3228b5d28b206e68f93c61ad922f2afa059393cd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Naturamedicatrix\\themes\\classic_tailwind\\templates\\_partials\\header.tpl',
      1 => 1744119337,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f5262cab2132_44165414 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_203583235467f5262caaba78_84834887', 'header_banner');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_74221044867f5262caadc03_77425596', 'header_nav');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_22390004867f5262cab1940_50366521', 'header_top');
?>

<?php }
/* {block 'header_banner'} */
class Block_203583235467f5262caaba78_84834887 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_banner' => 
  array (
    0 => 'Block_203583235467f5262caaba78_84834887',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div class="header-banner tw-bg-color-custom-red tw-py-1">
    <div class="container tw-flex tw-justify-center tw-items-center">
      <span class="tw-text-white tw-text-sm">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBanner'),$_smarty_tpl ) );?>

      </span>
    </div>
  </div>
<?php
}
}
/* {/block 'header_banner'} */
/* {block 'header_nav'} */
class Block_74221044867f5262caadc03_77425596 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_nav' => 
  array (
    0 => 'Block_74221044867f5262caadc03_77425596',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <nav class="header-nav tw-bg-color-custom-green tw-py-4">
    <div class="container">
      <div class="tw-flex tw-justify-between tw-items-center tw-text-white">
                <div class="tw-flex tw-items-center tw-gap-2">
          <i class="material-icons tw-text-white">phone</i>
          <div class="tw-text-sm">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav1'),$_smarty_tpl ) );?>

          </div>
        </div>

                <div id="_desktop_logo" class="tw-flex tw-justify-center">
          <?php if ($_smarty_tpl->tpl_vars['shop']->value['logo_details']) {?>
            <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'index') {?>
              <h1>
                <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'renderLogo', array(), true);?>

              </h1>
            <?php } else { ?>
              <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'renderLogo', array(), true);?>

            <?php }?>
          <?php }?>
        </div>

                <div class="tw-flex tw-items-center tw-gap-6">
          <div id="_desktop_user_info" class="tw-flex tw-items-center tw-gap-2">
            <i class="material-icons tw-text-white">person_outline</i>
            <div class="tw-text-sm">
              <span>Mon compte</span>
              <br>
              <span class="tw-text-xs">Se connecter</span>
            </div>
          </div>
          <div id="_desktop_cart" class="tw-flex tw-items-center tw-gap-2">
            <i class="material-icons tw-text-white">shopping_cart</i>
            <div class="tw-text-sm">
              <span class="tw-text-xs">(0)</span>
            </div>
          </div>
        </div>

                <div class="hidden-md-up text-sm-center mobile">
          <div class="float-xs-left" id="menu-icon">
            <i class="material-icons d-inline">&#xE5D2;</i>
          </div>
          <div class="float-xs-right" id="_mobile_cart"></div>
          <div class="float-xs-right" id="_mobile_user_info"></div>
          <div class="top-logo" id="_mobile_logo"></div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </nav>
<?php
}
}
/* {/block 'header_nav'} */
/* {block 'header_top'} */
class Block_22390004867f5262cab1940_50366521 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_top' => 
  array (
    0 => 'Block_22390004867f5262cab1940_50366521',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div class="header-top tw-bg-white tw-border-b tw-border-gray-200">
    <div class="container">
      <div class="tw-flex tw-justify-center">
        <div class="tw-py-2">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayTop'),$_smarty_tpl ) );?>

        </div>
      </div>
      <div id="mobile_top_menu_wrapper" class="row hidden-md-up" style="display:none;">
        <div class="js-top-menu mobile" id="_mobile_top_menu"></div>
        <div class="js-top-menu-bottom">
          <div id="_mobile_currency_selector"></div>
          <div id="_mobile_language_selector"></div>
          <div id="_mobile_contact_link"></div>
        </div>
      </div>
    </div>
  </div>
  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNavFullWidth'),$_smarty_tpl ) );?>

<?php
}
}
/* {/block 'header_top'} */
}
