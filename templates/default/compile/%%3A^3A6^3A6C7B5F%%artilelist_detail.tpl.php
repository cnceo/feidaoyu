<?php /* Smarty version 2.6.7, created on 2012-07-27 10:12:39
         compiled from article/artilelist_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'article/artilelist_detail.tpl', 10, false),array('modifier', 'truncate', 'article/artilelist_detail.tpl', 79, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--主体开始-->
<div id="main">
     <div class="left-index">
          <p class="pp1"><a href="/">首页</a>&nbsp;>&nbsp;<a href="/news.html">新闻资讯</a>&nbsp;>&nbsp;<a href="/news.html">列表</a></p>
           <div class="new-wen">

               <div class="header">
                    <h3 style="font-weight:bold; font-size:20px;"><?php echo $this->_tpl_vars['log']['title']; ?>
</h3>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['log']['addtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
&nbsp;&nbsp;易择网&nbsp;&nbsp;吴淑敏报道
               </div>
               <?php echo $this->_tpl_vars['log']['content']; ?>

               <div class="weibo">
                    <ul>
                <!-- JiaThis Button BEGIN -->
                <div id="ckepop">
                    <span class="jiathis_txt">分享到：</span>
                    <a class="jiathis_button_icons_1"></a>
                    <a class="jiathis_button_icons_2"></a>
                    <a class="jiathis_button_icons_3"></a>
                    <a class="jiathis_button_icons_4"></a>
                    <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
                    <a class="jiathis_counter_style"></a>
                </div>
                <script type="text/javascript" src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>
                <!-- JiaThis Button END -->
                    </ul>
               </div>
               <div class="more001">
                    <span class="pword">相关阅读</span>

                    <ul>
                        <?php if (count($_from = (array)$this->_tpl_vars['logs1'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
                        <li>&bull; <a href="/<?php echo $this->_tpl_vars['data']['classname']; ?>
/<?php echo $this->_tpl_vars['data']['id']; ?>
.html"><?php echo $this->_tpl_vars['data']['title']; ?>
</a>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['addtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</li>
		                 <?php endforeach; endif; unset($_from); ?>
                    </ul>
               </div>
          </div>
          <div class="liuyan">

               <ul class="ly001">
                   <li class="lynb1">网友评论:</li>
                   <li class="lynb2"><a href="#">已有<font color="#df0100">188</font>条评论，共<font color="#df0100">3909</font>人参与，点击查看</a></li>
               </ul>
               <div class="teaxt1">
                    <textarea class="teaxt" name="Name">文明上网，理性发言</textarea>

               </div>
               <ul class="ly001">
                   <li class="lynb1">登录<span>（请登录发言，并遵守<a href="#">相关规定</a>）</span></li>
                   <li class="lynb2"><input type="button" value="" class="input-button" /></li>
               </ul>
          </div>  
     </div>

     
     <div class="right-index">
          <div class="search001">
               <div class="select001"><select class="select" name="select"><option>产品</option></select></div>
               <input type="text" value="请输入搜索的关键词" class="aa001" name="">
               <input type="image" src="/images/21/172.png"name="" style="float:left;">
          </div>
        <div class="index-right">
             <h3 class="title1" style="margin-top:0"><span class="More"><a href="/promotion.html">更多</a></span>促销产品</h3>

             <ul class="list-1">
                <?php if (count($_from = (array)$this->_tpl_vars['promotes'])):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['data']):
?>
                <li><em class="c<?php echo $this->_tpl_vars['k']; ?>
"></em><a href="/promotion/<?php echo $this->_tpl_vars['data']['id']; ?>
.html"><?php echo $this->_tpl_vars['data']['title']; ?>
</a></li>
               <?php endforeach; endif; unset($_from); ?>
                <div style="clear:both"></div>

             </ul>
             <div class="index-a3-news"><img src="/images/1/107.png" /></div>
        </div>
        <div class="index-right">
              <ul class="title2"> <li class="hover"><a href="#">供货信息</a></li> <li><a href="#">求购信息</a></li></ul>
              <ul class="list-5">
                 <?php if (count($_from = (array)$this->_tpl_vars['gy'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>             
                  <li><a href="/demand/<?php echo $this->_tpl_vars['data']['id']; ?>
.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 28, "UTF-8", "...") : smarty_modifier_truncate($_tmp, 28, "UTF-8", "...")); ?>
</a></li>
                 <?php endforeach; endif; unset($_from); ?> 
             </ul>
             <img src="/images/1/0120.png" class="banner-db5 top" />
        </div>

        <div class="index-right">   
            <ul class="title2"> <li class="hover"><a href="#">最新团购</a></li> <li><a href="#">拍 卖</a></li><li><a href="#">求购信息</a></li></ul>
            <dl class="list-6-a" style="width: 274px;">

                <dt>
                   <h3>金牌秒杀<span>（剩余<b class="orange"1>小时53分10秒</b>）</span></h3>
                   <a class="a1" href=""><img src="/images/1/7_90-94.png" /></a>
                   <p><img src="/images/7_90-104.png" />克密理博"谱展台受谱展台受解谱决方展决方案<span class="Red">谱展台受解谱展决方案</span></p>
                   <div style="clear:both"></div>
                </dt>

                <?php if (count($_from = (array)$this->_tpl_vars['group'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
                <dd><a href="/tuan/<?php echo $this->_tpl_vars['data']['id']; ?>
.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "UTF-8", "...") : smarty_modifier_truncate($_tmp, 16, "UTF-8", "...")); ?>
</a></dd>
                <?php endforeach; endif; unset($_from); ?>           
                <div style="clear:both"></div>
            </dl> 
        <h3 class="title1">最新产品</h3>
         <dl class="list-7">
             <dt class="a1"><img src="/images/21/wbl.png"/><a href="#">岛津精彩津</a></dt>
             <dt>

               <ul class="list-1">
                <li><em class="c1"></em><a href="#">岛津精彩津</a></li>
                <li><em class="c2"></em><a href="#">岛津津精</a></li>
                <li><em class="c3"></em><a href="#">岛津彩亮相B</a></li>
                <li><em class="c4"></em><a href="#">岛津精津精</a></li>
                <li><em class="c5"></em><a href="#">岛津精彩</a></li>

                <div style="clear:both"></div>
               </ul>
             </dt>
              <div style="clear:both"></div>
                    <dd>岛津精彩亮岛津精彩亮相BCEIA 2011（一）</dd>
                    <dd>北京BCEIA展会安谱展台受谱展台受青睐</dd>
                    <dd>默克密理博"谱展台受谱展台受解谱展决方案</dd>

                    <dd>博纳艾杰尔样品前处理技术专前处理技家研</dd>
                    <dd>纪念乔布斯JEOL推出布斯JEOIpad控制电镜</dd>
                    <dd>JULABO吉祥青蛙总动员-J青蛙O温控</dd>
                    <dd>予会授予利曼为2011最佳公司 </dd>
         </dl>
        <h3 class="title1">促销产品</h3>

         <dl class="list-7">
             <dt class="a1"><img src="/images/1/07.png" /><a href="#">岛津精彩津</a></dt>
             <dt class="a1"><img src="/images/1/07.png" /><a href="#">岛津精彩津</a></dt>
              <div style="clear:both"></div>
               <?php if (count($_from = (array)$this->_tpl_vars['promotes'])):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['data']):
?>
                <dd><a href="/promotion/<?php echo $this->_tpl_vars['data']['id']; ?>
.html"><?php echo $this->_tpl_vars['data']['title']; ?>
</a></dd>
               <?php endforeach; endif; unset($_from); ?>
         </dl>
         <img class="top" src="/images/1/1.png" style="float:left" />
     </div>
        
        
        
     </div>
</div>
<div style="clear:both"></div>  
</div>


<!--主体结束-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>