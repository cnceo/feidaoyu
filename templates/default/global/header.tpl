<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="{{$sites.cmeta_description}}">
<meta name="keywords" content="{{$sites.cmeta_keywords}}">
<title>{{$sites.pagetitle}}-{{$sites.csitename}}</title>
<link rel="shortcut icon" href="/images/favicon.ico" mce_href="/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="/htdocs/css/style.css"/>
<link rel="stylesheet" type="text/css" href="/htdocs/css/global.css" />
<link rel="stylesheet" type="text/css" href="/htdocs/css/index.css" />
<link rel="stylesheet" type="text/css" href="/htdocs/css/uc_comon.css" />
<link rel="stylesheet" type="text/css" href="/htdocs/css/default.css" />
<link rel="stylesheet" type="text/css" href="/htdocs/css/shopping.css" />
<script type="text/javascript" src="/htdocs/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/htdocs/js/fdy.js"></script>
<body>

<!--头部开始-->
         <div id="header" class="cfl">
			<div class="header_wrap" style="border:none;">
				<h1 class="header_logo"><a href="/"><img src="/htdocs/images/fdylogo.gif" /></a></h1>
				<div class="header_menu">
					<ul class="header_menu_top cfl">
						<li class="header_menu_top_cart">
							<div class="header_menu_top_list cfl">
								<span class="item1"></span>
								<a href="/cart.html"><span class="item2">购物车<em id="miniCartNum">{{$cartcount|default:"0"}}</em>件</span></a>
								<div class="header_miniCart" id="header_miniCart" style="display:none;">
									<p class="header_miniCart_gocart">
										<a href="/user/checkout.html">去结算</a>
									</p>
								</div>
							</div>
						</li>
                       <li class="header_menu_top_order">
                            <a title="我的订单" href="/user/order.html">我的订单</a>
                       </li>
                       {{if $smarty.session.login_user.email}}

                        <li class="header_menu_top_login cfl" >
                            <a href="/user/order.html"> {{$smarty.session.login_user.email}}</a>
                            <a class="no_border" href="/user/logout.html">[退出]</a>
                       </li>
                       {{else}}
                       <li class="header_menu_top_login cfl" >
                            <a href="/user/login.html">登录</a>
                            <a class="no_border" href="/user/register.html">注册</a>
                       </li>
                       {{/if}}
					</ul>
                    <div class="clear"></div>
					<ul class="header_menu_nav cfl">
						<li class="m1"><a class="{{$sites.home}}" href="/">首页</a></li>
						<li class="m2"><a class="{{$sites.domain}}" href="/domain.html">域名注册</a></li>
						<li class="m3"><a class="{{$sites.vps}}" href="/vps.html">虚拟主机</a></li>
                        <li class="m4"><a class="{{$sites.hire}}" href="/hire.html">租用与托管</a></li>
                        <li class="m4"><a class="{{$sites.engineroom}}" href="/engineroom.html">机房介绍</a></li>
						<li class="m5"><a class="{{$sites.user}}" href="/user/order.html">会员中心</a></li>
						<li class="m10"></li>
					</ul>
				</div>
			</div>
		</div>
<!--头部结束-->