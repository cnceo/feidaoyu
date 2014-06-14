<?php /* Smarty version 2.6.7, created on 2012-08-06 18:49:32
         compiled from article/cases.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'article/cases.tpl', 8, false),array('modifier', 'truncate', 'article/cases.tpl', 21, false),array('modifier', 'date_format', 'article/cases.tpl', 22, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="container">
  <div class="wrapper mt32 mb23">
    <div class="wrapper_t"></div>
    <div class="wrapper_c">
    <div class="nr-button">
      <div class="nr-button-l">
        <a href="/cases/<?php echo ((is_array($_tmp=$this->_tpl_vars['prev']['filename'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
-<?php echo $this->_tpl_vars['prev']['id']; ?>
.html"><?php echo $this->_tpl_vars['prev']['title']; ?>
</a>
      </div>
      <div class="nr-button-r">
        <a href="/cases/<?php echo ((is_array($_tmp=$this->_tpl_vars['next']['filename'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
-<?php echo $this->_tpl_vars['next']['id']; ?>
.html"><?php echo $this->_tpl_vars['next']['title']; ?>
</a>
      </div>
      <div class="clear"></div>
    </div>
      <div class="hd_article_page">
       
        <div class="hd_article_info">
          <div class="article_info_pic"><img alt="<?php echo $this->_tpl_vars['log']['title']; ?>
" src="<?php if ($this->_tpl_vars['log']['picpath']):  echo @IMG_HOST;  echo $this->_tpl_vars['log']['picpath'];  else: ?>/images/no_image-100x100.jpg<?php endif; ?>" width="258" height="130">
</div>
          <div class="article_info_p">
            <h2><?php echo ((is_array($_tmp=$this->_tpl_vars['log']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "UTF-8") : smarty_modifier_truncate($_tmp, 20, "UTF-8")); ?>
</h2>
            <P class="hd_time"><?php echo ((is_array($_tmp=$this->_tpl_vars['log']['addtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y年%m月%d日 %H:%M') : smarty_modifier_date_format($_tmp, '%Y年%m月%d日 %H:%M')); ?>
 <span>分享到:<a href=""><img src="/images/weibo_ico.gif" /></a><a href=""><img src="/images/tw_ico.gif" /></a><a href=""><img src="/images/facebook_ico.gif" /></a></span></P>
            <p><?php echo $this->_tpl_vars['log']['description']; ?>
</p>
          </div>
        </div>
        <div><?php echo $this->_tpl_vars['log']['content']; ?>
<!-- <img src="/images/pic1.jpg" width="865" height="874" /> --></div>
        <div class="hd_related_works">
          <h3>相关作品</h3>
          <ul>
          <?php if (count($_from = (array)$this->_tpl_vars['logs'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
            <li class="article_info_pic"><a href="/cases/<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['filename'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
-<?php echo $this->_tpl_vars['data']['id']; ?>
.html" target="_blank"><img src="<?php if ($this->_tpl_vars['data']['picpath']):  echo @IMG_HOST;  echo $this->_tpl_vars['data']['picpath'];  else: ?>/images/no_image-100x100.jpg<?php endif; ?>" /></a></li>
            <?php endforeach; else: ?>
            暂无相关作品
           <?php endif; unset($_from); ?>
          </ul>
        </div>
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