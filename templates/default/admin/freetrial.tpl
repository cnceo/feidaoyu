{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'freetrial'|encrypt}}&a=add&id="+id;
}
function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'freetrial'|encrypt}}&a=del",
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
					 location.href="?m={{'freetrial'|encrypt}}";
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
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/keyword.png) no-repeat; overflow:hidden; width:160px">{{$sites.title}}</h1>
    <div class="buttons"><a onclick="Add();" class="button"><span>添加</span></a></div>
   
  </div>   
  <div class="content">

      <table class="list">
        <thead>
          <tr>
              <td class="left">产品名称</td>
              <td class="center">客户群</td>
              <td class="center">数量</td>
              <td class="center">优先级</td>
              <td class="center">抵扣积分</td>
              <td class="center">开始时间</td>
              <td class="center">结束时间</td>
              <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
             <td class="left">{{$logs[data].cprodname}}{{if $logs[data].status=='0'}}<span style="color:red;">下架</span>{{/if}}</td>
              <td class="center">{{$logs[data].customer_group}}</td>
              <td class="center">{{$logs[data].quantity}}</td>
              <td class="center"><input type="text" name="priority[{{$logs[data].id}}]" value="{{$logs[data].priority}}" size="2" /></td>
              <td class="right">{{$logs[data].point}}</td>
              <td class="center">{{$logs[data].date_start}}</td>
              <td class="center">{{$logs[data].date_end}}</td>
              <td class="right"><a href="#" onclick="Add('{{$logs[data].id}}','{{$logs[data].addtime}}');">修改</a> |
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