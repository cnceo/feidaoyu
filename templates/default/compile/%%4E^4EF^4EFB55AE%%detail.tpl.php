<?php /* Smarty version 2.6.7, created on 2012-09-20 17:52:42
         compiled from product/detail.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>
function addcart(id,vps)
{
/* 	var y = document.getElementById("year");
	var year = y.options[y.selectedIndex].value; */
	var year = 1;
	if(id)location.href="/cart.html&a=addcart&id="+id+"&year="+year+"&vps="+vps;
	}
</script>
<div class="breadcrumbs">
<a href="/">飞鱼首页</a> <span class='separator'>></span> <a href="/vps.html">主机</a> <span class='separator'>></span> <span><?php echo $this->_tpl_vars['log']['cprodname']; ?>
</span></div>
<!-- breadcrumbs -->

<div id="container">
 <!--box-->
     <div class="contecttopbox">
          <dl class="topshow">
              <dt><a href=""><img src="/images/picture1.jpg" /></a></dt>
              <dd>
                  <h3><?php echo $this->_tpl_vars['log']['cprodname']; ?>
</h3>
                  <p>适合建立可交互的企业展示网站</p>
              </dd>
          </dl>
          <div class="boxbottom">
               <div class="boxbottomleft">
                    <div class="productparameter">
                       <p><span>></span><lable>操作系统：</lable> <?php echo $this->_tpl_vars['log']['sys']; ?>
</p>
                       <p><span>></span><lable>支持语言：</lable><?php echo $this->_tpl_vars['log']['lan']; ?>
</p>
                       <p><span>></span><lable>数据库：</lable>Mysql &nbsp;<span class="strong"><?php echo $this->_tpl_vars['log']['db']; ?>
</span></p>
                       <p><span>></span><lable>空间大小：</lable><span class="strong"><?php echo $this->_tpl_vars['log']['host']; ?>
</span></p>
                       <p><span>></span><lable>月流量：</lable><?php echo $this->_tpl_vars['log']['rate']; ?>
</p>
                     </div>
               </div>
               <dl class="boxbottomright">
                   <dd>
                    <div class="productparameter">
                       <p><font><?php echo $this->_tpl_vars['log']['price']; ?>
元/年</font></p>
                       <p>2年&nbsp;<?php echo $this->_tpl_vars['log']['price']*2*0.85; ?>
元&nbsp;立省 <span class="red"><?php echo $this->_tpl_vars['log']['price']*2-$this->_tpl_vars['log']['price']*2*0.85; ?>
</span>元</p>
                       <p>3年&nbsp;<?php echo $this->_tpl_vars['log']['price']*3*0.80; ?>
元&nbsp;立省 <span class="red"><?php echo $this->_tpl_vars['log']['price']*3-$this->_tpl_vars['log']['price']*3*0.80; ?>
</span>元</p>
                       <input type="button" class="listinput" onclick="addcart('<?php echo $this->_tpl_vars['log']['id']; ?>
