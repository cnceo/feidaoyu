{{include file=admin/header.tpl}}
<script type="text/javascript">
$(document).ready(function(){
	 jQuery.validator.addMethod("isMobile", function(value, element) {
        var length = value.length;
        var mobile = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请正确填写您的邮件地址");
    $('#message').keyup(function(){
    	var length = $('#message').val().length;
    	if(length<60){
    		$('#msg').html(length+"个字符，一条邮件");
    	}
    	else if(length>60 && length<120 ){
    		$('#msg').html(length+"个字符，将自动分割2条邮件发送");
    	}
    	else
    	{
    		$('#msg').html('<label for="message" generated="true" class="error">邮件内容最长不超过120个字符</label>');
    	}
    });
  $("#myForm").validate({
    	rules: {
	    		email: {
	    			required: true,
	    			email: true
	    		},
	    		message: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    mobile: {
    		    	required: "请填写邮件地址",
    		    	required: "请填写正确的邮件地址"
	    		},
	    		message: {
	    			required: "请填写邮件内容"
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
						url:  "?m={{'message'|encrypt}}&a=send",
						data: data,
						success: function(msg){
							    
							    if(msg == "succeed")
								    {
										   window.location= '?m={{'message'|encrypt}}';    
								    }
								    else
								    {
								    	alert("发送失败，请重试");
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
  </div>
  <div class="content">
    <div class="htabs" id="tabs"><a href="?m={{'directmail'|encrypt}}" class="selected">发信</a>
    <a href="?m={{'directmail'|encrypt}}&a=mass">群发</a>
    <a href="?m={{'directmail'|encrypt}}&a=logs">记录</a>
    <a href="?m={{'directmail'|encrypt}}&a=templet">模板</a>
    <a href="?m={{'directmail'|encrypt}}&a=setting">设置</a>
    </div>
     <form id="myForm" name="myForm" action="" method="post">
      <table class="form">
        <tbody>
         <tr>
          <td width="100px" style="right">邮件地址:</td>
          <td><input type="text" size="80" id="email" name="email">
          </td>
        </tr>
         <tr>
          <td>内容:</td>
          <td><textarea rows="20" cols="80" name="message" id="message"></textarea> <span id="msg"></span>
          </td>
        </tr>
         <tr>
          <td></td>
          <td>
          <a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>发送</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a>
          </td>
        </tr>
			          </tbody></table>
        </form>
		      </div>
 <div style="clear:both"></div>
  </div>
  
</div>
</div></div>
{{include file=admin/footer.tpl}}