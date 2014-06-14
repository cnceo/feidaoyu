<?php /* Smarty version 2.6.7, created on 2012-07-23 12:48:36
         compiled from admin/navigation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/navigation.tpl', 6, false),)), $this); ?>
<div class="breadcrumb">
    <a href="./">首页</a>

     :: <a href="?m=<?php echo $this->_tpl_vars['sites']['url']; ?>
"><?php echo $this->_tpl_vars['sites']['title']; ?>
</a>
     <?php if (count($_from = (array)$this->_tpl_vars['sites']['navigation'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
     :: <a href="?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&cateid=<?php echo $this->_tpl_vars['data']['id']; ?>
"><?php echo $this->_tpl_vars['data']['cname']; ?>
</a>
     <?php endforeach; endif; unset($_from); ?>
   <div class="warning" style="display:none;">带*为必填项，不能为空请检查！</div>  
  </div>