{{include file=admin/header.tpl}}
<script type="text/javascript">
  function Save()
	{
		var data = $("#myForm").formToArray();
		$.ajax({
			type: "POST",
			url:  "?m={{'setting'|encrypt}}&a=savePost",
			data: data,
			success:function() {
				alert("操作成功");
				location.href= "?m={{'message'|encrypt}}";
			}
		}); 	
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
    <a href="?m={{'message'|encrypt}}&a=templet">模板</a>
    <a href="?m={{'message'|encrypt}}&a=setting" class="selected">设置</a>
    </div>
     <form id="myForm" name="myForm" action="" method="post">
       <table class="form">
          <tbody>
			          <tr>
			              <td> API接口地址:</td>
			              <td><input value="{{$log.msgadd}}" size="100" name="msgadd" id="msgadd">
			                </td>
			            </tr>
			             <tr>
			              <td> 账户:</td>
			              <td><input value="{{$log.msguser}}" size="50" name="msguser" id="msguser">
			                </td>
			            </tr>
			           <tr>
			              <td>密码:</td>
			              <td><input value="{{$log.msgpwd}}" size="50" name="msgpwd" id="msgpwd">
			                </td>
			            </tr>
        </tbody></table>
         </form>
         <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="Save();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
		      </div>
 <div style="clear:both"></div>
  </div>
  
</div>
</div></div>
{{include file=admin/footer.tpl}}