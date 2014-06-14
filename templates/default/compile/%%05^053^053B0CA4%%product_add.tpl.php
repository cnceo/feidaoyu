<?php /* Smarty version 2.6.7, created on 2012-09-20 11:05:08
         compiled from admin/product_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/product_add.tpl', 61, false),array('modifier', 'default', 'admin/product_add.tpl', 239, false),array('function', 'html_options', 'admin/product_add.tpl', 194, false),array('function', 'html_checkboxes', 'admin/product_add.tpl', 266, false),)), $this); ?>
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

  $(".ckinput").click(function()
   {
     $(this).each(function(){
	    if($(this).attr("checked"))
	    {
	     	$("#"+this.id+"t").hide();
	    	$(this).after("<input id='"+this.id+"i' name='parameter["+this.id+"]' type='text' value='"+this.title+"'>");

	    }
	    else
	    {
	     	$("#"+this.id+"i").remove();
	     	$("#"+this.id+"t").show();
	    }
	 });
 });
  $('.date1').datetimepicker({dateFormat: 'yy-mm-dd'});
  $.validator.addMethod("money", function(value, element) {
         return this.optional(element) || /^(\d{1,5})(\.\d{2})$/.test(value);
     }, "请输入正确的货币格式 0.99");
  $("#myForm").validate({
    	rules: {
	    		cprodname: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    cprodname: {
    		    	required: "请填写商品中文名称"
	    		}
    	      },
		showErrors:function(errorMap,errorList){
			        $(".warning").css('display','block');
			        $(".warning").html("带*为必填项，共有 " + this.numberOfInvalids() + " 错误，请仔细检查！");
			        this.defaultShowErrors();
			   }

   	 });

   	$('#catesbtn').toggle(function(){
   		Show('glabel');
			},function(){
		Hide('glabel');
			});
    Hide('glabel');
});

       $.validator.setDefaults({
			 submitHandler: function() {
			 	show_message();
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m=<?php echo ((is_array($_tmp='product')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost",
						data: data,
						dataType: 'json',
						success: function(msg){
							    hidden_message();
							     if(msg.status == "true")
								    {
										   //window.location= '?m=<?php echo ((is_array($_tmp='product')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&cateid='+$("#class_id").val();;
										   window.location= '<?php echo $_SERVER['HTTP_REFERER']; ?>
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

  function searchp(id,keyname)
	{
	   	var keytext = $("#"+keyname).val();
		if(keytext)
		{
			$("#"+id).load("?m=<?php echo ((is_array($_tmp='brand')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=slist&keyword="+keytext);
		}
		else
		{
			alert("请输入关键词");return false;
		}

	}

</script>

<style>
.product-add-color li{  float:left; height:26px; list-style:none; padding-right:10px; width:100px}
.product-add-color li input{ float:left; width:60px}
.product-add-color li input.ckinput{ width:13px; height:13px; margin-right:5px;}
.product-add-color li label{height:12px; display:block; float:left; line-height:12px; width:12px; border:#EFEFEF  solid 1px}
.product-add-color li label#color_000000_黑色t{ color:#ccc}
.product-add-color li label.mc{ border:0; width:auto}

</style>

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
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a><a tab="#tab_data" class="">其他</a><a tab="#tab_vals" class="">技术参数</a><a tab="#tab_image" class="">图片</a></div>
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['log']['id']; ?>
">
      <div id="tab_general" style="display: block;">
        <div class="htabs" id="languages">
                    <a tab="#language1" class="selected"><img src="./images/flags/cn.png" title="中文" /> 中文</a>
                   <!-- <a tab="#language2"><img src="./images/flags/gb.png" title="英文" /> 英文</a>
                    <a tab="#language3"><img src="./images/flags/jp.png" title="日文" /> 日文</a>-->
		          </div>
                <div id="language1" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 商品名称:</td>
			              <td><input value="<?php echo $this->_tpl_vars['log']['cprodname']; ?>
" size="100" name="cprodname" id="cprodname">
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
			              <td>主要特点:</td>
			              <td><textarea rows="5" cols="40" name="cdescription"><?php echo $this->_tpl_vars['log']['cdescription']; ?>
</textarea></td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td>
			              <div id="textarea2">
                          <a onclick="dotb('批量上传', '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=multiimg&t=tinymce&&input=cdescription&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="button"><img src="js/jquery/swfupload/textarea.png" /></a>
                          <textarea name="content" style="width:100%; height:540px;" class="mceEditor"><?php echo $this->_tpl_vars['log']['content']; ?>
</textarea>
                          </div> </td>
			            </tr>
			           <!--   <tr>
		              <td> 源网址:</td>
		              <td><input value="<?php echo $this->_tpl_vars['log']['sourceurl']; ?>
" size="80" name="sourceurl" id="sourceurl">  例如:http://www.instrument.com.cn/netshow/C12218.htm
		                </td>
		            </tr> -->
			          </tbody></table>
		        </div>
		      </div>
      <div id="tab_data" style="display: none;">
        <table class="form">
          <tbody>
         <!-- <tr>
              <td width="150">SKU:</td>
              <td><input value="<?php echo $this->_tpl_vars['log']['sku']; ?>
" size="30" name="sku" id="sku">
                </td>
            </tr>-->
            <tr>
              <td width="150">型号:</td>
              <td><input value="<?php echo $this->_tpl_vars['log']['model']; ?>
" size="30" name="model" id="model">
                </td>
            </tr>
             <tr>
              <td>商品分类:</td>
              <td><select name="class_id" id="class_id"><option value="">请选择...</option><?php echo $this->_tpl_vars['catelist']; ?>
</select> <!--<a onclick="dotb('新加分类', '?m=<?php echo ((is_array($_tmp='parameter')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=poplist&cateid=<?php echo $this->_tpl_vars['log']['id']; ?>
&keyname=select2p&textname=parameters&a=add&view=small&keepThis=true&TB_iframe=false&height=522&width=1000');return false;" class="button"><span>添加分类</span></a> <a id="catesbtn" class="button"><span>扩展分类</span></a>-->
                </td>
            </tr>
           <!--  <tr id="glabel">
              <td> 扩展分类:</td>
          <td>
          <select name="class_ids[]"><option value="">请选择...</option><?php echo $this->_tpl_vars['catelist']; ?>
</select>
          <select name="class_ids[]"><option value="">请选择...</option><?php echo $this->_tpl_vars['catelist']; ?>
</select>
          <select name="class_ids[]"><option value="">请选择...</option><?php echo $this->_tpl_vars['catelist']; ?>
</select>
          <select name="class_ids[]"><option value="">请选择...</option><?php echo $this->_tpl_vars['catelist']; ?>
</select>
           </td>
			 </tr>-->
           <!--   <tr>
              <td> 商品品牌:</td>
              <td>
               <input type="text" id="keyword1" size="10"><input type="button" value="搜索" onclick="searchp('brand_id','keyword1')"><br/>
              <select name="brand_id" id="brand_id"><option value="">请选择...</option> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['brandlist'],'selected' => $this->_tpl_vars['log']['brand_id']), $this);?>
</select> <a onclick="dotb('新加品牌', '?m=<?php echo ((is_array($_tmp='brand')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=poplist&keyname=brand_id&a=add&view=small&keepThis=true&TB_iframe=false&height=522&width=1000');return false;" class="button"><span>添加品牌</span></a>
                </td>
            </tr> -->
            <tr>
              <td>价格:</td>
              <td><input value="<?php echo $this->_tpl_vars['log']['price']; ?>
" size="20" name="price" id="price">
                </td>
            </tr>
                        <tr>
              <td>操作系统:</td>
              <td><input value="<?php echo $this->_tpl_vars['log']['sys']; ?>
" size="20" name="sys" id="sys">
                </td>
            </tr>
             <tr>
              <td>支持语言:</td>
              <td><input value="<?php echo $this->_tpl_vars['log']['lan']; ?>
" size="20" name="lan" id="lan">
                </td>
            </tr>
               <tr>
              <td>数据库:</td>
              <td><input value="<?php echo $this->_tpl_vars['log']['db']; ?>
" size="20" name="db" id="db">
                </td>
            </tr>
                           <tr>
              <td>空间大小:</td>
              <td><input value="<?php echo $this->_tpl_vars['log']['host']; ?>
" size="20" name="host" id="host">
                </td>
            </tr>
                                       <tr>
              <td>流量:</td>
              <td><input value="<?php echo $this->_tpl_vars['log']['rate']; ?>
" size="20" name="rate" id="rate">
                </td>
            </tr>
          <!--   <tr>
              <td>市场指导价格:</td>
              <td><input value="<?php echo $this->_tpl_vars['log']['mkprice']; ?>
" size="20" name="mkprice" id="mkprice">
                </td>
            </tr> -->
             <!--   <tr>
              <td>商品重量:</td>
              <td><input value="<?php echo $this->_tpl_vars['log']['weight']; ?>
" size="15" name="weight" id="weight"><select name="weight_unit"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['unitlist'],'selected' => $this->_tpl_vars['log']['weight_unit']), $this);?>
</select>
                </td>
            </tr> -->
             <!--  <tr>
              <td>商品库存数量:</td>
              <td><input value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['log']['quantity'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
" size="20" name="quantity" id="quantity">
                </td>
            </tr> --><!--
            <tr>
              <td>颜色:</td>
              <td><ul class="product-add-color"><?php if (count($_from = (array)$this->_tpl_vars['langs']['colors'])):
    foreach ($_from as $this->_tpl_vars['data']):
?><li><input  type="checkbox" id='color_<?php echo $this->_tpl_vars['data']['color']; ?>
_<?php echo $this->_tpl_vars['data']['name']; ?>
' class="ckinput" title="<?php echo $this->_tpl_vars['data']['name']; ?>
"  <?php if ($this->_tpl_vars['data']['parakey']): ?>checked> <input id="color_<?php echo $this->_tpl_vars['data']['color']; ?>
_<?php echo $this->_tpl_vars['data']['name']; ?>
i" name="parameter[color_<?php echo $this->_tpl_vars['data']['color']; ?>
_<?php echo $this->_tpl_vars['data']['name']; ?>
] type="text" value="<?php echo $this->_tpl_vars['data']['name']; ?>
"><?php else: ?>><?php endif; ?><label id='color_<?php echo $this->_tpl_vars['data']['color']; ?>
_<?php echo $this->_tpl_vars['data']['name']; ?>
t' style="background: none repeat scroll 0 0 #<?php echo $this->_tpl_vars['data']['color']; ?>
; <?php if ($this->_tpl_vars['data']['parakey']): ?>display: none;<?php endif; ?>" title="<?php echo $this->_tpl_vars['data']['name']; ?>
"></label></li><?php endforeach; endif; unset($_from); ?></ul></td>
            </tr>
            <tr>
              <td>尺码:</td>
              <td><ul class="product-add-color"><?php if (count($_from = (array)$this->_tpl_vars['langs']['sizes'])):
    foreach ($_from as $this->_tpl_vars['data']):
?><li> <input type="checkbox"  id="size_<?php echo $this->_tpl_vars['data']['size']; ?>
_<?php echo $this->_tpl_vars['data']['name']; ?>
" class="ckinput" title="<?php echo $this->_tpl_vars['data']['name']; ?>
" <?php if ($this->_tpl_vars['data']['parakey']): ?>checked> <input id="size_<?php echo $this->_tpl_vars['data']['size']; ?>
_<?php echo $this->_tpl_vars['data']['name']; ?>
i" name="parameter[size_<?php echo $this->_tpl_vars['data']['size']; ?>
_<?php echo $this->_tpl_vars['data']['name']; ?>
] type="text" value="<?php echo $this->_tpl_vars['data']['name']; ?>
"><?php else: ?>><?php endif; ?><label class="mc" id='size_<?php echo $this->_tpl_vars['data']['size']; ?>
_<?php echo $this->_tpl_vars['data']['name']; ?>
t' <?php if ($this->_tpl_vars['data']['parakey']): ?>style="display: none;"<?php endif; ?>><?php echo $this->_tpl_vars['data']['name']; ?>
</label></li><?php endforeach; endif; unset($_from); ?></ul></td>
            </tr>
            <tr>
              <td> 库存警告数量:</td>
              <td><input value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['log']['warn_quantity'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
" size="20" name="warn_quantity" id="warn_quantity">
                </td>
            </tr>
              <tr>
              <td>赠送积分:</td>
              <td><input value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['log']['give_integral'])) ? $this->_run_mod_handler('default', true, $_tmp, '-1') : smarty_modifier_default($_tmp, '-1')); ?>
" size="30" name="give_integral" id="give_integral"><br>购买该商品时赠送消费积分数,-1表示按商品价格赠送
                </td>
            </tr>
            <tr>
            <td>加入推荐：</td>
            <td><input name="is_best" value="1" type="checkbox" <?php if ($this->_tpl_vars['log']['is_best'] == '1'): ?>checked<?php endif; ?>>精品 <input name="is_new" value="1" type="checkbox" <?php if ($this->_tpl_vars['log']['is_new'] == '1'): ?>checked<?php endif; ?>>新品 <input name="is_hot" value="1" type="checkbox" <?php if ($this->_tpl_vars['log']['is_hot'] == '1'): ?>checked<?php endif; ?>>热销</td>
          </tr>-->
         <!--  <tr>
            <td class="label">商品类型：</td>
            <td><?php echo smarty_function_html_checkboxes(array('name' => 'ptype','options' => $this->_tpl_vars['typelist'],'checked' => $this->_tpl_vars['ptype']), $this);?>
</td>
          </tr> -->
          <tr>
            <td>商品状态:</td>
            <td><select name="status">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statuslist'],'selected' => $this->_tpl_vars['log']['status']), $this);?>

                              </select></td>
          </tr>
        </tbody></table>
      </div>

            <div id="tab_vals">
        <table id="vals" class="list">
          <thead>
            <tr>
              <td class="left">参数名称:</td>
              <td class="left">参数值:</td>
              <td></td>
            </tr>
          </thead>
          <?php unset($this->_sections['data1']);
$this->_sections['data1']['name'] = 'data1';
$this->_sections['data1']['loop'] = is_array($_loop=$this->_tpl_vars['valslists']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['data1']['show'] = true;
$this->_sections['data1']['max'] = $this->_sections['data1']['loop'];
$this->_sections['data1']['step'] = 1;
$this->_sections['data1']['start'] = $this->_sections['data1']['step'] > 0 ? 0 : $this->_sections['data1']['loop']-1;
if ($this->_sections['data1']['show']) {
    $this->_sections['data1']['total'] = $this->_sections['data1']['loop'];
    if ($this->_sections['data1']['total'] == 0)
        $this->_sections['data1']['show'] = false;
} else
    $this->_sections['data1']['total'] = 0;
if ($this->_sections['data1']['show']):

            for ($this->_sections['data1']['index'] = $this->_sections['data1']['start'], $this->_sections['data1']['iteration'] = 1;
                 $this->_sections['data1']['iteration'] <= $this->_sections['data1']['total'];
                 $this->_sections['data1']['index'] += $this->_sections['data1']['step'], $this->_sections['data1']['iteration']++):
$this->_sections['data1']['rownum'] = $this->_sections['data1']['iteration'];
$this->_sections['data1']['index_prev'] = $this->_sections['data1']['index'] - $this->_sections['data1']['step'];
$this->_sections['data1']['index_next'] = $this->_sections['data1']['index'] + $this->_sections['data1']['step'];
$this->_sections['data1']['first']      = ($this->_sections['data1']['iteration'] == 1);
$this->_sections['data1']['last']       = ($this->_sections['data1']['iteration'] == $this->_sections['data1']['total']);
?>
          <tbody id="vals_row<?php echo $this->_sections['data1']['index']; ?>
">
            <tr style="background-color:<?php echo $this->_tpl_vars['valslists'][$this->_sections['data1']['index']]['color']; ?>
">
              <td class="left"><input type="text" name="product_vals[<?php echo $this->_sections['data1']['index']; ?>
][name]" value="<?php echo $this->_tpl_vars['valslists'][$this->_sections['data1']['index']]['name']; ?>
" size="50" /></td>
              <td class="left"><input type="text" name="product_vals[<?php echo $this->_sections['data1']['index']; ?>
][pvals]" value="<?php echo $this->_tpl_vars['valslists'][$this->_sections['data1']['index']]['val']; ?>
" size="50" /></td>
              <td class="left"><?php if ($this->_tpl_vars['valslists'][$this->_sections['data1']['index']]['color'] == ""): ?><a onclick="$('#vals_row<?php echo $this->_sections['data1']['index']; ?>
').remove();" class="button"><span>删除</span></a><?php endif; ?></td>
            </tr>
          </tbody>
          <?php endfor; endif; ?>
           <tfoot>

            <tr>
              <td colspan="2"></td>
              <td class="left"><a onclick="addvals();" class="button"><span>添加新参数</span></a></td>
            </tr>
          </tfoot>
        </table>
      </div>

       <div id="tab_image" style="display: none;">
        <table class="form">
          <tbody><tr>
            <td>主题图片:</td>
            <td valign="top">
              <img onclick="dotb('<?php echo $this->_tpl_vars['langs']['upload']; ?>
', '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="image" id="preview" alt="" src="<?php if ($this->_tpl_vars['log']['picpath']):  echo @IMG_HOST;  echo $this->_tpl_vars['log']['picpath']; ?>
.100x100.jpg<?php else: ?>./images/no_image-100x100.jpg<?php endif; ?>" title="点击上传图片">
              <input type="hidden" id="picpath" value="<?php echo $this->_tpl_vars['log']['picpath']; ?>
" name="picpath">
              </td>
          </tr>



<style>
.img_mc img{  padding:2px; border:#E3E3E3 solid 1px}
.img_mc{ padding:0px 10px 10px 0px;float:left; height:120px; overflow:hidden;}
.img_mc p{ height:18px; text-align:right; padding-top:3px; background:url(./images/3erd-2.gif) no-repeat 70px 6px}
.img_mc p a{ padding-left:15px; color:#B5B4B4; text-decoration:none}
</style>








          <tr>
            <td>商品图片:</td>
            <td valign="top" id="piclist">
            <?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['images']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['data']['show'] = true;
$this->_sections['data']['max'] = $this->_sections['data']['loop'];
$this->_sections['data']['step'] = 1;
$this->_sections['data']['start'] = $this->_sections['data']['step'] > 0 ? 0 : $this->_sections['data']['loop']-1;
if ($this->_sections['data']['show']) {
    $this->_sections['data']['total'] = $this->_sections['data']['loop'];
    if ($this->_sections['data']['total'] == 0)
        $this->_sections['data']['show'] = false;
} else
    $this->_sections['data']['total'] = 0;
if ($this->_sections['data']['show']):

            for ($this->_sections['data']['index'] = $this->_sections['data']['start'], $this->_sections['data']['iteration'] = 1;
                 $this->_sections['data']['iteration'] <= $this->_sections['data']['total'];
                 $this->_sections['data']['index'] += $this->_sections['data']['step'], $this->_sections['data']['iteration']++):
$this->_sections['data']['rownum'] = $this->_sections['data']['iteration'];
$this->_sections['data']['index_prev'] = $this->_sections['data']['index'] - $this->_sections['data']['step'];
$this->_sections['data']['index_next'] = $this->_sections['data']['index'] + $this->_sections['data']['step'];
$this->_sections['data']['first']      = ($this->_sections['data']['iteration'] == 1);
$this->_sections['data']['last']       = ($this->_sections['data']['iteration'] == $this->_sections['data']['total']);
?>
            <div class="img_mc">
            	<img onclick="dotb('上传', '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=crop&fileurl=<?php echo $this->_tpl_vars['images'][$this->_sections['data']['index']]['attachment']; ?>
&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="image" id="preview" alt="" src="<?php echo @IMG_HOST;  echo $this->_tpl_vars['images'][$this->_sections['data']['index']]['attachment']; ?>
" height="100" title="点击替换主题图片"/>
            	<input name="aid[]" type="hidden" value="<?php echo $this->_tpl_vars['images'][$this->_sections['data']['index']]['id']; ?>
"/><p><a href="#" onclick="$(this).parent().parent().remove();">删除</a></p>
            </div>
            <?php endfor; endif; ?>

              </td>
          </tr>

          <tr>
            <td>商品图册:</td>
            <td><a onclick="dotb('批量上传', '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=multiimg&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="button"><span>批量上传</span></a></td>
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
<script type="text/javascript"><!--
var vals_row = <?php echo ((is_array($_tmp=@$this->_sections['data1']['index'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
;

function addvals() {
	html  = '<tbody id="vals_row' + vals_row + '">';
	html += '<tr>';
    html += '<td class="left"><input type="text" name="product_vals[' + vals_row + '][name]" value="" size="50" /></td>';
    html += '<td class="left"><input type="text" name="product_vals[' + vals_row + '][pvals]" value="" size="50" /></td>';
	html += '<td class="left"><a onclick="$(\'#vals_row' + vals_row + '\').remove();" class="button"><span>删除</span></a></td>';
	html += '</tr>';
    html += '</tbody>';
	$('#vals tfoot').before(html);
	vals_row++;
}
//--></script>
</div></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>