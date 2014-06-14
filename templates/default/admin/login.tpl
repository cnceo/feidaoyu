<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{{$pagetitle}} -- 管理系统后台</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery/jquery.md5.js"></script>
<script type="text/javascript" src="js/jquery/jquery.validate.js"></script>
<link  media=all href="styles/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$.validator.setDefaults({
	 submitHandler: function() {
			$.ajax({
			type: "POST",
			url:  "?m={{'login'|encrypt}}&a=checklogin",
			data: "m={{'login'|encrypt}}&username="+$("#username").val()+"&password="+$.md5($("#password").val()),
			dataType: 'json', 
			success: function(msg){
					if(msg.status == "true")
			 {
				location.href="./";
			 }
			 else
				{
				$("#error-message").html(msg.message);
				}
			} 
		}); 	
	}
});
$(document).ready(function(){
    $("#myform").validate({
    	rules: {
	    		username: {
	    			required: true,
	    			minlength: 3
	    		},
	    		password: {
	    			required: true,
	    			minlength: 6
	    		},
	    		checkcode: {
    		    	required: true,
	    		    remote:"?m={{'authcode'|encrypt}}&a=check" 
	    		}
    	      },
    	messages: {
    		username: {
    			required: "用户名不能为空",
    			minlength: "用户名不能少于3个字符"
    		   },
    	    password: {
    			required: "密码不能为空",
    			minlength: "密码不能少于6个字符"
    		   },
    	    checkcode: {
    			required: "请输入验证码",
    			remote: "请输入正确的验证码"
    		   }
    	}
   	 });
   	 $("#authcode").attr({ src: "?m={{'authcode'|encrypt}}", alt: "刷新验证码" });
   	 $("#authcode").click(function(){
   	 	var timestamp = (new Date()).valueOf(); 
   	 	$("#authcode").attr({ src: "?m={{'authcode'|encrypt}}&t="+timestamp, alt: "刷新验证码" });
   	 })

  });
  


</script> 


</head>

<body>

<div id="login">
     <div class="c_top"></div>
     <div class="c_left"></div>
     <div class="wrap">
     
          <div class="logo"><img src="{{$sites.picpath|default:"images/logo_small.gif"}}" /></div>
          <ul class="topnav">
              <li><a href="#">Version 1.0.1 Beta</a></li>
          </ul>
          <div class="banner"><img src="images/banner.gif" /></div>
          
          <form method="post" name="myform" id="myform">
 			<ul class="login_a">
               <li>用户名：<input type="text"  name="username" id="username" size="10" class="c" /></li>
               <li>密&nbsp;&nbsp;&nbsp;码：<input type="password" name="password" id="password" size="10"  class="c" /></li>
               <li>验证码：<input id="checkcode" type="text" name="checkcode" class="a" /><img id="authcode" /><!--<span><a href="#">忘记密码？</a></span>--></li>
               <li><input name="" type="image" src="images/btn.gif" class="btn" /></li>
               <li id="error-message"></li>
            </ul> 
          </form>
     </div>
     <div class="c_lright"></div>
     <div class="c_bottom">Copyright © 2003-2010, Seabig Software Inc. All Rights Reserved.</div>
</div>

</body>
</html>
