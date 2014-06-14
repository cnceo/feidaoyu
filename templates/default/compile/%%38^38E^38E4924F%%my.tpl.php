<?php /* Smarty version 2.6.7, created on 2012-07-25 13:23:12
         compiled from admin/my.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/my.tpl', 40, false),array('function', 'html_options', 'admin/my.tpl', 88, false),)), $this); ?>
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
	    		truename: {
	    			required: true
	    		},
	    		admin: {
	    			required: true
	    		},
	    		mobile: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    truename: {
    		    	required: "请填写真实姓名"
	    		},
	    		admin: {
	    			required: "请填写用户名"
	    		},
	    		mobile: {
	    			required: "请填写手机号码"
	    		}
    	      },
    	 errorPlacement: function(error, element){       
        	$(".warning").css('display','block');
    	     }
   	 });
});
       
       $.validator.setDefaults({
			 submitHandler: function() {
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m=<?php echo ((is_array($_tmp='my')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m=<?php echo ((is_array($_tmp='my')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
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
    <h1 style="background-image: url('./images/payment.png');"><?php echo $this->_tpl_vars['sites']['title']; ?>
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
			              <td><span class="required">*</span> 姓名:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['truename']; ?>
" size="80" name="truename" id="truename">
			                </td>
			            </tr>
			            <tr>
			              <td><span class="required">*</span> 用户名:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['admin']; ?>
" size="80" name="admin" id="admin" <?php if ($this->_tpl_vars['log']['id']): ?>disabled<?php endif; ?>>
			                </td>
			            </tr>
			            <tr>
          <td>部门</td>
          <td><select name="deptid" disabled><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['deptlist'],'selected' => $this->_tpl_vars['log']['deptid']), $this);?>
</select>
	  </td>
        </tr>
      <tr>
          <td>用户组</td>
          <td><select name="groupid" disabled><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['grouplist'],'selected' => $this->_tpl_vars['log']['groupid']), $this);?>
</select>
	  </td>
        </tr>
        </tr>
	<tr>
          <td><span class="required">*</span> 手机号码</td>
          <td><input type="text" name="mobile" id="mobile" size="80" value="<?php echo $this->_tpl_vars['log']['mobile']; ?>
"/></td>
        </tr>
	<tr>
          <td>电子邮件</td>
          <td><input type="text" name="email" id="email" size="80" value="<?php echo $this->_tpl_vars['log']['email']; ?>
"/></td>
        </tr>
	<tr>
          <td>QQ号码</td>
          <td><input type="text" name="qq" id="qq" size="80" value="<?php echo $this->_tpl_vars['log']['qq']; ?>
"/></td>
        </tr>
	<tr>
          <td>出生年月日</td>
          <td><input type="text" name="birthday" id="birthday" size="12" value="<?php echo $this->_tpl_vars['log']['birthday']; ?>
" />
	  </td>
        </tr>
	<tr>
          <td>联系住址</td>
          <td><input type="text" name="address" id="address" size="80" value="<?php echo $this->_tpl_vars['log']['address']; ?>
" /></td>
        </tr>
	<tr>
          <td>邮政编码</td>
          <td><input type="text" name="postcode" id="postcode" size="12" value="<?php echo $this->_tpl_vars['log']['postcode']; ?>
" /></td>
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