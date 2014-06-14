<?php /* Smarty version 2.6.7, created on 2012-09-05 15:12:19
         compiled from admin/category_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/category_add.tpl', 58, false),array('modifier', 'default', 'admin/category_add.tpl', 374, false),array('function', 'html_options', 'admin/category_add.tpl', 280, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script charset="utf-8" src="js/editor/kindeditor-min.js"></script>
<script charset="utf-8" src="js/editor/lang/zh_CN.js"></script>
<script charset="utf-8" src="js/editor/kindeditor-simple.js"></script>
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
    		    	required: "请填写分类中文名称"
	    		},
    		    ename: {
    		    	required: "请填写分类英文名称"
	    		}
    	      },
    	 showErrors:function(errorMap,errorList){
			        $(".warning").css('display','block');
			        $(".warning").html("带*为必填项，共有 " + this.numberOfInvalids() + " 错误，请仔细检查！");
			        this.defaultShowErrors();
			   }
   	 });
   //添加
	$("#add_lock").click(function(){_move()});
	//去掉
	$("#remove_lock").click(function(){_move(1)});

	//添加
	$("#padd_lock").click(function(){_move2()});
	//去掉
	$("#premove_lock").click(function(){_move2(1)});

	//添加
	$("#padd_lock1").click(function(){_move21()});
	//去掉
	$("#premove_lock1").click(function(){_move21(1)});

	//添加
	$("#padd_lock2").click(function(){_move22()});
	//去掉
	$("#premove_lock2").click(function(){_move22(1)});

});

       $.validator.setDefaults({
			 submitHandler: function() {
			 	var data = $("#myForm").formToArray();
			 	show_message();
						$.ajax({
						type: "POST",
						url:  "?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost",
						data: data,
						dataType: 'json',
						success: function(msg){
							    hidden_message();
							    if(msg.status == "true")
								    {
										   window.location= '?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&cateid='+$("#pid").val();
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
function _move(flag){
   if(flag==1){
    s1 = "select1"; s2 = "select2";
   }else{
    s1 = "select2"; s2 = "select1";
   }
   if($("#"+s2+" option:selected").val()){
    object = $("#"+s2+" option:selected");
    $("#"+s1).append($("#"+s2+" option:selected"));
    $("#"+s2+" option:selected").remove();
   }else{
    return false;
   }
   //传值
   var _val = "";
   $("#select2 option").each(function(){
    _val += this.value+",";
   });
   if(_val){
    _val = _val.substr(0,_val.length-1);
   }
    $("#brands").val(_val);
}

function _move2(flag){
   if(flag==1){
    s1 = "select1p"; s2 = "select2p";
   }else{
    s1 = "select2p"; s2 = "select1p";
   }
   if($("#"+s2+" option:selected").val()){
    object = $("#"+s2+" option:selected");
    $("#"+s1).append($("#"+s2+" option:selected"));
    $("#"+s2+" option:selected").remove();
   }else{
    return false;
   }
   //传值
   var _val = "";
   $("#select2p option").each(function(){
    _val += this.value+",";
   });
   if(_val){
    _val = _val.substr(0,_val.length-1);
   }
    $("#parameters").val(_val);
}

function _move21(flag){
   if(flag==1){
    s1 = "select1p1"; s2 = "select2p1";
   }else{
    s1 = "select2p1"; s2 = "select1p1";
   }
   if($("#"+s2+" option:selected").val()){
    object = $("#"+s2+" option:selected");
    $("#"+s1).append($("#"+s2+" option:selected"));
    $("#"+s2+" option:selected").remove();
   }else{
    return false;
   }
   //传值
   var _val = "";
   $("#select2p1 option").each(function(){
    _val += this.value+",";
   });
   if(_val){
    _val = _val.substr(0,_val.length-1);
   }
    $("#parameters1").val(_val);
}

function _move22(flag){
   if(flag==1){
    s1 = "select1p2"; s2 = "select2p2";
   }else{
    s1 = "select2p2"; s2 = "select1p2";
   }
   if($("#"+s2+" option:selected").val()){
    object = $("#"+s2+" option:selected");
    $("#"+s1).append($("#"+s2+" option:selected"));
    $("#"+s2+" option:selected").remove();
   }else{
    return false;
   }
   //传值
   var _val = "";
   $("#select2p2 option").each(function(){
    _val += this.value+",";
   });
   if(_val){
    _val = _val.substr(0,_val.length-1);
   }
    $("#parameters2").val(_val);
}

function searchp(id,keyname)
{
   	var keytext = $("#"+keyname).val();
	if(keytext)
	{
		$("#"+id).load("?m=<?php echo ((is_array($_tmp='parameter')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=slist&keyword="+keytext);
	}
	else
	{
		alert("请输入关键词");return false;
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
    <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a><a href="?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&pid=<?php echo $this->_tpl_vars['log']['pid']; ?>
" class="button"><span>返回上级分类</span></a></div>

  </div>
  <div class="content">
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a><!-- <a tab="#tab_brand" class="selected">品牌</a> --><!-- <a tab="#tab_parameter" class="selected">参数</a> --><a tab="#tab_data" class="">其他</a></div>
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['log']['id']; ?>
">
	<!-- <input type="hidden" name="brands" id="brands" value="<?php echo $this->_tpl_vars['log']['brands']; ?>
"> -->
<!-- 	<input type="hidden" name="parameters" id="parameters" value="<?php echo $this->_tpl_vars['log']['parameters']; ?>
">
	<input type="hidden" name="parameters1" id="parameters1" value="<?php echo $this->_tpl_vars['log']['parameters1']; ?>
">
	<input type="hidden" name="parameters2" id="parameters2" value="<?php echo $this->_tpl_vars['log']['parameters2']; ?>
"> -->
      <div id="tab_general" style="display: block;">
        <div class="htabs" id="languages">
                    <a tab="#language1" class="selected"><img src="./images/flags/cn.png" title="中文" /> 中文</a>
                   <a tab="#language2"><img src="./images/flags/gb.png" title="英文" /> 英文</a>
                   <!--  <a tab="#language3"><img src="./images/flags/jp.png" title="日文" /> 日文</a>-->
		          </div>
                <div id="language1" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 分类名称:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['cname']; ?>
" size="100" name="cname" id="cname">
			                </td>
			            </tr>
			            <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="5" cols="40" name="cmeta_keywords"><?php echo $this->_tpl_vars['log']['cmeta_keywords']; ?>
</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="5" cols="40" name="cmeta_description"><?php echo $this->_tpl_vars['log']['cmeta_description']; ?>
</textarea></td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="cdescription" style="width:60%" class="mceEditor"><?php echo $this->_tpl_vars['log']['cdescription']; ?>
</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>
		        <div id="language2" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 分类名称:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['ename']; ?>
" size="100" name="ename" id="ename">
			                </td>
			            </tr>
			            <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="5" cols="40" name="emeta_keywords"><?php echo $this->_tpl_vars['log']['emeta_keywords']; ?>
</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="5" cols="40" name="emeta_description"><?php echo $this->_tpl_vars['log']['emeta_description']; ?>
</textarea></td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="edescription"  style="width:60%" class="mceEditor"><?php echo $this->_tpl_vars['log']['edescription']; ?>
</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>
		        <!--<div id="language3" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 分类名称:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['jname']; ?>
" size="100" name="jname" id="jname">
			                </td>
			            </tr>
			            <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="5" cols="40" name="jmeta_keywords"><?php echo $this->_tpl_vars['log']['jmeta_keywords']; ?>
</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="5" cols="40" name="jmeta_description"><?php echo $this->_tpl_vars['log']['jmeta_description']; ?>
</textarea></td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="jdescription" style="width:60%" class="mceEditor"><?php echo $this->_tpl_vars['log']['jdescription']; ?>
</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>-->
		        </div>

      <div id="tab_brand" style="display: none;">
      <table class="form">
          <tbody><tr>
            <td align="right">
            <select id="select1" size="10" style="width:200px;">
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['brandlist']), $this);?>

			</select>
			</td>
            <td align="center"><input type="button" value=">>" id="add_lock"><br/>
				<input type="button" value="<<" id="remove_lock"></td>
            <td align="left">
            <select id="select2" size="10" style="width:200px;">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['selectbrandlist']), $this);?>

			</select>
            </td>
          </tr>
        </tbody></table>
		      </div>
<!-- 		 <div id="tab_parameter" style="display: none;">
      <table class="form">
          <tbody><tr>
            <td align="right">
            <input type="text" id="keyword1" size="10">
            <input type="button" value="搜索" onclick="searchp('select1p','keyword1')">
            <input type="button" value="新加参数" onclick="dotb('新加参数', '?m=<?php echo ((is_array($_tmp='parameter')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=poplist&cateid=<?php echo $this->_tpl_vars['log']['id']; ?>
&keyname=select2p&textname=parameters&a=add&view=small&keepThis=true&TB_iframe=false&height=522&width=1000');return false;">
            <input type="button" value="参数管理" onclick="dotb('参数管理', '?m=<?php echo ((is_array($_tmp='parameter')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=poplist&cateid=<?php echo $this->_tpl_vars['log']['id']; ?>
&keyname=select2p&textname=parameters&keepThis=true&TB_iframe=false&height=522&width=1000');return false;"><br>
            <select id="select1p" size="10" style="width:200px;">
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['parameterlist']), $this);?>

			</select>
			</td>
            <td align="center"><input type="button" value=">>" id="padd_lock"><br/>
				<input type="button" value="<<" id="premove_lock"></td>
            <td align="left">重要特征
            <select id="select2p" size="10" style="width:200px;">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['selectparameterlist']), $this);?>

			</select>
            </td>
          </tr>

          <tr>
            <td align="right">
            <input type="text" id="keyword2" size="10">
            <input type="button" value="搜索" onclick="searchp('select1p1','keyword2')">
            <input type="button" value="新加参数" onclick="dotb('新加参数', '?m=<?php echo ((is_array($_tmp='parameter')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=poplist&cateid=<?php echo $this->_tpl_vars['log']['id']; ?>
&keyname=select2p1&textname=parameters1&a=add&view=small&keepThis=true&TB_iframe=false&height=522&width=1000');return false;">
            <input type="button" value="参数管理" onclick="dotb('参数管理', '?m=<?php echo ((is_array($_tmp='parameter')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=poplist&cateid=<?php echo $this->_tpl_vars['log']['id']; ?>
&keyname=select2p1&textname=parameters1&keepThis=true&TB_iframe=false&height=522&width=1000');return false;"><br>
            <select id="select1p1" size="10" style="width:200px;">
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['parameterlist']), $this);?>

			</select>
			</td>
            <td align="center"><input type="button" value=">>" id="padd_lock1"><br/>
				<input type="button" value="<<" id="premove_lock1"></td>
            <td align="left">常规参数
            <select id="select2p1" size="10" style="width:200px;">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['selectparameter1list']), $this);?>

			</select>
            </td>
          </tr>

          <tr>
            <td align="right">
            <input type="text" id="keyword3" size="10">
            <input type="button" value="搜索" onclick="searchp('select1p2','keyword3')">
            <input type="button" value="新加参数" onclick="dotb('新加参数', '?m=<?php echo ((is_array($_tmp='parameter')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=poplist&cateid=<?php echo $this->_tpl_vars['log']['id']; ?>
&keyname=select2p2&textname=parameters2&a=add&view=small&keepThis=true&TB_iframe=false&height=522&width=1000');return false;">
            <input type="button" value="参数管理" onclick="dotb('参数管理', '?m=<?php echo ((is_array($_tmp='parameter')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=poplist&cateid=<?php echo $this->_tpl_vars['log']['id']; ?>
&keyname=select2p2&&textname=parameters2keepThis=true&TB_iframe=false&height=522&width=1000');return false;"><br>
            <select id="select1p2" size="10" style="width:200px;">
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['parameterlist']), $this);?>

			</select>
			</td>
            <td align="center"><input type="button" value=">>" id="padd_lock2"><br/>
				<input type="button" value="<<" id="premove_lock2"></td>
            <td align="left">基本参数
            <select id="select2p2" size="10" style="width:200px;">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['selectparameter2list']), $this);?>

			</select>
            </td>
          </tr>
        </tbody></table>
	  </div> -->
      <div id="tab_data" style="display: none;">
        <table class="form">
          <tbody><tr>
            <td>父级分类:</td>
            <td><select name="pid" id="pid"><option value="0">|顶级分类</option><?php echo $this->_tpl_vars['plist']; ?>
</select></td>
          </tr>
          <tr>
            <td>图片:</td>
            <td valign="top">
            <input type="hidden" id="picname" value="" name="picname">
            <input type="hidden" id="picpath" value="" name="picpath">
              <img onclick="dotb('参数管理', '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="image" id="preview" alt="" src="./images/no_image-100x100.jpg"></td>
          </tr>
		  <tr>
            <td>分类状态:</td>
            <td><select name="status">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statuslist'],'selected' => $this->_tpl_vars['log']['status']), $this);?>

                              </select></td>
          </tr>
          <tr>
            <td>排序:</td>
            <td><input size="1" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['log']['sequence'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
" name="sequence"></td>
          </tr>
        </tbody></table>
      </div>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a><a href="?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&pid=<?php echo $this->_tpl_vars['log']['pid']; ?>
" class="button"><span>返回上级分类</span></a>
      <div style="clear:both"></div>
     </div>
  </div>

</div>

<style>

.buttons .button{ float:right}
</style>

<script type="text/javascript">
$.tabs('#tabs a');
$.tabs('#languages a');
</script>

</div></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>