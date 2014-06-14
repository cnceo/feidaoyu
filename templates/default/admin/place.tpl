{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'place'|encrypt}}&a=add&id="+id;
}
function subAdd(id)
{
	if(!id)id="";
	location.href="?m={{'place'|encrypt}}&a=add&pid="+id;
}
function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'place'|encrypt}}&a=del",
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
					 location.href="?m={{'place'|encrypt}}";
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
    <h1 style="background-image: url('./images/place.png');">产地</h1>
    <div class="buttons"><a onclick="Add();" class="button"><span>添加产地</span></a></div>

  </div>
  <div class="content">
    <form action="" method="post" enctype="multipart/form-data" id="form">
      <table class="list">
        <thead>
          <tr>
            <td class="left">产地</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        {{section name=data loop=$logs}}
          <tr>
            <td class="left">{{$logs[data].catename}}</td>
            <td class="right"><a href="#" onclick="Add('{{$logs[data].id}}');">修改</a> |
	        	            <a href="#" onclick="Del('{{$logs[data].id}}');"  alt="Cancel"> 删   除 </a> | 
	        	             <a href="#" onclick="Add();">新加</a></td>
          </tr>
        {{/section}}
                            </tbody>
      </table>
    </form>
  </div>
</div>
</div></div>

{{include file=admin/footer.tpl}}