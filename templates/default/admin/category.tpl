{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'category'|encrypt}}&a=add&id="+id;
}
function subAdd(id)
{
	if(!id)id="";
	location.href="?m={{'category'|encrypt}}&a=add&pid="+id;
}
function Del(id){
	 if(confirm("确认删除吗？,删除将包括所有到子项"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'category'|encrypt}}&a=del",
				data: "id="+id,
				dataType: 'json', 
				success: function(msg){ 
				 if(msg.status == "true")
					 {
						 //location.href="?m={{'category'|encrypt}}";
						 location.reload()
					 }
					 else
					{
						 alert(msg.message);
					}
				} 
			}); 
		}
}

function SaveUpdate()
{
	var data = $("#myForm").formToArray(); 
	$.ajax({
		type: "POST",
		url:  "?m={{'category'|encrypt}}&a=update",
		data: data,
		success: function(msg){ 
			 //location.reload();
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
    <h1 style="background-image: url('./images/category.png');">商品分类</h1>
    <div class="buttons"><a onclick="subAdd({{$smarty.get.cateid}});" class="button"><span>添加新分类</span></a></div>

  </div>
  <div class="content">
    <form action="" method="post" id="myForm">
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
        {{foreach from=$logs item=data}}
       <!-- {{if $data.prodnum=="0" &&$data.childnum=="0"}}
        {{$data.id}},
        {{/if}}-->
        <tr>
            <td class="left"><a href="?m={{'product'|encrypt}}&cateid={{$data.id}}" title="浏览商品">{{$data.cname}}</a>(商品:<a href="?m={{'product'|encrypt}}&cateid={{$data.id}}" title="浏览商品" style="color:blue;">{{$data.prodnum}}</a>,子类:<a href="?m={{'category'|encrypt}}&cateid={{$data.id}}" title="查看子类" style="color:red;">{{$data.childnum}}</a>)</td>
            <td class="left">{{$data.ename}}</td>
            <td class="right"><input name="seque[{{$data.id}}]" value="0" size="2"></td>
            <td class="right"><a href="#" onclick="Add('{{$data.id}}');"  alt="Save"> 修改 </a>
					 | 
					<a href="#" onclick="Del('{{$data.id}}');"> 删除 </a>
					 | 
					<a href="#" onclick="Add();"> 新加 </a>
					 | 
					<a href="#" onclick="subAdd('{{$data.id}}');"> 新加子类 </a>
					 | 
					<a href="?m={{'category'|encrypt}}&cateid={{$data.id}}"> 查看子类 </a>
					 | 
					<a href="?m={{'product'|encrypt}}&cateid={{$data.id}}"> 浏览商品 </a></td>
          </tr>
         {{/foreach}} 
                            </tbody>
      </table>
    </form>
    <div class="buttons"><a onclick="SaveUpdate();" class="button"><span>排序</span></a></div>
     <div style="clear:both"></div>
  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}