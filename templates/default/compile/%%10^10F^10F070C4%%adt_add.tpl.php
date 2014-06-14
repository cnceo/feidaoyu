<?php /* Smarty version 2.6.7, created on 2012-07-25 16:27:07
         compiled from admin/adt_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/adt_add.tpl', 41, false),array('function', 'html_options', 'admin/adt_add.tpl', 166, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
$(document).ready(function(){
   jQuery.validator.addMethod("stringCheck", function(value, element) {
	return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
	}, "只能包括中文字、英文字母、数字和下划线"); 

  $("#myForm").validate({
    	rules: {
	    		title: {
	    			required: true
	    		},
	    		tagname:{
	    			required: true,
	    			stringCheck: true,
	    			rangelength:[5,10]
	    		}
    	      },
    	 messages: {
    		    title: {
    		    	required: "请填写广告位中文名称"
	    		},
	    		tagname: {
    		    	required: "请填写广告位标签名称",
    		    	rangelength:"输入长度必须介于 5 和 10 之间的字符串"
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
						url:  "?m=<?php echo ((is_array($_tmp='adt')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m=<?php echo ((is_array($_tmp='adt')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
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
		
		function addTag(str)
		{
			var tc = document.getElementById("content1");
		    var tclen = tc.value.length;
		    tc.focus();
		    if(typeof document.selection != "undefined")
		    {
		        document.selection.createRange().text = "[[" + str + "]]";  
		    }
		    else
		    {
		        tc.value = tc.value.substr(0,tc.selectionStart)+"[[" + str + "]]"+tc.value.substring(tc.selectionStart,tclen);
		    }
		}
		function copytag()
		{
			var ab = $("#tagname").val();
			copyToClipboard("{"+"{$ads."+ab+"}}");
		}
	  function copyToClipboard(txt) {   
      if(window.clipboardData) {   
              window.clipboardData.clearData();   
              window.clipboardData.setData("Text", txt);   
      } else if(navigator.userAgent.indexOf("Opera") != -1) {   
           window.location = txt;   
      } else if (window.netscape) {   
           try {   
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");   
           } catch (e) {   
                alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");   
           }   
           var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);   
           if (!clip)   
                return;   
           var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);   
           if (!trans)   
                return;   
           trans.addDataFlavor('text/unicode');   
           var str = new Object();   
           var len = new Object();   
           var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);   
           var copytext = txt;   
           str.data = copytext;   
           trans.setTransferData("text/unicode",str,copytext.length*2);   
           var clipid = Components.interfaces.nsIClipboard;   
           if (!clip)   
                return false;   
           clip.setData(trans,null,clipid.kGlobalClipboard);   
           alert("复制成功！")   
      }   
 } 

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
			            <tbody><tr>
			              <td><span class="required">*</span> 广告位名称:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['title']; ?>
" size="100" name="title" id="title">
			                </td>
			            </tr>
			            <tr>
			              <td><span class="required">*</span> 标签:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['tagname']; ?>
" size="20" name="tagname" id="tagname" <?php if ($this->_tpl_vars['log']['tagname']): ?>disabled<?php endif; ?>> <a href="#" onclick="copytag();">复制</a>
			                </td>
			            </tr>
			          <tr>
			              <td>广告位宽度:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['width']; ?>
" size="20" name="width" id="width"> 像素
			                </td>
			            </tr>
			             <tr>
			              <td>广告位高度:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['height']; ?>
" size="20" name="height" id="height"> 像素
			                </td>
			            </tr>
			            <tr>
			              <td>广告位描述:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['description']; ?>
" size="100" name="description" id="description">
			                </td>
			            </tr>
			            <tr>
				          <td>默认链接</td>
				          <td >[<a href="#" onclick="addTag('link')">广告链接</a>][<a href="#" onclick="addTag('file')">广告文件</a>][<a href="#" onclick="addTag('title')">广告注释</a>]</td>
					 </tr>
			            <tr>
			              <td>广告位模板:</td>
			              <td><textarea rows="15" cols="80" name="content" id="content1"><?php echo $this->_tpl_vars['log']['content']; ?>
</textarea>
			                </td>
			            </tr>
			             <tr>
			            <td>语言:</td>
			            <td><select name="lang">
			                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['langlist'],'selected' => $this->_tpl_vars['log']['lang']), $this);?>

			                              </select></td>
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