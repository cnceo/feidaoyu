<?php /* Smarty version 2.6.7, created on 2012-07-27 17:00:46
         compiled from default/news.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'default/news.tpl', 14, false),array('modifier', 'strip_tags', 'default/news.tpl', 15, false),array('modifier', 'truncate', 'default/news.tpl', 15, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="container">
  <div class="wrapper mt32 mb23">
    <div class="wrapper_t"></div>
    <div class="wrapper_c">
            <div class="news_main">
            
            <?php if (count($_from = (array)$this->_tpl_vars['logs'])):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['data']):
?>
            
              <div class="news_main_l">
                  <div class="news_block"><a href=""><img src="/images/news_03.png" width="130" height="90" /></a></div>
                  <div class="news_block_r">
                      <h3><a href="/<?php echo $this->_tpl_vars['data']['ename']; ?>
/<?php echo $this->_tpl_vars['data']['id']; ?>
.html"><?php echo $this->_tpl_vars['data']['title']; ?>
</a></h3>
                      <span><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['addtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m.%d.%Y") : smarty_modifier_date_format($_tmp, "%m.%d.%Y")); ?>
</span>
                      <p><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data']['content'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 140, "UTF-8", "") : smarty_modifier_truncate($_tmp, 140, "UTF-8", "")); ?>
</p>
                      <a href="/<?php echo $this->_tpl_vars['data']['ename']; ?>
/<?php echo $this->_tpl_vars['data']['id']; ?>
.html">查看</a>
                  </div>
              </div>
              <?php if ($this->_tpl_vars['k'] == 0): ?>
              <div class="news_main_r"><a href=""><span>2012</span></a><a href=""><em>2011</em></a><a href=""><em>2010</em></a></div>
              <div class="clear"></div>
              <?php endif; ?>
              <?php endforeach; endif; unset($_from); ?>
              <!-- 
              <div class="news_main_l">
                  <div class="news_block"><a href=""><img src="/images/news_03.png" width="130" height="90" /></a></div>
                  <div class="news_block_r">
                      <h3>Weico WP版本亮相GSMA 2012</h3>
                      <span>07.02.2012</span>
                      <p>《商业价值》杂志最近撰文《右脑互联网》，其中对eico design 进行深入访谈。创始人张伟谈到了关于如何用感性思维影响产品开发，并用最新的Weico运营以及蘑菇街iPad版本设计案例，传达了设计思想如何影响产品商业价值和引导用户行为。</p>
                      <a href="">查看</a>
                  </div>
              </div>
              
              <div class="news_main_l">
                  <div class="news_block"><a href=""><img src="/images/news_03.png" width="130" height="90" /></a></div>
                  <div class="news_block_r">
                      <h3>Weico WP版本亮相GSMA 2012</h3>
                      <span>07.02.2012</span>
                      <p>《商业价值》杂志最近撰文《右脑互联网》，其中对eico design 进行深入访谈。创始人张伟谈到了关于如何用感性思维影响产品开发，并用最新的Weico运营以及蘑菇街iPad版本设计案例，传达了设计思想如何影响产品商业价值和引导用户行为。</p>
                      <a href="">查看</a>
                  </div>
              </div>
              
              
              <div class="news_main_l">
                  <div class="news_block"><a href=""><img src="/images/news_03.png" width="130" height="90" /></a></div>
                  <div class="news_block_r">
                      <h3>Weico WP版本亮相GSMA 2012</h3>
                      <span>07.02.2012</span>
                      <p>《商业价值》杂志最近撰文《右脑互联网》，其中对eico design 进行深入访谈。创始人张伟谈到了关于如何用感性思维影响产品开发，并用最新的Weico运营以及蘑菇街iPad版本设计案例，传达了设计思想如何影响产品商业价值和引导用户行为。</p>
                      <a href="">查看</a>
                  </div>
              </div>
              
              <div class="news_main_l">
                  <div class="news_block"><a href=""><img src="/images/news_03.png" width="130" height="90" /></a></div>
                  <div class="news_block_r">
                      <h3>Weico WP版本亮相GSMA 2012</h3>
                      <span>07.02.2012</span>
                      <p>《商业价值》杂志最近撰文《右脑互联网》，其中对eico design 进行深入访谈。创始人张伟谈到了关于如何用感性思维影响产品开发，并用最新的Weico运营以及蘑菇街iPad版本设计案例，传达了设计思想如何影响产品商业价值和引导用户行为。</p>
                      <a href="">查看</a>
                  </div>
              </div>
              
              <div class="news_main_l">
                  <div class="news_block"><a href=""><img src="/images/news_03.png" width="130" height="90" /></a></div>
                  <div class="news_block_r">
                      <h3>Weico WP版本亮相GSMA 2012</h3>
                      <span>07.02.2012</span>
                      <p>《商业价值》杂志最近撰文《右脑互联网》，其中对eico design 进行深入访谈。创始人张伟谈到了关于如何用感性思维影响产品开发，并用最新的Weico运营以及蘑菇街iPad版本设计案例，传达了设计思想如何影响产品商业价值和引导用户行为。</p>
                      <a href="">查看</a>
                  </div>
              </div>
               -->
              <div class="clear"></div>
              <div class=" number"><a href="">1</a><a href="">2</a><a href=""><img src="/images/next_ico.gif" width="42" height="25" /></a></div>
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