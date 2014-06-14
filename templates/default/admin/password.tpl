{{include file=admin/header.tpl}}

<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
    			oldpasswd: {
    		    	required: true,
	    			minlength: 6,
	    			remote:"?m={{'my'|encrypt}}&a=checkpasswd" 
	    		},
    		    newpasswd: {
    		    	required: true,
	    			minlength: 6
	    		},
	    		repasswd: {
	    			required: true,
	    			minlength: 6,
	    			equalTo:"#newpasswd"
	    		}
    	      },
    	 messages: {
    		    oldpasswd: {
    		    	required: "请输入旧密码",
	    			minlength: "密码要求由长度为6-16位字符组成",
	    			remote:"旧密码不正确" 
	    		},
    		    newpasswd: {
    		    	required: "请输入新密码",
	    			minlength: ""
	    		},
	    		repasswd: {
	    			required: "请再次输入新密码",
	    			minlength: "密码要求由长度为6-16位字符组成",
	    			equalTo:"新密码两次输入不一致"
	    		}
    	      }
   	 });
});
       
       $.validator.setDefaults({
			 submitHandler: function() {
						$.ajax({
						type: "POST",
						url:  "?m={{'my'|encrypt}}&a=savePost",
						data: "id={{$smarty.session.login_admin.id}}&password="+$("#newpasswd").val(),
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m={{'my'|encrypt}}';    
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
<div class="box box2">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden;">
    
    <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a>
   
    </div>
     <h1 style="background-image: url('./images/payment.png');">{{$sites.title}}</h1>
<div style="clear:"></div>
  </div>
  <div style="clear:"></div>
  <div class="content">
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a></div>
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">

      <div id="tab_general" style="display: block;">
			          <table class="form">
			            <tbody>
			             <tr>
			              <td><span class="required">*</span> 旧密码:</td>
			              <td><input type="password" name="oldpasswd"  id="oldpasswd" value="">
			                </td>
			            </tr>
			            <tr>
			              <td><span class="required">*</span> 新密码:</td>
			              <td><input type="password" name="newpasswd"  id="newpasswd" value=""><em class="red">*密码要求由长度为6-16位字符组成</em>
			                </td>
			            </tr>
			            <tr><td><span class="required">*</span> 确认新密码</td><td></span> <input type="password" name="repasswd"  id="repasswd" value=""><em class="red">*</em></td>
			          </tbody></table>
		      </div>
      <div id="tab_data" style="display: none;">
        
      </div>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>
  
</div>
<script type="text/javascript"><!--
$.tabs('#tabs a'); 
//--></script>
</div></div>
{{include file=admin/footer.tpl}}