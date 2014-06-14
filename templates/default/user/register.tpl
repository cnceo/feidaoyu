{{include file=global/header.tpl}}
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
$.validator.setDefaults({
	 submitHandler: function() {
	 	var data = $("#myForm").formToArray();
				$.ajax({
				type: "POST",
				url:  "/?type=user&m=register&a=savePost",
				data: data,
				dataType: 'json',
				success: function(msg){
					    if(msg.status == "true")
						    {
								  alert(msg.message);
								  parent.location = '/';
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
		    			remote:"/?type=user&m=register&a=check"
		    		},
		    		password: {
		    			required: true,
		    			minlength: 6,
		    			maxlength: 10
		    		},
		    		repasswd: {
		    			required: true,
		    			equalTo:"#password"
		    		},
		    		checkcode: {
	    		    	required: true,
		    		    remote:"/?type=user&m=authcode&a=check"
		    		},
	    	      },
	    	 messages: {
	     	 	  email: {
	    		    	required: "请输入您的常用邮箱地址",
		    			email:"请正确输入您的邮箱地址",
		    			remote:"该邮箱已经被占用或不合法"
		    		},
	    		    password: {
	    		    	required: "请输入密码，密码最短不能少于6个字符",
	    		    	minlength: "密码最短不能少于6个字符",
	        		    maxlength: "密码最长不能超过10个字符"
		    		},
		    		repasswd: {
		    			required: "请输入密码，密码最短不能少于6个字符",
	    		    	equalTo: "两次密码输入不一致"
		    		},
		    		checkcode: {
	    		    	required: "请输入验证码",
		    		    remote:"请输入正确的验证吗"
		    		},
	    	      }
	   	 });
	  $("#authcode").attr({ src: "/user/authcode.html", alt: "刷新验证码" });
	   	 $("#authcode").click(function(){
	   	 	var timestamp = (new Date()).valueOf();
	   	 	$("#authcode").attr({ src: "/user/authcode.html&t="+timestamp, alt: "刷新验证码" });
	   	 })
});
</script>
<div style="background:#FFF">
<div class="suc_content">
  <div class="suc_kuang">
    <div class="hei_513">
      <h4 class="h4_suc">注册飞刀鱼账户</h4>
      <p class="suc_p">如果您已拥有飞刀鱼账户，则可<a href="/user/login.html" class="cor_yellow">在此登录</a></p>
      <div class="radio_quyu">
      <!--   <input type="radio" name="registerMethod" class="Mradio"/><label for="tab1" hidefocus="true">用电子邮箱注册</label>
        <input type="radio" name="registerMethod" class="marl_40 Mradio" /><label for="tab2" hidefocus="true">用手机号码注册</label> -->
      </div>
      <form method="post" action="" id="myForm" name="myForm">
	  <!--   <input type="hidden" name="passToken" id="passToken" value="" /> -->
        <table class="login_ta">
          <tr>
            <td class="td1">邮箱：</td>
            <td>
              <input type="text" name="email" id="email" class="input_kuang val_m item errortip address" value=""/><span class="check_tips error_tip" id="emailCode">邮箱格式错误</span><span class="check_tips empty_tip">请输入邮箱</span><span class="succ_tips"></span>
            </td>
          </tr>
          <tr>
            <td class="td1">设置密码：</td>
            <td>
				<div class="td2" id="pwdTd">
                <input type="password" class="input_kuang item val_m errortip password" isRequired="true" id="password" name="password" autocomplete="off"/>
							</div>
            </td>
          </tr>
          <tr>
            <td class="td1">确认密码：</td>
            <td><input type="password" class="input_kuang val_m item errortip" name="repasswd" id="repasswd"/><!-- <span class="check_tips repeat_tip">密码输入不一致</span><span class="check_tips empty_tip">请输入确认密码</span><span class="succ_tips"></span> --></td>
          </tr>
                    <tr>
            <td class="td1"><input type="checkbox" name="ok" value="ON" onclick="document.getElementById('studentid').disabled=document.getElementById('studentid').disabled==true?false:true">&nbsp;学生证号：</td>
            <td><input type="text" class="input_kuang val_m item errortip" name="studentid" id="studentid" disabled="disabled"></td>
          </tr>
          <tr>
           	<td class="td1">验证码：</td>
          	<td>
                  <input type="text" class="input_kuang val_m item errortip checkcode" name="checkcode" id="checkcode" maxlength="4"/>
                  <!-- <img src="images/getCode.jpg" width="95" height="38"/> --><img id="authcode" width="95" height="38"/>
		  <span class="checkcode_span">
		    点击图片切换验证码<br/>
		    <i class="code_error"></i>
		  </span>
	   </td>
           </tr>
          <tr class="la_height">
            <td class="td1">&nbsp;</td>
            <td>
             <!--  <input type="hidden" name="callback" value=""/> -->
              <div class="sub_login flt_l"><input type="submit" class="no_bg" value="立即注册"/></div>
            </td>
          </tr>
        </table>
      </form><!-- email end -->

    <p class="p_cor_hui">点击"立即注册"，即表示您同意并愿意遵守飞刀鱼<a href="" class="cor_yellow">用户协议</a>和<a href="" class="cor_yellow">隐私政策</a></p>
  </div>
  <div class="suc_botm"></div><!--这部分是卷角效果-->
</div>
</div>

</div>
{{include file=global/footer.tpl}}