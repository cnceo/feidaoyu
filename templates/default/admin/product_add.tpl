{{include file=admin/header.tpl}}
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
						url:  "?m={{'product'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json',
						success: function(msg){
							    hidden_message();
							     if(msg.status == "true")
								    {
										   //window.location= '?m={{'product'|encrypt}}&cateid='+$("#class_id").val();;
										   window.location= '{{$smarty.server.HTTP_REFERER}}';
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
			$("#"+id).load("?m={{'brand'|encrypt}}&a=slist&keyword="+keytext);
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
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('./images/payment.png');">{{if $log.id==""}}添加{{else}}修改{{/if}}{{$sites.title}}</h1>
    <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>

  </div>
  <div class="content">
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a><a tab="#tab_data" class="">其他</a><a tab="#tab_vals" class="">技术参数</a><a tab="#tab_image" class="">图片</a></div>
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
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
			              <td><input value="{{$log.cprodname}}" size="100" name="cprodname" id="cprodname">
			                </td>
			            </tr>
			           <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="5" cols="40" name="cmeta_keywords">{{$log.cmeta_keywords}}</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="5" cols="40" name="cmeta_description">{{$log.cmeta_description}}</textarea></td>
			            </tr>
			              <tr>
			              <td>主要特点:</td>
			              <td><textarea rows="5" cols="40" name="cdescription">{{$log.cdescription}}</textarea></td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td>
			              <div id="textarea2">
                          <a onclick="dotb('批量上传', '?m={{'upload'|encrypt}}&a=multiimg&t=tinymce&&input=cdescription&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="button"><img src="js/jquery/swfupload/textarea.png" /></a>
                          <textarea name="content" style="width:100%; height:540px;" class="mceEditor">{{$log.content}}</textarea>
                          </div> </td>
			            </tr>
			           <!--   <tr>
		              <td> 源网址:</td>
		              <td><input value="{{$log.sourceurl}}" size="80" name="sourceurl" id="sourceurl">  例如:http://www.instrument.com.cn/netshow/C12218.htm
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
              <td><input value="{{$log.sku}}" size="30" name="sku" id="sku">
                </td>
            </tr>-->
            <tr>
              <td width="150">型号:</td>
              <td><input value="{{$log.model}}" size="30" name="model" id="model">
                </td>
            </tr>
             <tr>
              <td>商品分类:</td>
              <td><select name="class_id" id="class_id"><option value="">请选择...</option>{{$catelist}}</select> <!--<a onclick="dotb('新加分类', '?m={{'parameter'|encrypt}}&a=poplist&cateid={{$log.id}}&keyname=select2p&textname=parameters&a=add&view=small&keepThis=true&TB_iframe=false&height=522&width=1000');return false;" class="button"><span>添加分类</span></a> <a id="catesbtn" class="button"><span>扩展分类</span></a>-->
                </td>
            </tr>
           <!--  <tr id="glabel">
              <td> 扩展分类:</td>
          <td>
          <select name="class_ids[]"><option value="">请选择...</option>{{$catelist}}</select>
          <select name="class_ids[]"><option value="">请选择...</option>{{$catelist}}</select>
          <select name="class_ids[]"><option value="">请选择...</option>{{$catelist}}</select>
          <select name="class_ids[]"><option value="">请选择...</option>{{$catelist}}</select>
           </td>
			 </tr>-->
           <!--   <tr>
              <td> 商品品牌:</td>
              <td>
               <input type="text" id="keyword1" size="10"><input type="button" value="搜索" onclick="searchp('brand_id','keyword1')"><br/>
              <select name="brand_id" id="brand_id"><option value="">请选择...</option> {{html_options options=$brandlist selected=$log.brand_id}}</select> <a onclick="dotb('新加品牌', '?m={{'brand'|encrypt}}&a=poplist&keyname=brand_id&a=add&view=small&keepThis=true&TB_iframe=false&height=522&width=1000');return false;" class="button"><span>添加品牌</span></a>
                </td>
            </tr> -->
            <tr>
              <td>价格:</td>
              <td><input value="{{$log.price}}" size="20" name="price" id="price">
                </td>
            </tr>
                        <tr>
              <td>操作系统:</td>
              <td><input value="{{$log.sys}}" size="20" name="sys" id="sys">
                </td>
            </tr>
             <tr>
              <td>支持语言:</td>
              <td><input value="{{$log.lan}}" size="20" name="lan" id="lan">
                </td>
            </tr>
               <tr>
              <td>数据库:</td>
              <td><input value="{{$log.db}}" size="20" name="db" id="db">
                </td>
            </tr>
                           <tr>
              <td>空间大小:</td>
              <td><input value="{{$log.host}}" size="20" name="host" id="host">
                </td>
            </tr>
                                       <tr>
              <td>流量:</td>
              <td><input value="{{$log.rate}}" size="20" name="rate" id="rate">
                </td>
            </tr>
          <!--   <tr>
              <td>市场指导价格:</td>
              <td><input value="{{$log.mkprice}}" size="20" name="mkprice" id="mkprice">
                </td>
            </tr> -->
             <!--   <tr>
              <td>商品重量:</td>
              <td><input value="{{$log.weight}}" size="15" name="weight" id="weight"><select name="weight_unit">{{html_options options=$unitlist selected=$log.weight_unit}}</select>
                </td>
            </tr> -->
             <!--  <tr>
              <td>商品库存数量:</td>
              <td><input value="{{$log.quantity|default:'1'}}" size="20" name="quantity" id="quantity">
                </td>
            </tr> --><!--
            <tr>
              <td>颜色:</td>
              <td><ul class="product-add-color">{{foreach from=$langs.colors item=data}}<li><input  type="checkbox" id='color_{{$data.color}}_{{$data.name}}' class="ckinput" title="{{$data.name}}"  {{if $data.parakey}}checked> <input id="color_{{$data.color}}_{{$data.name}}i" name="parameter[color_{{$data.color}}_{{$data.name}}] type="text" value="{{$data.name}}">{{else}}>{{/if}}<label id='color_{{$data.color}}_{{$data.name}}t' style="background: none repeat scroll 0 0 #{{$data.color}}; {{if $data.parakey}}display: none;{{/if}}" title="{{$data.name}}"></label></li>{{/foreach}}</ul></td>
            </tr>
            <tr>
              <td>尺码:</td>
              <td><ul class="product-add-color">{{foreach from=$langs.sizes item=data}}<li> <input type="checkbox"  id="size_{{$data.size}}_{{$data.name}}" class="ckinput" title="{{$data.name}}" {{if $data.parakey}}checked> <input id="size_{{$data.size}}_{{$data.name}}i" name="parameter[size_{{$data.size}}_{{$data.name}}] type="text" value="{{$data.name}}">{{else}}>{{/if}}<label class="mc" id='size_{{$data.size}}_{{$data.name}}t' {{if $data.parakey}}style="display: none;"{{/if}}>{{$data.name}}</label></li>{{/foreach}}</ul></td>
            </tr>
            <tr>
              <td> 库存警告数量:</td>
              <td><input value="{{$log.warn_quantity|default:'1'}}" size="20" name="warn_quantity" id="warn_quantity">
                </td>
            </tr>
              <tr>
              <td>赠送积分:</td>
              <td><input value="{{$log.give_integral|default:'-1'}}" size="30" name="give_integral" id="give_integral"><br>购买该商品时赠送消费积分数,-1表示按商品价格赠送
                </td>
            </tr>
            <tr>
            <td>加入推荐：</td>
            <td><input name="is_best" value="1" type="checkbox" {{if $log.is_best=="1"}}checked{{/if}}>精品 <input name="is_new" value="1" type="checkbox" {{if $log.is_new=="1"}}checked{{/if}}>新品 <input name="is_hot" value="1" type="checkbox" {{if $log.is_hot=="1"}}checked{{/if}}>热销</td>
          </tr>-->
         <!--  <tr>
            <td class="label">商品类型：</td>
            <td>{{html_checkboxes name="ptype" options=$typelist checked=$ptype }}</td>
          </tr> -->
          <tr>
            <td>商品状态:</td>
            <td><select name="status">
                                {{html_options options=$statuslist selected=$log.status}}
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
          {{section name=data1 loop=$valslists}}
          <tbody id="vals_row{{$smarty.section.data1.index}}">
            <tr style="background-color:{{$valslists[data1].color}}">
              <td class="left"><input type="text" name="product_vals[{{$smarty.section.data1.index}}][name]" value="{{$valslists[data1].name}}" size="50" /></td>
              <td class="left"><input type="text" name="product_vals[{{$smarty.section.data1.index}}][pvals]" value="{{$valslists[data1].val}}" size="50" /></td>
              <td class="left">{{if $valslists[data1].color==""}}<a onclick="$('#vals_row{{$smarty.section.data1.index}}').remove();" class="button"><span>删除</span></a>{{/if}}</td>
            </tr>
          </tbody>
          {{/section}}
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
              <img onclick="dotb('{{$langs.upload}}', '?m={{'upload'|encrypt}}&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="image" id="preview" alt="" src="{{if $log.picpath}}{{$smarty.const.IMG_HOST}}{{$log.picpath}}.100x100.jpg{{else}}./images/no_image-100x100.jpg{{/if}}" title="点击上传图片">
              <input type="hidden" id="picpath" value="{{$log.picpath}}" name="picpath">
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
            {{section name=data loop=$images}}
            <div class="img_mc">
            	<img onclick="dotb('上传', '?m={{'upload'|encrypt}}&a=crop&fileurl={{$images[data].attachment}}&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="image" id="preview" alt="" src="{{$smarty.const.IMG_HOST}}{{$images[data].attachment}}" height="100" title="点击替换主题图片"/>
            	<input name="aid[]" type="hidden" value="{{$images[data].id}}"/><p><a href="#" onclick="$(this).parent().parent().remove();">删除</a></p>
            </div>
            {{/section}}

              </td>
          </tr>

          <tr>
            <td>商品图册:</td>
            <td><a onclick="dotb('批量上传', '?m={{'upload'|encrypt}}&a=multiimg&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="button"><span>批量上传</span></a></td>
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
var vals_row = {{$smarty.section.data1.index|default:"0"}};

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
{{include file=admin/footer.tpl}}