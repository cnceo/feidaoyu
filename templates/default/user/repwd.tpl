{{include file=global/header_box.tpl}}
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
$.validator.setDefaults({
	 submitHandler: function() {
				$.ajax({
				type: "POST",
				url:  "/user/changepassword.html&a=update",
				data: "password="+$("#newpasswd").val(),
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							alert("修改成功");
						 	location.href = '/user/login.html';
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
    			oldpasswd: {
    		    	required: true,
	    			minlength: 6,
	    			remote:"/?type=user&m=changepassword&a=checkpasswd"
	    		},
    		    newpasswd: {
    		    	required: true,
	    			minlength: 6
	    		},
	    		repasswd: {
	    			required: true,
	    			minlength: 6,
	    			equalTo:"#newpasswd"
	    		}
    	      },
    	 messages: {
    		    oldpasswd: {
    		    	required: "请输入旧密码",
	    			minlength: "密码要求由长度为6-16位字符组成",
	    			remote:"旧密码不正确"
	    		},
    		    newpasswd: {
    		    	required: "请输入新密码",
	    			minlength: ""
	    		},
	    		repasswd: {
	    			required: "请再次输入新密码",
	    			minlength: "密码要求由长度为6-16位字符组成",
	    			equalTo:"新密码两次输入不一致"
	    		}
    	      }
   	 });
});


</script>
<div class="top">
	<div class="logo">
		<a href="/"><img src="/images/mclogo.png" alt="飞刀鱼logo" /></a>
	</div>
</div>
<div class="suc_content">
  <div class="suc_kuang">
    <div class="hei_513">
      <p class="retrieve_pwd">重置密码</p>
    <div class="hei_513" style="height:428px; border:0;">
      <div class="radio_quyu">
      </div>
      <form method="post" action="" id="myForm" name="myForm">
	  <!--   <input type="hidden" name="passToken" id="passToken" value="" /> -->
        <table class="login_ta">
                  <tr>
            <td class="td1">旧密码：</td>
            <td>
				<div class="td2" id="pwdTd">
                <input type="password" class="input_kuang item val_m errortip password" isRequired="true" id="oldpasswd" name="oldpasswd" autocomplete="off"/>
			</div>
            </td>
          </tr>
          <tr>
            <td class="td1">设置密码：</td>
            <td>
				<div class="td2" id="pwdTd">
                <input type="password" class="input_kuang item val_m errortip password" isRequired="true" id="newpasswd" name="newpasswd" autocomplete="off"/>
			</div>
            </td>
          </tr>
          <tr>
            <td class="td1">确认密码：</td>
            <td><input type="password" class="input_kuang val_m item errortip" name="repasswd" id="repasswd"/><!-- <span class="check_tips repeat_tip">密码输入不一致</span><span class="check_tips empty_tip">请输入确认密码</span><span class="succ_tips"></span> --></td>
          </tr>
          <tr class="la_height">
            <td class="td1">&nbsp;</td>
            <td>
              <div class="sub_login flt_l"><input type="submit" class="no_bg" value="重置密码"/></div>
            </td>
          </tr>
        </table>
      </form>
  </div>
    </div>
    <div class="suc_botm"></div>
  </div>
</div>
{{include file=global/footer.tpl}}


