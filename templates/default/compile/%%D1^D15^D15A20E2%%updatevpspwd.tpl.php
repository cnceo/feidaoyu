<?php /* Smarty version 2.6.7, created on 2012-09-11 16:17:06
         compiled from user/updatevpspwd.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
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
				url:  "/user/vps.html&a=updatepwd",
				data: data,
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							alert("修改成功");
						 	location.href = '/user/vps.html';
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
    		    passwd: {
    		    	required: true,
	    			minlength: 6
	    		},
	    		repasswd: {
	    			required: true,
	    			minlength: 6,
	    			equalTo:"#passwd"
	    		}
    	      },
    	 messages: {
    		    passwd: {
    		    	required: "请输入新密码",
	    			minlength: "密码要求由长度为6-16位字符组成"
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
<div class="headborder"></div>

<div id="container" class="cfl">
	<div class="aside">
		<div class="nav">
			<div class="portlet" id="yw0">
            <div class="portlet-decoration">
                <div class="portlet-title">我的订单</div>
            </div>
            <div class="portlet-content">
                <ul class="operations" id="yw1">
                    <li><a class="T_navOrder" href="/user/order.html">交易订单</a></li>
                    <li><a class="T_navChange" href="/user/vps.html">主机管理</a></li>
                    <li><a class="T_navChange" href="/user/domain.html">域名管理</a></li>
                </ul>
            </div>
        </div>
        <div class="portlet" id="yw4">
            <div class="portlet-decoration">
                <div class="portlet-title">我的个人信息</div>
            </div>
            <div class="portlet-content">
                <ul class="operations" id="yw5">
                    <li><a target="_blank" class="T_navAddress" href="/user/changepassword.html">修改密码</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
	<!-- aside -->
<div class="main">
<div class="suc_content" style="padding-top:0; width:765px;">
  <div class="suc_kuang">
    <div class="hei_513"  style="border-bottom:1px solid #DADADA;" >
      <p class="retrieve_pwd">重置主机密码</p>
    <div style="height:auto; border:0;" class="hei_513">
      <div class="radio_quyu">
      </div>
      <form name="myForm" id="myForm" action="" method="post">
      <input type="hidden" name="ftpuser" value="<?php echo $this->_tpl_vars['log']['ftpuser']; ?>
">
      <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['log']['uid']; ?>
">
        <table class="login_ta">
           <tbody>
             <tr>
            <td class="td1">账户：</td>
            <td>
				<div id="pwdTd" class="td2">
                <?php echo $this->_tpl_vars['log']['domain']; ?>
<input type="hidden" name="vpsid" value="<?php echo $this->_tpl_vars['log']['id']; ?>
">
			</div>
            </td>
          </tr>
          <tr>
            <td class="td1">设置密码：</td>
            <td>
				<div id="pwdTd" class="td2">
                <input type="password" autocomplete="off" name="passwd" id="passwd" isrequired="true" class="input_kuang item val_m errortip password">
			</div>
            </td>
          </tr>
          <tr>
            <td class="td1">确认密码：</td>
            <td><input type="password" id="repasswd" name="repasswd" class="input_kuang val_m item errortip"></td>
          </tr>
          <tr class="la_height">
            <td class="td1">&nbsp;</td>
            <td>
              <div class="sub_login flt_l"><input type="submit" value="重置密码" class="no_bg"></div>
            </td>
          </tr>
        </tbody></table>
      </form>
  </div>
    </div>
  </div>
</div>




    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>