<?php /* Smarty version 2.6.7, created on 2012-07-23 12:48:21
         compiled from user/right.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'user/right.tpl', 6, false),array('modifier', 'default', 'user/right.tpl', 16, false),)), $this); ?>

    <div class="user-right">
         <dl class="post">
            <dt>网站公告</dt>
            <?php if (count($_from = (array)$this->_tpl_vars['anlogs'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
            <dd><a href="/<?php echo $this->_tpl_vars['data']['classname']; ?>
/<?php echo $this->_tpl_vars['data']['id']; ?>
.html" target="_blank" title="<?php echo $this->_tpl_vars['data']['title']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "UTF-8", "...") : smarty_modifier_truncate($_tmp, 30, "UTF-8", "...")); ?>
</a></dd>
            <?php endforeach; endif; unset($_from); ?>
         </dl>
    
    
    
         <dl class="post-img">
            <dt>最新会员</dt>
            <?php if (count($_from = (array)$this->_tpl_vars['newusers'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
            <dd>
                   <a href="" class="img"><img src="<?php echo ((is_array($_tmp=@$this->_tpl_vars['data']['picpath'])) ? $this->_run_mod_handler('default', true, $_tmp, '/images/sns12-0.gif') : smarty_modifier_default($_tmp, '/images/sns12-0.gif')); ?>
" /></a>

                   <a href=""><i></i><?php echo $this->_tpl_vars['data']['username']; ?>
</a>
                   <span><?php echo $this->_tpl_vars['data']['expiration']; ?>
前</span>
             </dd>
             <?php endforeach; endif; unset($_from); ?>
            <div style="clear:both"></div>
         </dl>

    
    
         <dl class="user-search">
            <dt>搜索用户</dt>
            <dd>
<form id="form1" name="form1" method="post" action="">
  <input style="height:20px" type="text" name="textfield" id="textfield" /><input style="height:23px" class="btn" name="" type="button" value="搜索" />
</form> 
            <a href="">邀请好友</a>
            </dd>
         </dl>

    
          <h3 class="title3 title3-mc"><a>帮助中心</a></h3>
          <dl style="padding-top:8px" class="list-7">
                    <dd><a href="">岛津精彩亮岛津2011（一）</a></dd>
                    <dd><a href="">北京BCEIA展会展台受青睐</a></dd>
                    <dd><a href="">默克密台受解谱展决方案</a></dd>
                    <dd><a href="">博纳艾杰尔样品前处理技家研</a></dd>

         </dl>
    
    </div>
    
      
   <div style="clear:both"></div>
   
</div>  