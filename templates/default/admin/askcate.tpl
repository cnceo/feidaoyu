{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'askcate'|encrypt}}&a=add&id="+id;
}
function subAdd(id)
{
	if(!id)id="";
	location.href="?m={{'askcate'|encrypt}}&a=add&pid="+id;
}
function Del(id){
	 if(confirm("确认删除吗？,删除将包括所有到子项"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'askcate'|encrypt}}&a=del",
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
					 location.href="?m={{'askcate'|encrypt}}";
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
    <h1 style="background-image: url('./images/articlecate.png');">内容分类</h1>
    <div class="buttons"><a onclick="Add();" class="button"><span>添加新分类</span></a></div>

  </div>
  <div class="content">
    <form action="" method="post" enctype="multipart/form-data" id="form">
      <table class="list">
        <thead>
          <tr>
            <td class="left">分类名称</td>
            <td class="right">英文</td>
            <td class="right">排序</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        {{$logs}}
                            </tbody>
      </table>
    </form>
  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}