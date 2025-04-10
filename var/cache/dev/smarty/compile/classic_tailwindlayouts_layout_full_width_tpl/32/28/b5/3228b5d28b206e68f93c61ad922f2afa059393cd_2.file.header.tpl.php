<?php
/* Smarty version 4.3.4, created on 2025-04-10 10:10:21
  from 'C:\xampp\htdocs\Naturamedicatrix\themes\classic_tailwind\templates\_partials\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f77cedacef01_04975495',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3228b5d28b206e68f93c61ad922f2afa059393cd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Naturamedicatrix\\themes\\classic_tailwind\\templates\\_partials\\header.tpl',
      1 => 1744272613,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f77cedacef01_04975495 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_203940414967f77cedac7fc3_11710155', 'header_banner');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_32706487867f77cedaca8e6_82842904', 'header_nav');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_186148755567f77cedacb117_76247329', 'header_top');
}
/* {block 'header_banner'} */
class Block_203940414967f77cedac7fc3_11710155 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_banner' => 
  array (
    0 => 'Block_203940414967f77cedac7fc3_11710155',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div class="header-banner text-carousel-banner">
    <div class="container tw-mt-4">
      <div class="banner-wrapper">
        <!-- CAROUSEL TEXT avec sélecteur de langue à l'intérieur -->
        <div class="text-carousel-container">
          <!-- Flèche gauche -->
          <button id="carousel-prev" class="carousel-nav-button">
            &lt;
          </button>
          
          <!-- CONTENU DU TEXT CAROUSEL -->
          <div id="text-carousel">
            <div class="carousel-item active"><span class="highlight-text">Livraison offerte</span> apd 35€ en Point Relais & 50€ à domicile</div>
            <div class="carousel-item inactive">Paiement 100% sécurisé</div>
            <div class="carousel-item inactive">Service client disponible du lundi au vendredi</div>
          </div>
          
          <!-- Flèche droite -->
          <button id="carousel-next" class="carousel-nav-button">
            &gt;
          </button>
        </div>
        
        <!-- Language selector directement dans la bannière -->
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayLanguageSelector'),$_smarty_tpl ) );?>

      </div>
      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBanner'),$_smarty_tpl ) );?>

    </div>
  </div>
<?php
}
}
/* {/block 'header_banner'} */
/* {block 'header_nav'} */
class Block_32706487867f77cedaca8e6_82842904 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_nav' => 
  array (
    0 => 'Block_32706487867f77cedaca8e6_82842904',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <nav class="header-nav">
    <div class="container">
      <div class="row">
        <div class="hidden-sm-down">
          <div class="col-md-5 col-xs-12">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav1'),$_smarty_tpl ) );?>

          </div>
          <div class="col-md-7 right-nav">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav2'),$_smarty_tpl ) );?>

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
class Block_186148755567f77cedacb117_76247329 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_top' => 
  array (
    0 => 'Block_186148755567f77cedacb117_76247329',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div class="header-top">
    <div class="container">
      <div class="row">
        <div class="col-md-2 hidden-sm-down" id="_desktop_logo">
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
        <div class="header-top-right col-md-10 col-sm-12 position-static">
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
