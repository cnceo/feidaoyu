<?php /* Smarty version 2.6.7, created on 2012-08-24 15:09:21
         compiled from admin/article_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/article_add.tpl', 44, false),array('function', 'html_options', 'admin/article_add.tpl', 137, false),)), $this); ?>
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
    		    	required: "请填写文章标题"
	    		},
	    		filename: {
    		    	required: "请填写SEO标题"
	    		},
	    		class_id: {
    		    	required: "请填写文章分类"
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
						url:  "?m=<?php echo ((is_array($_tmp='article')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost",
						data: data,
						dataType: 'json',
						success: function(msg){

							    if(msg.status == "true")
								    {
										   window.location= '?m=<?php echo ((is_array($_tmp='article')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
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
			              <td><span class="required">*</span> 文章标题:</td>
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
			            <tr>
              <td><span class="required">*</span> 文章分类:</td>
              <td><select name="class_id" id="class_id"><option value="">请选择...</option><?php echo $this->_tpl_vars['catelist']; ?>
</select> <a onclick="#" class="button"><span>添加分类</span></a>
                </td>
            </tr>
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
			              <td> 作者:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['source']; ?>
" size="100" name="source" id="source">
			                </td>
			            </tr>
			            <tr>
			              <td> 来源:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['author']; ?>
" size="100" name="author" id="author">
			                </td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="description" rows="3" cols="40"><?php echo $this->_tpl_vars['log']['description']; ?>
</textarea></td>
			            </tr>
			             <tr>
			              <td>内容:</td>
			              <td>
			              <div id="textarea2">
                          <a onclick="dotb('批量上传', '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=multiimg&t=tinymce&&input=content&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="button"><img src="js/jquery/swfupload/textarea.png" /></a>
                          <textarea name="content" style="width:100%; height:540px;" class="mceEditor"><?php echo $this->_tpl_vars['log']['content']; ?>
</textarea>
                          </div>
			              </td>
			            </tr>
          <tr>
            <td>主题图片:</td>
            <td valign="top">
              <img onclick="dotb('<?php echo $this->_tpl_vars['langs']['upload']; ?>
', '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="image" id="preview" alt="" src="<?php if ($this->_tpl_vars['log']['picpath']):  echo @IMG_HOST;  echo $this->_tpl_vars['log']['picpath'];  else: ?>./images/no_image-100x100.jpg<?php endif; ?>" title="点击上传图片">
            <input type="hidden" id="picpath" value="<?php echo $this->_tpl_vars['log']['picpath']; ?>
" name="picpath">
              </td>
          </tr>
           <tr>
            <td>文章状态:</td>
            <td><select name="status">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statuslist'],'selected' => $this->_tpl_vars['log']['status']), $this);?>

                              </select></td>
          </tr>
           <tr>
            <td>语言:</td>
            <td><select name="lang">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['langlist'],'selected' => $this->_tpl_vars['log']['lang']), $this);?>

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