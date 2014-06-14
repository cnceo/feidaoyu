{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'adt'|encrypt}}&a=add&id="+id;
}

function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'adt'|encrypt}}&a=del",
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
					 location.href="?m={{'adt'|encrypt}}";
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
    <h1 style="background-image: url('./images/adt.png');">广告位置</h1>
    <div class="buttons"><a onclick="Add();" class="button"><span>添加新广告位置</span></a></div>

  </div>
  <div class="content">
    <form action="" method="post" enctype="multipart/form-data" id="form">
      <table class="list">
        <thead>
          <tr>
            <td class="left">广告位置</td>
            <td class="left">广告尺寸</td>
            <td class="left">广告描述</td>
            <td class="center">语言</td>
            <td class="center">状态</td>
            <td class="center">操作</td>
          </tr>
        </thead>
        <tbody>
        {{section name=data loop=$logs}}
          <tr>
            <td class="left">{{$logs[data].title}}</td>
            <td class="center">宽：{{$logs[data].width}}   高：{{$logs[data].height}}</td>
            <td class="left">{{$logs[data].description}}</td>
            <td class="center">{{$logs[data].lang}}</td>
            <td class="center">{{if $logs[data].status=="1"}}启用{{else}}关闭{{/if}}</td>
            <td class="center"><a href="#" onclick="Add('{{$logs[data].id}}','{{$logs[data].addtime}}');">修改</a> |
	        	            <a href="#" onclick="Del('{{$logs[data].id}}');"  alt="Cancel"> 删   除 </a> | 
	        	             <a href="#" onclick="Add('{{$sites.ttype}}');">新加</a></td>
          </tr>
        {{/section}}
                            </tbody>
      </table>
      <div class="buttons">
      {{include file=admin/pages.tpl}} 
      <div style="clear:both"></div>
      </div>
    </form>
  </div>
</div>
</div></div>

{{include file=admin/footer.tpl}}