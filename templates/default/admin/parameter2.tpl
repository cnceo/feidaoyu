{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'parameter2'|encrypt}}&a=add&id="+id;
}
function subAdd(id)
{
	if(!id)id="";
	location.href="?m={{'parameter2'|encrypt}}&a=add&pid="+id;
}
function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'parameter2'|encrypt}}&a=del",
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
					 location.href="?m={{'parameter2'|encrypt}}";
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
    <h1 style="background-image: url('./images/parameter2.png');">名称</h1>
    <div class="buttons"><a onclick="{{if $smarty.get.pid}}subAdd('{{$smarty.get.pid}}');{{else}}Add();{{/if}}" class="button"><span>添加</span></a></div>

  </div>
  <div class="content">
    <form action="" method="post" enctype="multipart/form-data" id="form">
      <table class="list">
        <thead>
          <tr>
            <td class="left">名称</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        {{section name=data loop=$logs}}
          <tr>
            <td class="left">{{$logs[data].name}}</td>
            <td class="right"><a href="?m={{'parameter2'|encrypt}}&pid={{$logs[data].id}}">浏览</a> |
                              <a href="#" onclick="Add('{{$logs[data].id}}');">修改</a> |
	        	              <a href="#" onclick="Del('{{$logs[data].id}}');"  alt="Cancel"> 删   除 </a> | 
	        	              <a href="#" onclick="subAdd('{{$logs[data].id}}');">新加</a></td>
          </tr>
        {{/section}}
                            </tbody>
      </table>
    </form>
  </div>
</div>
</div></div>

{{include file=admin/footer.tpl}}