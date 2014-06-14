{{include file=admin/header.tpl}}
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
});

       $.validator.setDefaults({
			 submitHandler: function() {

			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m={{'articlecate'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json',
						success: function(msg){

							    if(msg.status == "true")
								    {
										  // window.location= '?m={{'articlecate'|encrypt}}';
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
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a><a tab="#tab_data" class="">其他</a></div>
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
      <div id="tab_general" style="display: block;">
        <div class="htabs" id="languages">
                    <a tab="#language1" class="selected"><img src="./images/flags/cn.png" title="中文" /> 中文</a>
                    <a tab="#language2"><img src="./images/flags/gb.png" title="英文" /> 英文</a>
                   <!-- <a tab="#language3"><img src="./images/flags/jp.png" title="日文" /> 日文</a>-->
		          </div>
                <div id="language1" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 分类名称:</td>
			              <td><input value="{{$log.cname}}" size="100" name="cname" id="cname">
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
			              <td>描述:</td>
			              <td><textarea name="cdescription" style="width:60%" class="mceEditor">{{$log.cdescription}}</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>
		        <div id="language2" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 分类名称:</td>
			              <td><input value="{{$log.ename}}" size="100" name="ename" id="ename">
			                </td>
			            </tr>
			            <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="5" cols="40" name="emeta_keywords">{{$log.emeta_keywords}}</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="5" cols="40" name="emeta_description">{{$log.emeta_description}}</textarea></td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="edescription"  style="width:60%" class="mceEditor">{{$log.edescription}}</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>
		     <!--   <div id="language3" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 分类名称:</td>
			              <td><input value="{{$log.jname}}" size="100" name="jname" id="jname">
			                </td>
			            </tr>
			            <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="5" cols="40" name="jmeta_keywords">{{$log.jmeta_keywords}}</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="5" cols="40" name="jmeta_description">{{$log.jmeta_description}}</textarea></td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="jdescription" style="width:60%" class="mceEditor">{{$log.jdescription}}</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>-->
		      </div>
      <div id="tab_data" style="display: none;">
        <table class="form">
          <tbody><tr>
            <td>父级分类:</td>
            <td><select name="pid"><option value="0">|顶级分类</option>{{$plist}}</select></td>
          </tr>
          <tr>
            <td>图片:</td>
            <td valign="top">
            <input type="hidden" id="picname" value="" name="picname">
            <input type="hidden" id="picpath" value="" name="picpath">
              <img onclick="dotb('{{$langs.upload}}', '?m={{'upload'|encrypt}}&keepThis=true&TB_iframe=false&height=243&width=425');return false;" class="image" id="preview" alt="" src="./images/no_image-100x100.jpg"></td>
          </tr>
		  <tr>
            <td>分类状态:</td>
            <td><select name="status">
                                {{html_options options=$statuslist selected=$log.status}}
                              </select></td>
          </tr>
           <tr>
            <td>模板:</td>
            <td><input size="10" value="{{$log.tplname|default:'artilelist'}}" name="tplname"></td>
          </tr>
          <tr>
            <td>排序:</td>
            <td><input size="1" value="{{$log.sequence|default:'0'}}" name="sequence"></td>
          </tr>
        </tbody></table>
      </div>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a>
      <div style="clear:both"></div>
     </div>
  </div>

</div>

<style>

.buttons .button{ float:right}
</style>

<script type="text/javascript"><!--
$.tabs('#tabs a');
$.tabs('#languages a');
//--></script>
</div></div>
{{include file=admin/footer.tpl}}