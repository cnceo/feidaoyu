{{include file=admin/header.tpl}}
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
	    		},
	    		jname: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    cname: {
    		    	required: "请填写快递中文名称"
	    		},
    		    ename: {
    		    	required: "请填写快递英文名称"
	    		},
	    		jname: {
    		    	required: "请填写快递日文名称"
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
						url:  "?m={{'express'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m={{'express'|encrypt}}';    
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
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('./images/payment.png');">{{if $log.id==""}}添加{{else}}修改{{/if}}{{$sites.title}}</h1>
    <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>

  </div>
  <div class="content">
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a><a tab="#tab_data" class="selected">其他</a></div>
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
      <div id="tab_general" style="display: block;">
        <div class="htabs" id="languages">
                    <a tab="#language1" class="selected"><img src="./images/flags/cn.png" title="中文" /> 中文</a>
                    <a tab="#language2"><img src="./images/flags/gb.png" title="英文" /> 英文</a>
                    <a tab="#language3"><img src="./images/flags/jp.png" title="日文" /> 日文</a>
		          </div>
                <div id="language1" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 快递名称:</td>
			              <td><input value="{{$log.cname}}" size="100" name="cname" id="cname">
			                </td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="cdescription"  style="width:60%" class="mceEditor">{{$log.cdescription}}</textarea>
			          </tbody></table>
		        </div>
		        <div id="language2" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 快递名称:</td>
			              <td><input value="{{$log.ename}}" size="100" name="ename" id="ename">
			                </td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="edescription"  style="width:60%" class="mceEditor">{{$log.edescription}}</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>
		        <div id="language3" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 快递名称:</td>
			              <td><input value="{{$log.jname}}" size="100" name="jname" id="jname">
			                </td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="jdescription" style="width:60%" class="mceEditor">{{$log.jdescription}}</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>
		      </div>
		       <div id="tab_data" style="display: block;">
		       		<table class="form">
			            <tbody>
			            <tr>
			              <td>API:</td>
			              <td><input value="{{$log.api}}" size="100" name="api" id="api">
			                </td>
			            </tr>
			            <tr>
			              <td><span class="required">*</span> 计费规则:</td>
			              <td><table id="rules" class="list">
          <thead>
            <tr>
             <td class="left">项目</td>
              <td class="left">限值</td>
              <td class="left">运价</td>
              <td></td>
            </tr>
          </thead>
          {{section name=data1 loop=$rules}}
          <tbody id="ep_row{{$smarty.section.data1.index}}">
            <tr>
              <td class="left"><select  name="ep_rules[{{$smarty.section.data1.index}}][type]">
		          {{foreach from=$itemlist item=id key=k}}
		          <option value="{{$k}}" {{if $rules[data1].type == $k}}selected{{/if}}>{{$id}}</option>{{/foreach}}
		          </select></td>
              <td class="left"><select  name="ep_rules[{{$smarty.section.data1.index}}][rule]">
		          {{foreach from=$rulelist item=id key=k}}
		          <option value="{{$k}}" {{if $rules[data1].rule == $k}}selected{{/if}}>{{$id}}</option>{{/foreach}}
		          </select><input type="text" name="ep_rules[{{$smarty.section.data1.index}}][val]" value="{{$rules[data1].val}}" size="4" /></td>
              <td class="left"><input type="text" name="ep_rules[{{$smarty.section.data1.index}}][price]" value="{{$rules[data1].price}}" /></td>
              <td class="left"><a onclick="$('#ep_row{{$smarty.section.data1.index}}').remove();" class="button"><span>删除</span></a></td>
            </tr>
          </tbody>
          {{/section}}
           <tfoot>

            <tr>
              <td colspan="3"></td>
              <td class="left"><a onclick="addrules();" class="button"><span>添加</span></a></td>
            </tr>
          </tfoot>
        </table>
			                </td>
			            </tr>
			             <tr>
            <td>默认快递:</td>
            <td><select name="def">
                                {{html_options options=$statuslist selected=$log.def}}
                              </select></td>
          </tr>
			          </tbody></table>
		       </div>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>
  
</div>
<script type="text/javascript">
<!--
$.tabs('#tabs a'); 
$.tabs('#languages a'); 
var ep_row = {{$smarty.section.data1.index|default:"0"}};

function addrules() {
	html  = '<tbody id="ep_row' + ep_row + '">';
	html += '<tr>'; 
    html += '<td class="left"><select name="ep_rules[' + ep_row + '][type]" style="margin-top: 3px;">';
    {{foreach from=$itemlist item=id key=k}}
        html += '<option value="{{$k}}">{{$id}}</option>';
    {{/foreach}}
        html += '</select></td>';		
    html += '<td class="left"><select name="ep_rules[' + ep_row + '][rule]" style="margin-top: 3px;">';
    {{foreach from=$rulelist item=id key=k}}
        html += '<option value="{{$k}}">{{$id}}</option>';
    {{/foreach}}
        html += '</select><input type="text" name="ep_rules[' + ep_row + '][val]" value="" /></td>';
	html += '<td class="left"><input type="text" name="ep_rules[' + ep_row + '][price]" value="" class="price"/></td>';
	html += '<td class="left"><a onclick="$(\'#ep_row' + ep_row + '\').remove();" class="button"><span>删除</span></a></td>';
	html += '</tr>';	
    html += '</tbody>';
	
	$('#rules tfoot').before(html);
	ep_row++;
}
//-->
</script>
</div></div>
{{include file=admin/footer.tpl}}