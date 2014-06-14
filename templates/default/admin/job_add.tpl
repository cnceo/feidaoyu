{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/editor/tiny_mce.js"></script>
<script type="text/javascript" src="js/editor/editor_full.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		title: {
	    			required: true
	    		},
	    		class_id: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    title: {
    		    	required: "请填写岗位名称"
	    		},
	    		class_id: {
    		    	required: "请填写岗位分类"
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
						url:  "?m={{'article'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m={{'article'|encrypt}}';    
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
			            <tbody><tr>
			              <td><span class="required">*</span> 岗位名称:</td>
			              <td><input value="{{$log.title}}" size="100" name="title" id="title">
			                </td>
			            </tr>
			            <tr>
              <td><span class="required">*</span> 岗位分类:</td>
              <td><select name="class_id" id="class_id"><option value="">请选择...</option>{{$catelist}}</select> <a onclick="#" class="button"><span>添加分类</span></a>
                </td>
            </tr>

			            <tr>
			              <td> 职位性质:</td>
			              <td>
                                {{html_radios name="positiontype" options=$positiontypelist selected=$log.positiontype}}
			                </td>
			            </tr>
			            <tr>
			              <td> 工作经验:</td>
			              <td><select name="status">
                                {{html_options options=$statuslist selected=$log.status}}
                              </select>
			                </td>
			            </tr>
			             <tr>
			              <td> 学历要求:</td>
			              <td><select name="status">
                                {{html_options options=$statuslist selected=$log.status}}
                              </select>
			                </td>
			            </tr>
			             <tr>
			              <td> 招聘人数:</td>
			              <td><input value="{{$log.author}}" size="100" name="author" id="author">
			                </td>
			            </tr>
			            <tr>
			              <td> 语言能力:</td>
			              <td><select name="status">
                                {{html_options options=$statuslist selected=$log.status}}
                              </select>
			                </td>
			            </tr>
			            <tr>
			              <td> 职位月薪:</td>
			              <td><input value="{{$log.author}}" size="100" name="author" id="author">
			                </td>
			            </tr>
			             <tr>
			              <td> 工作地点:</td>
			              <td><input value="{{$log.author}}" size="100" name="author" id="author">
			                </td>
			            </tr>
			            <tr>
			              <td>职位描述:</td>
			              <td><textarea name="description" rows="3" cols="40">{{$log.description}}</textarea></td>
			            </tr>
			     
           <tr>
            <td>岗位状态:</td>
            <td><select name="status">
                                {{html_options options=$statuslist selected=$log.status}}
                              </select></td>
          </tr>
           <tr>
            <td>语言:</td>
            <td><select name="lang">
                                {{html_options options=$langlist selected=$log.lang}}
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