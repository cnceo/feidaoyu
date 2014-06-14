<?php /* Smarty version 2.6.7, created on 2012-08-07 17:45:56
         compiled from default/products.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'default/products.tpl', 12, false),array('modifier', 'strip_tags', 'default/products.tpl', 17, false),array('modifier', 'truncate', 'default/products.tpl', 17, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="container">
  <div class="wrapper mt32 mb23">
    <div class="product_banner"><img src="/images/product_banner.jpg" width="959" /></div>
    <div class="wrapper_t"></div>
    <div class="wrapper_c con">
    <div class="product_main">
    <div class="shear"> 
    <?php if (count($_from = (array)$this->_tpl_vars['logs'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
       <div class="block" >
       <div class="block_t">
               <a href="/products/<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['filename'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
-<?php echo $this->_tpl_vars['data']['id']; ?>
.html" target="_blank">
               <img class="image1" src="<?php if ($this->_tpl_vars['data']['picpath']):  echo @IMG_HOST;  echo $this->_tpl_vars['data']['picpath'];  else: ?>/images/product_chanpin.png<?php endif; ?>" width="243" height="169" />
               </a> 
           </div>
           <div class="block_b">
               <p><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data']['description'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 140, "UTF-8", "") : smarty_modifier_truncate($_tmp, 140, "UTF-8", "")); ?>
</p>
               <a href="/products/<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['filename'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
-<?php echo $this->_tpl_vars['data']['id']; ?>
.html" target="_blank"><img class="image2" src="/images/product_b.png" width="80" height="22" /></a>
          </div>     
       </div>
       <?php endforeach; endif; unset($_from); ?>
     
       <div class="clear"></div>
       </div>
    </div>
    <div class=" product_main_b">
        <img class="image3" src="/images/product_name2.png" width="97" height="15" />
        <p>我们真诚地与每位客户沟通，像对待宝石一样地对每一件作品仔细研磨推敲，以"最大化我们的原创性"为准则，使我们的每次的合作过程都是全新的，拒接抄袭与复制，我们的每件作品都会是您的产品独特而充满创意。<br /><br />我们会一直期待与您的合作。<h1 style="color:#b1221c;">业务洽谈：400-688-0921</h1></p>
    </div>
    
    </div>
    <div class="wrapper_b"></div>
  </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>