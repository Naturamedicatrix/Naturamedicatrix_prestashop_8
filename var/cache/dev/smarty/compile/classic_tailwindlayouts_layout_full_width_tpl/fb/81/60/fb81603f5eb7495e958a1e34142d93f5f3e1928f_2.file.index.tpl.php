<?php
/* Smarty version 4.3.4, created on 2025-04-09 16:13:08
  from 'C:\xampp\htdocs\Naturamedicatrix\themes\classic\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f680747bc162_19425550',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fb81603f5eb7495e958a1e34142d93f5f3e1928f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Naturamedicatrix\\themes\\classic\\templates\\index.tpl',
      1 => 1744034903,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f680747bc162_19425550 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_136084133167f680747bad53_73013014', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_170967044467f680747bb022_84034519 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_53031543267f680747bb727_68640058 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_93523760767f680747bb510_74481864 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_53031543267f680747bb727_68640058', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_136084133167f680747bad53_73013014 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_136084133167f680747bad53_73013014',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_170967044467f680747bb022_84034519',
  ),
  'page_content' => 
  array (
    0 => 'Block_93523760767f680747bb510_74481864',
  ),
  'hook_home' => 
  array (
    0 => 'Block_53031543267f680747bb727_68640058',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_170967044467f680747bb022_84034519', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_93523760767f680747bb510_74481864', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
