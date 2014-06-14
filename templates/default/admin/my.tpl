{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/editor/tiny_mce.js"></script>
<script type="text/javascript" src="js/editor/editor_simple.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		truename: {
	    			required: true
	    		},
	    		admin: {
	    			required: true
	    		},
	    		mobile: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    truename: {
    		    	required: "请填写真实姓名"
	    		},
	    		admin: {
	    			required: "请填写用户名"
	    		},
	    		mobile: {
	    			required: "请填写手机号码"
	    		}
    	      },
    	 errorPlacement: function(error, element){       
        	$(".warning").css('display','block');
    	     }
   	 });
});
       
       $.validator.setDefaults({
			 submitHandler: function() {
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m={{'my'|encrypt}}&a=savePost",
						data: data,
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
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('./images/payment.png');">{{$sites.title}}</h1>
    <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>

  </div>
  <div class="content">
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a></div>
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
      <div id="tab_general" style="display: block;">
			          <table class="form">
			            <tbody>
			             <tr>
			              <td><span class="required">*</span> 姓名:</td>
			              <td><input value="{{$log.truename}}" size="80" name="truename" id="truename">
			                </td>
			            </tr>
			            <tr>
			              <td><span class="required">*</span> 用户名:</td>
			              <td><input value="{{$log.admin}}" size="80" name="admin" id="admin" {{if $log.id}}disabled{{/if}}>
			                </td>
			            </tr>
			            <tr>
          <td>部门</td>
          <td><select name="deptid" disabled>{{html_options options=$deptlist selected=$log.deptid}}</select>
	  </td>
        </tr>
      <tr>
          <td>用户组</td>
          <td><select name="groupid" disabled>{{html_options options=$grouplist selected=$log.groupid}}</select>
	  </td>
        </tr>
        </tr>
	<tr>
          <td><span class="required">*</span> 手机号码</td>
          <td><input type="text" name="mobile" id="mobile" size="80" value="{{$log.mobile}}"/></td>
        </tr>
	<tr>
          <td>电子邮件</td>
          <td><input type="text" name="email" id="email" size="80" value="{{$log.email}}"/></td>
        </tr>
	<tr>
          <td>QQ号码</td>
          <td><input type="text" name="qq" id="qq" size="80" value="{{$log.qq}}"/></td>
        </tr>
	<tr>
          <td>出生年月日</td>
          <td><input type="text" name="birthday" id="birthday" size="12" value="{{$log.birthday}}" />
	  </td>
        </tr>
	<tr>
          <td>联系住址</td>
          <td><input type="text" name="address" id="address" size="80" value="{{$log.address}}" /></td>
        </tr>
	<tr>
          <td>邮政编码</td>
          <td><input type="text" name="postcode" id="postcode" size="12" value="{{$log.postcode}}" /></td>
        </tr>
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
$.tabs('#languages a'); 
//--></script>
</div></div>
{{include file=admin/footer.tpl}}