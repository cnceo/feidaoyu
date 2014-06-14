<?php /* Smarty version 2.6.7, created on 2012-10-15 00:42:13
         compiled from user/login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header_box.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
$.validator.setDefaults({
	 submitHandler: function() {
	 	var data = $("#myForm").formToArray();
				$.ajax({
				type: "POST",
				url:  "/user/login.html&a=checklogin",
				data: data,
				dataType: 'json',
				success: function(msg){
					    if(msg.status == "true")
						    {
					    	if(<?php if ($this->_tpl_vars['uri']): ?>1<?php else: ?>0<?php endif; ?>)
								  parent.location = "<?php echo $this->_tpl_vars['baseurl']; ?>
";
								  else
									  {
									  parent.location = "/user/order.html";
									  }
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
	    		},
	    		password: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		 email: {
    	 	    	required: "请输入您的邮箱",
    	 	    },
    	 	    password: {
    		    	required: "请输入密码"
	    		}
    	      }
   	 });

});

</script>


<div class="top">
	<div class="logo">
		<a href="/"><img src="/images/mclogo.png" /></a>
	</div>
</div>
<div class="content clearfix">
  <div class="login_form clearfix">
    <div class="pad_50 clearfix">
      <h4>欢迎登录飞刀鱼账户</h4>
      <form method="post" action="" id="myForm">
        <div class="marb_14 por_r" id="loginId">
		  <input type="text" name="username" value="邮箱" id="email" class="input_kuang item errortip" onfocus="if (value =='邮箱'){value =''};this.style.color='black';" onblur="if (value ==''){value='邮箱'};this.style.color='#d8dada';" style="color:#d8dada"/>
		  <span class="littlepop"><!-- 错误提示小气泡 -->
            <i class="little_corner"></i>
          </span>
        </div>
        <div class="marb_14 por_r" id="loginPass">
          <input type="password" class="input_kuang  errortip" id="password" name="password"  />
		  <span class="littlepop">
            <i class="little_corner"></i>
          </span>
        </div>
        <div class="sub_log clearfix">
          <div class="sub_login sub_log_bottom  flt_l"><input type="submit" class="no_bg" value="登录"/></div>
          <a href="/user/forgetpassword.html">忘记密码？</a>
        </div>
      </form>
      <div class="clear"></div>
	  <div class="third">
      &nbsp;
        <!-- <span>用其他账户登录： </span></a><a class="qq" href="">QQ</a><a class="renren" href="javascript:;">人人</a><a class="sina">新浪-->
      </div>
    </div>
    <div class="ano_log">
      <a href="/user/register.html" class="mt_login mart_10">立即注册</a>
    </div>
    <div class="ano_span_t"></div>
  </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>