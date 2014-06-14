<?php /* Smarty version 2.6.7, created on 2012-08-20 18:00:58
         compiled from admin/customergroup_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/customergroup_add.tpl', 37, false),)), $this); ?>
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
	    		cname: {
	    			required: true
	    		},
	    		ename: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    cname: {
    		    	required: "请填写会员中文名称"
	    		},
    		    ename: {
    		    	required: "请填写会员英文名称"
	    		}
    	      },
    	 showErrors:function(errorMap,errorList){ 
			        $(".warning").css('display','block');
			        $(".warning").html("带*为必填项，共有 " + this.numberOfInvalids() + " 错误，请仔细检查！"); 
			        this.defaultShowErrors(); 
			   }	
   	 });
});
       
       $.validator.setDefaults({
			 submitHandler: function() {
			 	tinyMCE.triggerSave(false, false);
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m=<?php echo ((is_array($_tmp='customergroup')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m=<?php echo ((is_array($_tmp='customergroup')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
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
        <div class="htabs" id="languages">
                    <a tab="#language1" class="selected"><img src="./images/flags/cn.png" title="中文" /> 中文</a>
                    <a tab="#language2"><img src="./images/flags/gb.png" title="英文" /> 英文</a>
		          </div>
                <div id="language1" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 会员等级名称:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['cname']; ?>
" size="100" name="cname" id="cname">
			                </td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="cdescription"  style="width:60%" class="mceEditor"><?php echo $this->_tpl_vars['log']['cdescription']; ?>
</textarea>
			          </tbody></table>
		        </div>
		        <div id="language2" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 会员等级名称:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['ename']; ?>
" size="100" name="ename" id="ename">
			                </td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="edescription"  style="width:60%" class="mceEditor"><?php echo $this->_tpl_vars['log']['edescription']; ?>
</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>
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