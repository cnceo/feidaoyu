<?php /* Smarty version 2.6.7, created on 2012-09-04 20:28:45
         compiled from article/left.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strtolower', 'article/left.tpl', 16, false),array('modifier', 'replace', 'article/left.tpl', 16, false),array('modifier', 'truncate', 'article/left.tpl', 16, false),)), $this); ?>
   <div class="sidebar">
   <div class="sidebar-block">
     <h3><a href="" class="topic_hd">海大培训</a></h3>
     <ul>
         <li><a href="">php培训</a></li>
         <li><a href="">wed前端培训</a></li>
         <li><a href="">3G移动开发培训</a></li>
     </ul>
     </div>
     <div class="title_Mod">
          <h2><a href="" class="technology-dynamics">php技术动态</a> </h2>
          <div class="hda_more"><a href=""></a></div>
        </div>
      <ul>
      <?php if (count($_from = (array)$this->_tpl_vars['news'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
         <li><a href="/<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data']['classname'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
/<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data']['filename'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
-<?php echo $this->_tpl_vars['data']['id']; ?>
.html" target="_blank"  title="<?php echo $this->_tpl_vars['data']['title']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "UTF-8") : smarty_modifier_truncate($_tmp, 30, "UTF-8")); ?>
</a></li>
         
        <!-- <li><a href="">数组遍历性能的比较</a></li>
         <li><a href="">如何提高PHP性能</a></li>
         <li><a href="">五个快速提升MySQL可扩展性的</a></li>
         <li><a href="">数组遍历性能的比较</a></li>
         <li><a href="">如何提高PHP性能</a></li>-->
        
        <?php endforeach; endif; unset($_from); ?>
     </ul>
      <div class="image3"><a href="<?php echo $this->_tpl_vars['teacher']['link']; ?>
"><img src="<?php echo @IMG_HOST;  echo $this->_tpl_vars['teacher']['picpath']; ?>
" width="220" height="229" /></a></div>
   </div>