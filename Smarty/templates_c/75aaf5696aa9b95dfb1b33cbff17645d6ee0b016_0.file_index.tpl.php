<?php
/* Smarty version 5.8.2, created on 2026-06-24 11:30:07
  from 'file:index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.2',
  'unifunc' => 'content_6a3be9efd07af6_53511218',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '75aaf5696aa9b95dfb1b33cbff17645d6ee0b016' => 
    array (
      0 => 'index.tpl',
      1 => 1782311400,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a3be9efd07af6_53511218 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/home/joao.goncalves/Área de trabalho/estudos/revisao-php7-4/smarty/templates';
?><!DOCTYPE html>
<html>

<head>
    <title>Smarty Teste</title>
</head>

<body>

<h1>Olá <?php echo $_smarty_tpl->getValue('nome');?>
</h1>
    {
        for($teste = 0;$teste < 5;$teste++){
            <p>teste</p>
        }
    }

</body>

</html><?php }
}
