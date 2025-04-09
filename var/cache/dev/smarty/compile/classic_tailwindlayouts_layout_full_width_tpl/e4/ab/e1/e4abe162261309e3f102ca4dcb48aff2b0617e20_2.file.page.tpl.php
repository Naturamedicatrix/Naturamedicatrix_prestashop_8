<?php
/* Smarty version 4.3.4, created on 2025-04-09 16:13:08
  from 'C:\xampp\htdocs\Naturamedicatrix\themes\classic\templates\page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f68074ab6090_72373534',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e4abe162261309e3f102ca4dcb48aff2b0617e20' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Naturamedicatrix\\themes\\classic\\templates\\page.tpl',
      1 => 1744034903,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f68074ab6090_72373534 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_47231290967f68074ab25d6_31096660', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_108158888467f68074ab2d51_73000076 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h1><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h1>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_66146803067f68074ab2a34_41311738 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_108158888467f68074ab2d51_73000076', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_2894336967f68074ab5029_64188386 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_41414949767f68074ab5354_10086799 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_94104648967f68074ab4de5_53991349 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2894336967f68074ab5029_64188386', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_41414949767f68074ab5354_10086799', 'page_content', $this->tplIndex);
?>

      </div>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_44813736867f68074ab5a14_33206580 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_106486878567f68074ab5838_07365309 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44813736867f68074ab5a14_33206580', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_47231290967f68074ab25d6_31096660 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_47231290967f68074ab25d6_31096660',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_66146803067f68074ab2a34_41311738',
  ),
  'page_title' => 
  array (
    0 => 'Block_108158888467f68074ab2d51_73000076',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_94104648967f68074ab4de5_53991349',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_2894336967f68074ab5029_64188386',
  ),
  'page_content' => 
  array (
    0 => 'Block_41414949767f68074ab5354_10086799',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_106486878567f68074ab5838_07365309',
  ),
  'page_footer' => 
  array (
    0 => 'Block_44813736867f68074ab5a14_33206580',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_66146803067f68074ab2a34_41311738', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_94104648967f68074ab4de5_53991349', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_106486878567f68074ab5838_07365309', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