','vps')" value="加入购物车" />
                     </div>
                   </dd>
                   <dt><a href=""><img src="/images/picture2.jpg" /></a></dt>
               </dl>
               <div class="clear"></div>
          </div>
     </div>
 <!--box end-->
      <script type="text/javascript">
			function selectTag(showContent,id){
			// 操作标签
			for(i=0; i<4; i++){
			document.getElementById("a"+i).className = "";
			}
			document.getElementById("a"+id).className = "current";
			// 操作内容
			for(i=0;i<4 ; i++){
			document.getElementById("tagContent"+i).style.display = "none";
			}
			document.getElementById(showContent).style.display = "block";
			}
	 </script>
     <div class="contectbottom">
          <ul class="contectbottomnav">
              <li><a class="current" id="a0" onclick="selectTag('tagContent0',0)" href="javascript:void(0)">商品详情</a></li>
              <li><a id="a1" onclick="selectTag('tagContent1',1)" href="javascript:void(0)">为什么选择</a></li>
              <li><a id="a2" onclick="selectTag('tagContent2',2)" href="javascript:void(0)">常见问题</a></li>
              <li><a id="a3" onclick="selectTag('tagContent3',3)" href="javascript:void(0)">风险提示</a></li>
          </ul>

      <!--商品详情-->
      <div class="bigbetails" id="tagContent0">
          <ul class="contectnav">
             <!--   <li><a href="">Windows操作系统</a></li> -->
               <li><a href="">Linux操作系统</a></li>
               <div class="clear"></div>
           </ul>


            <div  class="hp0_Content0">
                    <?php echo $this->_tpl_vars['log']['content']; ?>

            </div>


            <!--问答部分-->
            <div class="refer_unitive">
                <div class="asktitle">购买常见咨询</div>
                <div class="askcontent">
                    <div class="qu link_orange">
                        我想建个企业展示性的网站，这款主机适合吗？
                    </div>
                    <div class="answer">
                        答：您好，这款主机完全适合。
                    </div>
                    <div class="qu link_orange">
                        我的网站中有流媒体（音频、视频）格式文件，此网站是
                        否支持？
                    </div>
                    <div class="answer">
                        答：可以支持的，但是如果网站访问量较大，会造成此主机流量不足，建议您选择流量充足的<a class="link_blue" href="">翔云主机</a>。
                    </div>
                    <div class="qu link_orange">
                        飞刀鱼主机的稳定性好吗？
                    </div>
                    <div class="answer">答：您好，飞刀鱼有16年的网络运营经验，大品牌，主机稳定性值得放心；</div>
                </div>
            </div>
            <!--问答部分 end-->
        </div>
    </div>
      <!--商品详情 end-->




      <!--为什么选择-->
      <div class="bigbetails" id="tagContent1" style="display:none;">
           <div class="hp0_Content0">


                <h4 class="fontwhh4" style="padding-bottom:0">中国虚拟主机技术的开创者</h4>
                    <p>中国飞刀鱼是中国虚拟主机技术的开创者，拥有自主知识产权的主机开发运营平台，目前有数万家企业用户使用飞刀鱼的主机部署网站。</p>
                <h4 class="fontwhh4" style="padding-bottom:0">产品线丰富，满足多层次需要</h4>

                    <p>飞刀鱼拥有完善的虚拟主机产品线，包括M享、G享、L享，可以满足企业展示、电子商务等多种互联网应用的需要，让客户在飞刀鱼总能找到其所需要的主机产品。</p>
                <h4 class="fontwhh4" style="padding-bottom:0">独立IP地址，行业领先</h4>

                    <p>飞刀鱼主机产品都配备独立IP地址，这一点一般的服务商都难以做到，独立IP地址一方面可以避免网络攻击带来的连带风险，另一方面可以提高搜索引擎友好性，利于网站推广。</p>
                <h4 class="fontwhh4" style="padding-bottom:0">百人专家服务团队，7*24小时不间断服务</h4>

                    <p>中国飞刀鱼拥有国内最专业的技术支持团队，所有工程师都通过Microsoft或Cisco认证，拥有国内最专业的呼叫中心，能提供7*24小时不间断的电话、邮件以及在线服务支持，并且所有主机运行状态都在飞刀鱼监控体系下，保证问题及时处理。</p>


            </div>
      </div>
      <!--为什么选择 end-->
      <!--常见问题-->
      <div class="bigbetails" id="tagContent2" style="display:none;">
            <div class="refer_unitive">
                <div class="asktitle">购买常见咨询</div>
                <div class="askcontent">
                    <div class="qu link_orange">
                        我想建个企业展示性的网站，这款主机适合吗？
                    </div>
                    <div class="answer">
                        答：您好，这款主机完全适合。
                    </div>
                    <div class="qu link_orange">
                        我的网站中有流媒体（音频、视频）格式文件，此网站是
                        否支持？
                    </div>
                    <div class="answer">
                        答：可以支持的，但是如果网站访问量较大，会造成此主机流量不足，建议您选择流量充足的主机</a>。
                    </div>
                    <div class="qu link_orange">
                        飞刀鱼主机的稳定性好吗？
                    </div>
                    <div class="answer">答：您好，飞刀鱼有16年的网络运营经验，大品牌，主机稳定性值得放心；</div>
                </div>
            </div>
      </div>
      <!--常见问题 end-->
      <!--风险提示-->
      <div class="bigbetails" id="tagContent3" style="display:none;">
            <div class="hp0_Content0">

<h4 class="fontwhh4" style="padding-bottom:0">主机相关的风险预警</h4>
<h4 class="fontwhh4" style="padding-bottom:0">网站备案-购买主机需要按工信部要求进行网站备案</h4>
 <p>网站备案是一项国家政策，部分服务商承诺不备案即可开通网站属于严重的违反国家政策，由此开通的网站不被保护。</p>
 <p>飞刀鱼作为国内最大的互联网基础服务商，有着强大的服务实力，能切实保证用户网站能高效完成备案，保证用户网站顺利上线开通。</p>

<h4 class="fontwhh4" style="padding-bottom:0">服务保障</h4>
 <p>主机服务是互联网的基础服务，要求服务商必须拥有7*24小时的全天候服务能力。</p>
 <p>飞刀鱼客户服务中心和技术支持中心提供7×24小时不间断的专业的电话服务和全方位的实时智能监控，是为数不多能提供7*24小时不间断服务的服务商。</p>

<h4 class="fontwhh4" style="padding-bottom:0">选购主机要注意服务商的资质</h4>
 <p>用户在购买虚拟主机之前，要先审核一下服务商的资历，有无正规的ICP经营许可证，不正规服务商经营的主机随时会被关停。</p>

<h4 class="fontwhh4" style="padding-bottom:0">性价比是选择主机的标准</h4>
 <p>千万别贪便宜，主机的价格绝对不是越便宜越好，有些服务商提供的价格虽然很便宜，但是他们往往将大量的网站放在同一台服务器上，从而使每个网站的出口带宽很窄，网页浏览速度很慢，最重要的是极不安全，这种现象早已屡见不鲜。所以，要提醒的是，服务方面也是所有选择中最重要的一点，网络产品毕竟不是人为控制的，没有哪家的主机产品不出现一点问题的，主要看出了问题后服务能否跟得上，能否尽快的解决问题。</p>

            </div>
      </div>
      <!--风险提示 end-->
     </div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>