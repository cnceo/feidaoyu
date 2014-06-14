<?php /* Smarty version 2.6.7, created on 2012-07-25 16:54:43
         compiled from admin/adv_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/adv_add.tpl', 29, false),array('function', 'html_options', 'admin/adv_add.tpl', 77, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
$(document).ready(function(){
 $('.date1').datepicker({dateFormat: 'yy-mm-dd'});
  $("#myForm").validate({
    	rules: {
	    		title: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    title: {
    		    	required: "请填写广告位中文名称"
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
						url:  "?m=<?php echo ((is_array($_tmp='adv')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m=<?php echo ((is_array($_tmp='adv')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
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
			            <!-- <tr>
			            <td>广告编码:</td>
			            <td><input value="<?php echo $this->_tpl_vars['log']['adcode']; ?>
" size="20" name="adcode" id="adcode"></td>
			          </tr>  -->
			            <tr>
			              <td><span class="required">*</span> 广告名称:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['title']; ?>
" size="100" name="title" id="title">
			                </td>
			            </tr>
			           <tr>
			            <td>广告位置:</td>
			            <td><select name="aid">
			                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['adtlist'],'selected' => $this->_tpl_vars['log']['aid']), $this);?>

			                              </select></td>
			          </tr> 
			           <!-- <tr>
			            <td>广告客户:</td>
			            <td><input value="<?php echo $this->_tpl_vars['log']['cid']; ?>
" size="20" name="cid" id="cid"></td>
			          </tr>  -->
			          <tr>
			              <td>开始日期:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['starttime']; ?>
" size="20" name="starttime" id="starttime" class="date1">
			                </td>
			            </tr>
			             <tr>
			              <td>结束日期:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['endtime']; ?>
" size="20" name="endtime" id="endtime" class="date1">
			                </td>
			            </tr>
			            <tr>
			              <td>广告链接:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['link']; ?>
" size="100" name="link" id="link">
			                </td>
			            </tr>
			            <tr>
			              <td>上传广告图片:</td>
			              <td> <img onclick="dotb('<?php echo $this->_tpl_vars['langs']['upload']; ?>
', '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="image" id="preview" alt="" src="<?php if ($this->_tpl_vars['log']['picpath']):  echo @IMG_HOST;  echo $this->_tpl_vars['log']['picpath']; ?>
.100x100.jpg<?php else: ?>./images/no_image-100x100.jpg<?php endif; ?>" title="点击上传图片">
              <input type="hidden" id="picpath" value="<?php echo $this->_tpl_vars['log']['picpath']; ?>
" name="picpath">
			                </td>
			            </tr>
			            <tr>
			              <td>或图片网址:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['imglink']; ?>
" size="100" name="imglink" id="imglink">
			                </td>
			            </tr>
			             <tr>
			              <td>备注:</td>
			              <td><textarea rows="15" cols="80" name="content"><?php echo $this->_tpl_vars['log']['content']; ?>
</textarea>
			                </td>
			            </tr>
			             <tr>
			            <td>状态:</td>
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