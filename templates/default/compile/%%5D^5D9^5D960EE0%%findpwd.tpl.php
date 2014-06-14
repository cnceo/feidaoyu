<?php /* Smarty version 2.6.7, created on 2012-08-15 16:36:58
         compiled from user/findpwd.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>  找回密码 </title>
<link href="/css/box.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
$.validator.setDefaults({
	 submitHandler: function() {
	 	var data = $("#myForm").formToArray();
				$.ajax({
				type: "POST",
				url:  "/?type=user&m=login&a=sendemail",
				data: data,
				dataType: 'json',
				success: function(msg){

					    if(msg.status == "true")
						    {
								 alert(msg.message);
						    }
						    else
						    {
						    	alert(msg.message);
						    }
				   }
			});
	}
});


$(document).ready(function(){

   	   $("#myForm").validate({
    	rules: {
	    		email: {
	    			required: true,
	    			email:true,
	    			remote:"/?type=user&m=login&a=check"
	    		}
    	      },
    	 messages: {
    	 	 
    	 	    email: {
    		    	required: "请输入您的邮箱",
    		    	email:"请输入正确的邮箱格式" ,
    		    	remote:"该邮箱不存在"   
	    		}
    	      }
   	 });

});

</script>
<div class="container">
  <div class="header">
    <h1 class="fl"><img src="/images/Hda_edu_03.png" alt="海大教育，互联网人才培训基地" width="364" height="63" /></h1>
    <a href="javascript:;" class="close fr" onclick="self.parent.tb_remove();" title="关闭"></a>
  </div>
  <div class="clear"></div>

  <div class="wrapper">
       <div class="sign-main">
          <div class="sign-main-l">
             <img src="/images/sign-in_06.jpg" width="374" height="85" />
          </div>
          <div class="sign-main-r">
           <h3><img src="/images/sign-in_06_099.png" width="69" height="19" /></h3>
            <form method="post" name="myForm" id="myForm">
                <span class="fo1">邮箱：</span><input class="text" name="email" id="email" type="text" />
                <div class="clear"></div>


            <div class="sign-main-r-c">

                           <button class="denglu" type="submit">找回密码</button>
             
               
               
            </div>
            </form>
            <div class="sign-main-r-b" >
            <p><a href="">如果还没有账户</a>|<a href="">请注册</a></p>
            </div>
          </div>
       </div>


      </div>
      <div class="clear"></div>







  <div class="footer_nav">
    <ul>
      <li><a href="/">首页</a></li>
      <li><a href="/php">PHP培训</a></li>
      <li><a href="/html">WEB前端培训</a></li>
      <li><a href="/3g">3G移动开发培训</a></li>
      <li><a href="/teacher">师资团队</a></li>
      <li><a href="">权威认证</a></li>
      <li><a href="">视频教程</a></li>
      <li><a href="">创业就业</a></li>
      <div class="clear"></div>
    </ul>
  </div>
  <div class="copyright">
  <p>Copyright@2009-2012 Seabig. All rights reserved. ICP备11033485-1</p>
  </div>
</div>
</body>
</html>

