<?php
/* Smarty version 4.3.4, created on 2025-04-10 10:39:45
  from 'C:\xampp\htdocs\Naturamedicatrix\themes\classic\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_67f783d1cfde32_41326799',
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
function content_67f783d1cfde32_41326799 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_90562876967f783d1cfc9f5_32030814', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_4832687267f783d1cfccd2_16835962 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_87440048767f783d1cfd3e0_39755963 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_167903837067f783d1cfd154_40022210 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_87440048767f783d1cfd3e0_39755963', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_90562876967f783d1cfc9f5_32030814 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_90562876967f783d1cfc9f5_32030814',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_4832687267f783d1cfccd2_16835962',
  ),
  'page_content' => 
  array (
    0 => 'Block_167903837067f783d1cfd154_40022210',
  ),
  'hook_home' => 
  array (
    0 => 'Block_87440048767f783d1cfd3e0_39755963',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4832687267f783d1cfccd2_16835962', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_167903837067f783d1cfd154_40022210', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
