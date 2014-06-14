<?php /* Smarty version 2.6.7, created on 2012-09-05 16:21:05
         compiled from user/forgetpassword.tpl */ ?>
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
				url:  "/?type=user&m=forgetpassword&a=sendemail",
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
		    			remote:"/?type=user&m=forgetpassword&a=check"
		    		}
	    	      },
	    	 messages: {
	     	 	  email: {
	    		    	required: "请输入您的邮箱账户",
		    			email:"请正确输入您的邮箱地址",
		    			remote:"该邮箱账户不存在"
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
      <p class="retrieve_pwd">取回账户密码</p>
      <div class="new_pwd">
        <form method="post"  id="myForm" name="myForm">
          <p class="p_tips">请输入您飞刀鱼账户账户：</p>
          <div class="txt_input marb_14 por_r" id="forget">
            <input class="input_kuang long_width item errortip" type="text" value="邮箱"  onfocus="if (value =='邮箱'){value =''};this.style.color='black';" onblur="if (value ==''){value='邮箱'}" name="email" id="email" autocomplete="off"   />

            <br />
            <div class="sub_bg mart_60">
              <input class="no_bg" type="submit" value="发送" />
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="suc_botm"></div>
  </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

