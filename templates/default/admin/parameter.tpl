{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'parameter'|encrypt}}&a=add&id="+id;
}
function Merge(id)
{
	if(!id)id="";
	location.href="?m={{'parameter'|encrypt}}&a=merge&id="+id;
}
function subAdd(id)
{
	if(!id)id="";
	location.href="?m={{'parameter'|encrypt}}&a=add&pid="+id;
}
function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'parameter'|encrypt}}&a=del",
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
					 location.href="?m={{'parameter'|encrypt}}";
				 }
				 else
				{
					 alert("未知错误");
				}    
				}   
			});   
		}
}
function go()
{
	location.href = "?m={{'parameter'|encrypt}}&name="+$("#name").val();
}
function Batch()
{
	var data = $("#myForm").formToArray(); 
	if($("input[name='more']:checked").val()=="0")
	{
		msg = "删除";
	}
	else if($("input[name='more']:checked").val()=="3")
	{
		msg = "上架";
	}
	else if($("input[name='more']:checked").val()=="4")
	{
		msg = "下架";
	}
	else
	{
		msg = "移动";
	}
	
	if(confirm("您确认"+msg+"选中的参数吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'parameter'|encrypt}}&a=batch",
				data: data,
				success: function(msg){ 
						alert("操作成功");
						if($("input[name='more']:checked").val()=="3" ||$("input[name='more']:checked").val()=="4" )
						{
							location.href= "?m={{'parameter'|encrypt}}&status=1";
						}
						else if($("input[name='more']:checked").val()=="4")
						{
							location.href= "?m={{'parameter'|encrypt}}&status=0";
						}
						else
						{
							location.href= "?m={{'parameter'|encrypt}}&cateid="+$("#class_id").val();
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
    <h1 style="background:url(/admin/images/parameter.png) no-repeat; overflow:hidden; width:160px">参数列表</h1>
    <div class="buttons"><a onclick="Add();" class="button"><span>添加新参数</span></a></div>
    <div class="buttons"><a onclick="Merge();" class="button"><span>参数合并</span></a></div>
  </div>   
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">参数名称</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        <tr class="filter">
            <td width="1" style="text-align: center;"></td>
            <td class="left"><input type="text" value="{{$smarty.get.name}}" id="name"></td>
            <td class="right"><a onclick="go();" class="button"><span>搜索</span></a></td>
          </tr>
         </form>
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
          <td style="text-align: center;"> 
           <input type="checkbox" name="selected[]" value="{{$logs[data].id}}" />
              </td>
            <td class="left">{{$logs[data].name}}</td>
            <td class="right"><a href="#" onclick="Add('{{$logs[data].id}}','{{$logs[data].addtime}}');">修改</a> |
                             <a href="#" onclick="Merge('{{$logs[data].id}}','{{$logs[data].addtime}}');">合并</a> | 
	        	             <a href="#" onclick="#"  alt="Cancel"> 删   除 </a> | 
	        	             <a href="#" onclick="Add('{{$sites.ttype}}');">新加</a></td>
          </tr>
           {{sectionelse}}
          <tr>
            <td colspan="7" class="center">No results!</td>
          </tr>
        {{/section}}
                            </tbody>
      </table>
      <div class="buttons">
       <table style="border-width:0px 0px medium;"><tr><td style="border:0px solid">
          <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
        <!--  <select name="class_id" id="class_id">{{$catelist}}</select>&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="1" checked>移动&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="0">删除&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="3">上架&nbsp; &nbsp;
          <input type="radio" name="more" id="more" value="4">下架&nbsp; &nbsp;
          <a onclick="Batch();" class="button"><span>操作</span></a>-->
		  </td><td style="border:0px solid">
			</td></tr></table>{{include file=admin/pages.tpl}} 
      <div style="clear:both"></div>
      </div>
       </form>
  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}