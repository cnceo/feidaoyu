{{include file=admin/header.tpl}}
<script type="text/javascript">
$(document).ready(function(){
  $('.date').datepicker({dateFormat: 'yy-mm-dd'});
});
$(document).ready(function(){
    $('#message').keyup(function(){
    	var length = $('#message').val().length;
    	if(length<71){
    		$('#msg').html(length+"个字符，一条短信");
    	}
    	else if(length>70 && length<140 ){
    		$('#msg').html(length+"个字符，将自动分割2条短信发送");
    	}
    	else
    	{
    		$('#msg').html('<label for="message" generated="true" class="error">短信内容最长不超过140个字符</label>');
    	}
    });
  $("#myForm").validate({
    	rules: {
	    		message: {
	    			required: true,
	    			maxlength: 140
	    		}
    	      },
    	 messages: {
	    		message: {
	    			required: "请填写短信内容",
	    			maxlength: "短信内容最长不超过140个字符"
	    		}
    	      },
    	 showErrors:function(errorMap,errorList){ 
			        $(".warning").css('display','block');
			        $(".warning").html("带*为必填项，共有 " + this.numberOfInvalids() + " 错误，请仔细检查！"); 
			        this.defaultShowErrors(); 
			   }
   	 });
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
    <div class="htabs" id="tabs"><a href="?m={{'message'|encrypt}}">发信</a>
    <a href="?m={{'message'|encrypt}}&a=mass" class="selected">群发</a>
    <a href="?m={{'message'|encrypt}}&a=logs">记录</a>
    <a  href="?m={{'message'|encrypt}}&a=templet">模板</a>
    <a  href="?m={{'message'|encrypt}}&a=setting">设置</a>
    </div>
    <div class="htabs" id="languages">
                    <a href="?m={{'message'|encrypt}}&a=mass" > 站内</a>
                    <a href="?m={{'message'|encrypt}}&a=massup" class="selected">上传</a>
		          </div>
     <form id="myForm" name="myForm" action="?m={{'message'|encrypt}}&a=sendup" method="POST" enctype="multipart/form-data">
       <table class="form">
          <tbody>
			          <tr>
			              <td> 文本文件:</td>
			              <td><input type="file" name="file">
			                </td>
			            </tr>
			          <tr>
			          <td>内容:</td>
			          <td><textarea rows="5" cols="40" name="message" id="message"></textarea> <span id="msg"></span>
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
</div>
 <div style="clear:both"></div>
</div></div>
{{include file=admin/footer.tpl}}