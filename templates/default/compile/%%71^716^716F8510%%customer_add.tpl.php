<?php /* Smarty version 2.6.7, created on 2012-08-20 18:00:52
         compiled from admin/customer_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/customer_add.tpl', 11, false),array('function', 'html_options', 'admin/customer_add.tpl', 106, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="js/editor/tiny_mce.js"></script>
<script type="text/javascript" src="js/editor/editor_simple.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		username: {
	    			required: true,
	    			minlength: 4,
	    			remote:"?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=check&id=<?php echo $this->_tpl_vars['log']['id']; ?>
" 
	    		},
	    		email: {
	    			required: true,
	    			email:true,
	    			remote:"?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=check&id=<?php echo $this->_tpl_vars['log']['id']; ?>
" 
	    		},
	    		mobile: {
	    			required: true,
	    			phone:true,
	    			remote:"?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=check&id=<?php echo $this->_tpl_vars['log']['id']; ?>
" 
	    		}
    	      },
    	 messages: {
    		    username: {
    		    	required: "请填写用户名",
    		    	minlength: "昵称最短不能少于4个字符",
    	 	    	remote:"该用户名已经被占用"
	    		},
	    		email: {
	    			required: "请填写email",
	    			phone:"请输入正确的email",
	    			remote:"该email已经被占用" 
	    		},
	    		mobile: {
	    			required: "请填写手机号码",
	    			phone:"请输入正确的手机号码",
	    			remote:"该手机号码已经被占用" 
	    		}
    	      },
		showErrors:function(errorMap,errorList){ 
			        $(".warning").css('display','block');
			        $(".warning").html("带*为必填项，共有 " + this.numberOfInvalids() + " 错误，请仔细检查！"); 
			        this.defaultShowErrors(); 
			   }	
   	 });
   	  $("#province").change(function(){
   	  	jQuery("#city").load("?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=citylist&pid="+jQuery("#province").val());
   	  	jQuery("#county").html("<option value=\"\">请选择区县</option>");
        });
	  $("#city").change(function(){
   	  	jQuery("#county").load("?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=&a=countylist&pid="+jQuery("#city").val());
        });
});
       
       $.validator.setDefaults({
			 submitHandler: function() {
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
';    
								    }
								    else
								    {
								    	$(".warning").html(msg.message);
								    	$(".warning").css('display','block');
								    }	 
						   }
					}); 	
			}
		});
</script>
<div id="content">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('./images/payment.png');"><?php if ($this->_tpl_vars['log']['id'] == ""): ?>添加<?php else: ?>修改<?php endif;  echo $this->_tpl_vars['sites']['title']; ?>
</h1>
    <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>

  </div>
  <div class="content">
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a></div>
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['log']['id']; ?>
">
      <div id="tab_general" style="display: block;">
			          <table class="form">
			            <tbody>
			             <tr>
			              <td>真实姓名:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['truename']; ?>
" size="80" name="truename" id="truename">
			                </td>
			            </tr>
			             <tr>
          <td>会员等级</td>
          <td><select name="customer_group_id">
		       <option value="">请选择</option>   
		      <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cglist'],'selected' => $this->_tpl_vars['log']['customer_group_id']), $this);?>

		      </select>
	  </td>
        </tr>
         <tr>
          <td>性别</td>
          <td><input type="radio" name="gender" id="gender" value="0" checked/>女
                  <input type="radio" name="gender" id="gender" value="1" <?php if ($this->_tpl_vars['log']['gender'] == '1'): ?>checked<?php endif; ?> />男
	  </td>
        </tr>
			            <tr>
			              <td><span class="required">*</span> 用户名:</td>
			              <td>
			              <input value="<?php echo $this->_tpl_vars['log']['truename']; ?>
" size="80" name="username" id="username" <?php if ($this->_tpl_vars['log']['username']): ?>disabled<?php endif; ?>>
			                </td>
			            </tr>
			             <tr>
			              <td>昵称:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['nickname']; ?>
" size="80" name="nickname" id="nickname" <?php if ($this->_tpl_vars['log']['nickname']): ?>disabled<?php endif; ?>>
			                </td>
			            </tr>
			            <tr>
			              <td>密码:</td>
			              <td><input value="" size="80" name="password" id="password">
			                </td>
			            </tr>
	<tr>
          <td><span class="required">*</span> 手机号码</td>
          <td><input type="text" name="mobile" id="mobile" size="80" value="<?php echo $this->_tpl_vars['log']['mobile']; ?>
"/></td>
        </tr>
	<tr>
	<tr>
          <td>电话号码</td>
          <td><input type="text" name="telphone" id="telphone" size="80" value="<?php echo $this->_tpl_vars['log']['telphone']; ?>
"/></td>
        </tr>
	<tr>
          <td><span class="required">*</span> 电子邮件</td>
          <td><input type="text" name="email" id="email" size="80" value="<?php echo $this->_tpl_vars['log']['email']; ?>
"/></td>
        </tr>
	<tr>
          <td>出生年月日</td>
          <td><input type="text" size="8"  id="year" name="year" value="<?php echo $this->_tpl_vars['log']['year']; ?>
">
                   年
                      <select name="month" id="month" class="information_width">
                          <option value="">请选择</option>
                          <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['monthlist'],'selected' => $this->_tpl_vars['log']['month']), $this);?>

                        </select>月
                        <select name="day" id="day" class="information_width">
                          <option value="">请选择</option>
                          <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['daylist'],'selected' => $this->_tpl_vars['log']['day']), $this);?>

                        </select>日
	  </td>
        </tr>
	<tr>
          <td>联系住址</td>
          <td><select id="province" name="province" class="region" >
				     <option value="">请选择省份</option>
				     <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['provincelist'],'selected' => $this->_tpl_vars['log']['province']), $this);?>

				     </select>
				     <select id="city" name="city" class="region" >
				      <option value="">请选择城市</option>
				     <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['citylist'],'selected' => $this->_tpl_vars['log']['city']), $this);?>

				     </select>
				     <select id="county" name="county" class="region" >
				      <option value="">请选择区县</option>
				      <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['countylist'],'selected' => $this->_tpl_vars['log']['county']), $this);?>

				     </select> <br/><input type="text" name="address" id="address" size="80" value="<?php echo $this->_tpl_vars['log']['address']; ?>
" /></td>
        </tr>
	<tr>
          <td>邮政编码</td>
          <td><input type="text" name="postcode" id="postcode" size="12" value="<?php echo $this->_tpl_vars['log']['postcode']; ?>
" /></td>
        </tr>
        
        <tr>
            <td>状态:</td>
            <td><select name="status">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statuslist'],'selected' => $this->_tpl_vars['log']['status']), $this);?>

                              </select></td>
          </tr>
			          </tbody></table>
		      </div>
      <div id="tab_data" style="display: none;">
        
      </div>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>
  
</div>
<script type="text/javascript"><!--
$.tabs('#tabs a'); 
$.tabs('#languages a'); 
//--></script>
</div></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>