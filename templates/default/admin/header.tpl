<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{$sites.title}}--后台管理</title>


<link rel="stylesheet" type="text/css" href="styles/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="js/jquery/ui/themes/ui-lightness/ui.all.css" />
<script type="text/javascript" src="js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-1.8.custom.min.js"></script>
<script type="text/javascript" src="js/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="js/jquery/tab.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/jquery/thickbox/thickbox.js"></script>
<link  rel="stylesheet" type="text/css" href="js/jquery/thickbox/thickbox.css" />
<script type="text/javascript" src="js/jquery/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-timepicker-addon.js"></script>

<!--[if IE 6]>
<script src="js/DD_belated.js"></script>
<script>
    DD_belatedPNG.fix('.mr_img,.tl_b,.tr_b,.tc_b,#ad_container,.codemsg');
</script>
<![endif]-->

<!---->

</head>
<body>
{{if !$header_small}}
<div id="container">
<div id="header">
  <div class="div1"><!--<img class="mr_img" src="" title="Administration" onclick="location = '/admin/index.php?route=common/home&token=1679091c5a880faf6fb5e6087eb1b2dc'" src="./images/logo3.png" />--><img src="./images/logo3.png" /></div>
    <div class="div2"><img class="mr_img" src="images/lock.png" alt="" style="position: relative; top: 3px;" />&nbsp;登录帐户: <span>{{$smarty.session.login_admin.admin}}</span></div>
  </div>
<div id="menu">

  <ul class="nav left" style="display: none;">
    <li id="dashboard" class="{{$sites.dashboard}}"><a href="./" class="top">首页</a></li>
    <li id="catalog" class="{{$sites.catalog}}"><a class="top">产品</a>
     <ul>
        <li><a href="?m={{'product'|encrypt}}">产品列表</a></li>
        <li><a href="?m={{'product'|encrypt}}&a=add">添加新产品</a></li>
        <li><a href="?m={{'category'|encrypt}}">产品分类</a></li>
        </ul>
        </li>
   <li id="customer" class="{{$sites.customer}}"><a class="top">会员</a>
      <ul>
        <li><a href="?m={{'customer'|encrypt}}">会员列表</a></li>
        <li><a href="?m={{'customergroup'|encrypt}}">会员等级</a></li>
        <li><a href="?m={{'msg'|encrypt}}">留言列表</a></li>
        <li><a href="?m={{'order'|encrypt}}">订单列表</a></li>
        <li><a href="?m={{'order'|encrypt}}&a=domain">域名管理</a></li>
        <li><a href="?m={{'order'|encrypt}}&a=vps">主机管理</a></li>
         <li><a href="?m={{'domain'|encrypt}}">域名到期提醒列表</a></li>
      </ul>
    </li>

     <li id="arts" class="{{$sites.arts}}"><a class="top">内容</a>
      <ul>
        <li><a href="?m={{'article'|encrypt}}">内容列表</a></li>
        <li><a href="?m={{'articlecate'|encrypt}}">内容分类</a></li>
         <li><a href="?m={{'keyword'|encrypt}}">搜索关键词</a></li>
         <li><a href="?m={{'download'|encrypt}}">资源下载</a></li>
      </ul>
    </li>


    <li id="advs" class="{{$sites.advs}}"><a class="top">广告</a>
      <ul>
            <li><a href="?m={{'adv'|encrypt}}">广告列表</a></li>
            <li><a href="?m={{'adt'|encrypt}}">广告位置</a></li>
      </ul>
    </li>

    <li id="system" class="{{$sites.system}}"><a class="top">系统</a>
      <ul>
      <li><a href="?m={{'my'|encrypt}}">个人设置</a></li>
      <li><a href="?m={{'my'|encrypt}}&a=changepasswd">修改密码</a></li>
      <li><a href="?m={{'setting'|encrypt}}">系统设置</a></li>
        <li><a class="parent">用户管理</a>

          <ul>
            <li><a href="?m={{'account'|encrypt}}">用户列表</a></li>
            <li><a href="?m={{'usergroup'|encrypt}}">用户组</a></li>
            <li><a href="?m={{'dept'|encrypt}}">部门</a></li>
          </ul>
        </li>
        <li><a href="?m={{'log'|encrypt}}">系统日志</a></li>
         <li><a href="?m={{'parameter'|encrypt}}">系统参数</a></li>
        <li><a href="?m={{'database'|encrypt}}">数据库</a></li>
      </ul>
    </li>

    <!--
    <li id="help"><a class="top">帮助</a>
      <ul>
        <li><a onclick="window.open('http://shop.mpets.com.cn');">首页</a></li>
        <li><a onclick="window.open('http://www.opencart.com/index.php?route=documentation/introduction');">Documentation</a></li>

        <li><a onclick="window.open('http://forum.opencart.com');">Support Forum</a></li>
      </ul>
    </li>
    -->
  </ul>
  <ul class="nav right">
    <li id="store"><a onclick="window.open('/');" class="top">前台</a>
      <ul>
              </ul>

    </li>
    <li id="store"><a class="top" href="#" onclick="if(confirm('您确认现在就退出系统？')){location.href='?m={{'logout'|encrypt}}';}">退出</a></li>
  </ul>
  <script type="text/javascript"><!--
$(document).ready(function() {
	$('.nav').superfish({
		hoverClass	 : 'sfHover',
		pathClass	 : 'overideThisToUse',
		delay		 : 0,
		animation	 : {height: 'show'},
		speed		 : 'normal',
		autoArrows   : false,
		dropShadows  : false,
		disableHI	 : false, /* set to true to disable hoverIntent detection */
		onInit		 : function(){},
		onBeforeShow : function(){},
		onShow		 : function(){},
		onHide		 : function(){}
	});

	$('.nav').css('display', 'block');
});
//--></script>

</div>
{{/if}}