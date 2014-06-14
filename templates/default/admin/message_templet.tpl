{{include file=admin/header.tpl}}
<script type="text/javascript">
$(document).ready(function(){
    $('#content1').keyup(function(){
    	var length = $('#content1').val().length;
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
	    		title: {
	    			required: true
	    		},
	    		content: {
	    			required: true,
	    			maxlength: 140
	    		}
    	      },
    	 messages: {
    		    title: {
    		    	required: "请填写模板名称"
	    		},
	    		content: {
	    			required: "请填写模板内容",
	    			maxlength: "模板内容最长不超过140个字符"
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
						url:  "?m={{'message'|encrypt}}&a=templetsave",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										alert("保存成功");   
								    	window.location= '?m={{'message'|encrypt}}&a=templet';    
								    }
								    else
								    {
								    	alert(msg.message);
								    }	 
						   }
					}); 	
			}
		});
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'message'|encrypt}}&a=templet&id="+id;
}
function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'message'|encrypt}}&a=del",
				data: "id="+id,
				success: function(msg){ 
				 if (msg=='error')
				 {
					 alert("保存失败");
				 }
				 else if (msg=='Permission denied')
					 {
						 alert("权限限制");
					 }
				 else if (msg=='succeed')
				 {
					 location.href="?m={{'message'|encrypt}}";
				 }
				 else
				{
					 alert("未知错误");
				}    
				}   
			});   
		}
}
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
    <a href="?m={{'message'|encrypt}}&a=mass">群发</a>
    <a href="?m={{'message'|encrypt}}&a=logs">记录</a>
    <a  href="?m={{'message'|encrypt}}&a=templet" class="selected">模板</a>
    <a  href="?m={{'message'|encrypt}}&a=setting">设置</a>
    </div>
      <form id="myForm" name="myForm" action="" method="post">
      <input type="hidden" name="id" id="id" value="{{$log.id}}">
      <table class="form">
        <tbody>
         <tr>
          <td width="100px" style="right">名称:</td>
          <td><input type="text" size="40" id="title" name="title" value="{{$log.title}}">
          </td>
        </tr>
         <tr>
          <td>内容:</td>
          <td><textarea rows="5" cols="40" name="content" id="content1">{{$log.content}}</textarea> <span id="msg"></span>
          </td>
        </tr>
         <tr>
          <td></td>
          <td>
          <a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a>
          </td>
        </tr>
			          </tbody></table>
        </form>
        <br>
        <table class="list">
        <thead>
          <tr>
            <td class="center">模板名称</td>
            <td class="center">创建时间</td>
            <td class="center">操作</td>
          </tr>
        </thead>
        <tbody>
        {{section name=data loop=$logs}}
          <tr>
            <td class="left">{{$logs[data].title}}</td>
            <td class="center"  width="150">{{$logs[data].addtime}}</td>
            <td class="center" width="300">
            <a href="#" onclick="Add('{{$logs[data].id}}','{{$logs[data].addtime}}');">修改</a> |
	        <a href="#" onclick="Del('{{$logs[data].id}}');"  alt="Cancel"> 删除 </a>
            
            </td>
          </tr>
           {{sectionelse}}
          <tr>
            <td colspan="7" class="center">No results!</td>
          </tr>
        {{/section}}
        
                            </tbody>
      </table>
      <div class="buttons">{{include file=admin/pages.tpl}} 
      <div style="clear:both"></div>
      </div>
 <div style="clear:both"></div>
  </div>
  
</div>
</div></div>
{{include file=admin/footer.tpl}}