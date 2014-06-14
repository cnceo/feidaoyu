{{include file=admin/header.tpl}}
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		file: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    file: {
    		    	required: "请选择批量导入文件"
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
    <form id="myForm" name="myForm"  enctype="multipart/form-data"  action="?m={{'import'|encrypt}}&a=savePost" method="post">
			          <table class="form">
			            <tbody>
			             <tr>
			              <td>所属产品</td>
			              <td><select name="pid" id="pid">{{html_options options=$catelist selected=$log.pid}}</select>
			                </td>
			            </tr>
			            <tr>
			              <td><span class="required">*</span> 上传批量产品序号和密码:</td>
			              <td><input type="file" size="70" name="file" id="file">
			                </td>
			            </tr>
			            <tr>
			              <td></td>
			              <td><a href="import.xls">下载批量导入模板文件</a>
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