<?php /* Smarty version 2.6.7, created on 2012-08-16 10:02:45
         compiled from article/artile_detail.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "article/left.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   <div class="php-main">
       <div class="article_title"><h3><?php echo $this->_tpl_vars['log']['title']; ?>
</h3>
       <div class="hda_author">2012-2-16 10:57<span class="pipe">|</span>发布者: sun<span class="pipe">|</span>查看数: 3635<span class="pipe">|</span>评论数: 1</div>
       </div>
       <div class="block1">
           <?php echo $this->_tpl_vars['log']['content']; ?>

       </div>
   </div>
    <div class="clear"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>