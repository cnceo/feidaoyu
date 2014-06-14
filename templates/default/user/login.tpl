{{include file=global/header_box.tpl}}
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
					    	if({{if $uri}}1{{else}}0{{/if}})
								  parent.location = "{{$baseurl}}";
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
{{include file=global/footer.tpl}}