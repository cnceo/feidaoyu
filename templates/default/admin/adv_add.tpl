{{include file=admin/header.tpl}}
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
						url:  "?m={{'adv'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m={{'adv'|encrypt}}';    
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
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a></div>
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
      <div id="tab_general" style="display: block;">
			          <table class="form">
			            <tbody>
			            <!-- <tr>
			            <td>广告编码:</td>
			            <td><input value="{{$log.adcode}}" size="20" name="adcode" id="adcode"></td>
			          </tr>  -->
			            <tr>
			              <td><span class="required">*</span> 广告名称:</td>
			              <td><input value="{{$log.title}}" size="100" name="title" id="title">
			                </td>
			            </tr>
			           <tr>
			            <td>广告位置:</td>
			            <td><select name="aid">
			                                {{html_options options=$adtlist selected=$log.aid}}
			                              </select></td>
			          </tr> 
			           <!-- <tr>
			            <td>广告客户:</td>
			            <td><input value="{{$log.cid}}" size="20" name="cid" id="cid"></td>
			          </tr>  -->
			          <tr>
			              <td>开始日期:</td>
			              <td><input value="{{$log.starttime}}" size="20" name="starttime" id="starttime" class="date1">
			                </td>
			            </tr>
			             <tr>
			              <td>结束日期:</td>
			              <td><input value="{{$log.endtime}}" size="20" name="endtime" id="endtime" class="date1">
			                </td>
			            </tr>
			            <tr>
			              <td>广告链接:</td>
			              <td><input value="{{$log.link}}" size="100" name="link" id="link">
			                </td>
			            </tr>
			            <tr>
			              <td>上传广告图片:</td>
			              <td> <img onclick="dotb('{{$langs.upload}}', '?m={{'upload'|encrypt}}&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="image" id="preview" alt="" src="{{if $log.picpath}}{{$smarty.const.IMG_HOST}}{{$log.picpath}}.100x100.jpg{{else}}./images/no_image-100x100.jpg{{/if}}" title="点击上传图片">
              <input type="hidden" id="picpath" value="{{$log.picpath}}" name="picpath">
			                </td>
			            </tr>
			            <tr>
			              <td>或图片网址:</td>
			              <td><input value="{{$log.imglink}}" size="100" name="imglink" id="imglink">
			                </td>
			            </tr>
			             <tr>
			              <td>备注:</td>
			              <td><textarea rows="15" cols="80" name="content">{{$log.content}}</textarea>
			                </td>
			            </tr>
			             <tr>
			            <td>状态:</td>
			            <td><select name="status">
			                                {{html_options options=$statuslist selected=$log.status}}
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
{{include file=admin/footer.tpl}}