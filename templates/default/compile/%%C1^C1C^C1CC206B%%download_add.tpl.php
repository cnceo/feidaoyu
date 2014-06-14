<?php /* Smarty version 2.6.7, created on 2012-09-03 14:00:53
         compiled from admin/download_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/download_add.tpl', 44, false),array('function', 'html_options', 'admin/download_add.tpl', 126, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script charset="utf-8" src="js/editor/kindeditor-min.js"></script>
<script charset="utf-8" src="js/editor/lang/zh_CN.js"></script>
<script charset="utf-8" src="js/editor/kindeditor-default.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		title: {
	    			required: true
	    		},
	    		filename: {
	    			required: true
	    		},
	    		class_id: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    title: {
    		    	required: "请填写资源标题"
	    		},
	    		filename: {
    		    	required: "请填写SEO标题"
	    		},
	    		class_id: {
    		    	required: "请填写资源分类"
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
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m=<?php echo ((is_array($_tmp='download')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost",
						data: data,
						dataType: 'json',
						success: function(msg){

							    if(msg.status == "true")
								    {
										   window.location= '?m=<?php echo ((is_array($_tmp='download')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
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
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['log']['id']; ?>
">
      <div id="tab_general" style="display: block;">
			          <table class="form">
			            <tbody>
			            <tr>
			              <td><span class="required">*</span> 资源标题:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['title']; ?>
" size="100" name="title" id="title">
			                </td>
			            </tr>
			             <tr>
			              <td><span class="required">*</span> SEO标题:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['filename']; ?>
" size="100" name="filename" id="filename">
			                </td>
			            </tr>
			            
			          <!--  <tr>
              <td><span class="required">*</span> 资源分类:</td>
              <td><select name="class_id" id="class_id"><option value="">请选择...</option><?php echo $this->_tpl_vars['catelist']; ?>
</select> <a onclick="#" class="button"><span>添加分类</span></a>
                </td>
            </tr>-->
			            <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="3" cols="40" name="meta_keywords"><?php echo $this->_tpl_vars['log']['meta_keywords']; ?>
</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="3" cols="40" name="meta_description"><?php echo $this->_tpl_vars['log']['meta_description']; ?>
</textarea></td>
			            </tr>
			         
			            
			            
			            <tr>
			              <td> 资源地址:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['url']; ?>
" size="100" name="url" id="url">
			                </td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="description" rows="3" cols="40"><?php echo $this->_tpl_vars['log']['description']; ?>
</textarea></td>
			            </tr>
			            
			           
			            

			            
			                      
				           <tr>
				            <td>资源状态:</td>
				            <td><select name="status">
				                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statuslist'],'selected' => $this->_tpl_vars['log']['status']), $this);?>

				                              </select></td>
				          </tr>
         
				          
        </tbody></table>

      </div>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>

</div>

</div></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>