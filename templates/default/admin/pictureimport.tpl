{{include file=admin/header.tpl}}
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		picpath: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    picpath: {
    		    	required: "图片位置不能为空"
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
    <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
  </div>
  <div class="content">
    <form id="myForm" name="myForm"  action="?m={{'pictureimport'|encrypt}}&a=savePost" method="post">
			          <table class="form">
			            <tbody>
			            <tr>
			              <td>图片位置:</td>
			              <td>/customs/<input type="text" size="20" name="picpath"> <span class="required">*</span> <a href="import.gif" target="_blank">使用说明</a>
			                </td>
			            </tr>
			            <tr>
			              <td>注意:</td>
			              <td>请将图片文件夹上传到/customs文件夹下面,请将权限改成777
			                </td>
			            </tr>
			          </tbody></table>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>
  
</div>
</div></div>
{{include file=admin/footer.tpl}}