

{{include file=global/header.tpl}}
<script type="text/javascript">
$(function(){
	$.ajax({url:"/user/dunning.html"});
});
</script>
<div id="xmFocus" class="xmFocus cfl">
	<div index="1" style="z-index:2;background:#FFFFFF url(/images/big-img1.jpg) no-repeat center;">
		<a href="/vps/host-3.html" target="_blank" onClick="_gaq.push(['_trackEvent', '首页广告点击', 'A1']);" style="width:962px; height:430px; display:inline-block;"> </a>
	</div>
	<div index="2" style="z-index:1;background:#FFFFFF url(/images/big-img2.jpg) no-repeat center;">
		<a href="/domain.html/" style="width:962px; height:430px; display:inline-block;"></a>
	</div>
	<div index="3" style="z-index:1;background:#FFFFFF url(/images/big-img3.jpg) no-repeat center;">
		<a href="/user/register.html" style="width:962px; height:430px; display:inline-block;"></a>
	</div>
  <ul style="width: 60px; right: 50%;">
      <li index="3" class=""></li>
      <li index="2" class="on"></li>
      <li index="1" class=""></li>
  </ul>
</div>
<div class="home_main">
	<div class="home_Activity" style="padding:5px 0;">
	</div>
	<div class="home_phone cfl">

		<div class="home_miphone home_mitwo">
            <div class="phoneleft">
                <h2>M3型虚拟主机{{$data.cprodname|truncate:16:"UTF-8":"..."}}</h2>
                <p>2.5G独享{{$data.cmeta_keywords}}<br/>20G 月流量{{$data.cmeta_description}}<br/><em>&yen; 680{{$data.price}}/年</em></p>
                <a href="/vps/host-1.html" target="_blank" class="home_btn_buy" >查看详情</a>
            </div>
          <!--   <a href=""><img class="phoneright" src="{{$smarty.const.IMG_HOST}}{{$data.picpath}}" /></a>-->
		</div>

		<div class="home_miphone home_mithree">
            <div class="phoneleft">
                <h2>G5型虚拟主机{{$data.cprodname|truncate:16:"UTF-8":"..."}}</h2>
                <p>10.5G 独享{{$data.cmeta_keywords}}<br/>不限 月流量{{$data.cmeta_description}}<br/><em>&yen; 980{{$data.price}}/年</em></p>
                <a href="/vps/host-2.html" target="_blank" class="home_btn_buy" >查看详情</a>
            </div>
          <!--   <a href=""><img class="phoneright" src="{{$smarty.const.IMG_HOST}}{{$data.picpath}}" /></a>-->
		</div>

		<div class="home_miten">
            <div class="home_miten_link" style="background:url(/htdocs/images/thingss.png) no-repeat 120px 20px;">
				<a href=""><ul>
					<li class="item1"><em></em> </li>
					<li class="item2">原价：&yen;520</li>
					<li class="item3">
						<dl>
							<dt>10月倾情回馈</dt>
							<dd>.com国际 ／ .cn国内域名</dd>
						</dl>
					</li>
				</ul>
				<span class="home_miten_icon"></span></a>
			</div>
			<ul class="home_mitengo cfl">

				<li style="width:190px;"><a class="item" href="">700元现金券领取</a></li>
				<li style="width:190px;"><a class="item" href="" >发布会199元现金券领取</a></li>

			</ul>
		</div>
	</div>
	</div>
</div>

<script type="text/javascript">$(function(){Xmeb.App.xmFocus.init($("#xmFocus"),{mwidth:"auto",autoWidth:true});Xmeb.App.lazyload({defObj:".home_main",defHeight:50});});</script>
<!--
		<div id="footer">
			<div class="footer_Con">
				<ul class="footer_Nums cfl">
					<li><a href="">7天退货保障</a> </li>
					<li><a href="">15天换货承诺</a> </li>
					<li><a href="">200元全场免运费</a> </li>
					<li><a href="">380余家售后服务点</a> </li>
				</ul>
				<div class="footer_service cfl">
					<dl>
						<dt>帮助中心</dt>
						<dd><a href="">购物指南</a></dd>
						<dd><a href="">支付方式</a></dd>
						<dd><a href="">配送方式</a></dd>
					</dl>
					<dl>
						<dt>服务支持</dt>
						<dd><a href="">售后政策</a></dd>
						<dd><a href="">自助服务</a></dd>
						<dd><a href="">相关下载</a></dd>
					</dl>
					<dl>
						<dt>飞刀鱼之家</dt>
						<dd><a href="">29家飞刀鱼之家</a></dd>
						<dd><a href="">386家服务网点</a></dd>
						<dd><a href="">预约售后服务</a></dd>
					</dl>
					<dl>
						<dt>关于飞刀鱼</dt>
						<dd><a href="">了解飞刀鱼</a></dd>
						<dd><a href="">加入飞刀鱼</a></dd>
						<dd><a href="">联系我们</a></dd>
					</dl>
					<dl>
						<dt>关注我们</dt>
						<dd class="footer_service_sina">
							<a class="cfl" href="">
								<span class="item1"></span><span class="item2">新浪微博</span>
							</a>
						</dd>
						<dd class="footer_service_qq">
							<a class="cfl" href="">
								<span class="item1"></span><span class="item2">腾讯微博</span>
							</a>
						</dd>
					</dl>
					<ul class="footer_service_online">
						<li class="item1">电话客服-400-688-0921</li>
						<li class="item2">仅收市话费，周一至周日9:00-18:00</li>
						<li class="item3"><a href=""><img alt="点击进入在线客服" src="/htdocs/images/webIndex_05.gif"></a></li>
					</ul>
				</div>
			</div>
 -->

 {{include file=global/footer.tpl}}

