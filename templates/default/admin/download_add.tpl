{{include file=admin/header.tpl}}
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
						url:  "?m={{'download'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json',
						success: function(msg){

							    if(msg.status == "true")
								    {
										   window.location= '?m={{'download'|encrypt}}';
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
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
      <div id="tab_general" style="display: block;">
			          <table class="form">
			            <tbody>
			            <tr>
			              <td><span class="required">*</span> 资源标题:</td>
			              <td><input value="{{$log.title}}" size="100" name="title" id="title">
			                </td>
			            </tr>
			             <tr>
			              <td><span class="required">*</span> SEO标题:</td>
			              <td><input value="{{$log.filename}}" size="100" name="filename" id="filename">
			                </td>
			            </tr>
			            
			          <!--  <tr>
              <td><span class="required">*</span> 资源分类:</td>
              <td><select name="class_id" id="class_id"><option value="">请选择...</option>{{$catelist}}</select> <a onclick="#" class="button"><span>添加分类</span></a>
                </td>
            </tr>-->
			            <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="3" cols="40" name="meta_keywords">{{$log.meta_keywords}}</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="3" cols="40" name="meta_description">{{$log.meta_description}}</textarea></td>
			            </tr>
			         
			            
			            
			            <tr>
			              <td> 资源地址:</td>
			              <td><input value="{{$log.url}}" size="100" name="url" id="url">
			                </td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="description" rows="3" cols="40">{{$log.description}}</textarea></td>
			            </tr>
			            
			           
			            

			            
			                      
				           <tr>
				            <td>资源状态:</td>
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

</div></div>
{{include file=admin/footer.tpl}}