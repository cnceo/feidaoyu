<?php /* Smarty version 2.6.7, created on 2012-08-14 13:37:52
         compiled from admin/login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/login.tpl', 16, false),array('modifier', 'default', 'admin/login.tpl', 85, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->_tpl_vars['pagetitle']; ?>
 -- 管理系统后台</title>
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
			url:  "?m=<?php echo ((is_array($_tmp='login')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=checklogin",
			data: "m=<?php echo ((is_array($_tmp='login')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&username="+$("#username").val()+"&password="+$.md5($("#password").val()),
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
	    		    remote:"?m=<?php echo ((is_array($_tmp='authcode')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=check" 
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
   	 $("#authcode").attr({ src: "?m=<?php echo ((is_array($_tmp='authcode')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
", alt: "刷新验证码" });
   	 $("#authcode").click(function(){
   	 	var timestamp = (new Date()).valueOf(); 
   	 	$("#authcode").attr({ src: "?m=<?php echo ((is_array($_tmp='authcode')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&t="+timestamp, alt: "刷新验证码" });
   	 })

  });
  


</script> 


</head>

<body>

<div id="login">
     <div class="c_top"></div>
     <div class="c_left"></div>
     <div class="wrap">
     
          <div class="logo"><img src="<?php echo ((is_array($_tmp=@$this->_tpl_vars['sites']['picpath'])) ? $this->_run_mod_handler('default', true, $_tmp, "images/logo_small.gif") : smarty_modifier_default($_tmp, "images/logo_small.gif")); ?>
" /></div>
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