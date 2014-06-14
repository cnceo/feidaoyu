{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'account'|encrypt}}&a=add&id="+id;
}
function subAdd(id)
{
	if(!id)id="";
	location.href="?m={{'account'|encrypt}}&a=add&pid="+id;
}
function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'account'|encrypt}}&a=del",
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
					 location.href="?m={{'account'|encrypt}}";
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
	location.href = "?m={{'account'|encrypt}}&prodname="+$("#prodname").val()+"&sku="+$("#sku").val()+"&quantity="+$("#quantity").val()+"&status="+$("#status").val();
}
function Batch()
{
	var data = $("#myForm").formToArray(); 
	if($("#more").val()=="0")
	{
		msg = "删除";
	}
	else
	{
		msg = "移动";
	}
	
	if(confirm("您确认"+msg+"选中的用户吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'account'|encrypt}}&a=batch",
				data: data,
				success: function(msg){ 
						alert("操作成功");
						location.href= "?m={{'account'|encrypt}}&a=batch&cateid="+$("select[@name='class_id'] option[@selected]").val();
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
    <h1 style="background:url(/admin/images/account.png) no-repeat; overflow:hidden; width:160px">用户列表</h1>
    <div class="buttons"><a onclick="Add();" class="button"><span>添加新用户</span></a></div>
   
  </div>   
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">姓名</td>
            <td class="left">用户名</td>
            <td class="left">联系方式</td>
            <td class="right">部门/用户组</td>
            <td class="left">状态</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
          <td style="text-align: center;">              <input type="checkbox" name="selected[]" value="{{$logs[data].id}}" />
              </td>
             <td class="left">{{$logs[data].truename}}</td>
             <td class="left">{{$logs[data].admin}}</td>
            <td class="left">Email:{{$logs[data].email}}<br>
                             电话:{{$logs[data].telphone}}<br>
                             手机:{{$logs[data].mobile}}<br>
                             QQ:{{$logs[data].qq}}
                             </td>
            <td class="right">{{$logs[data].dept}}<br>
                               {{$logs[data].group}}</td>
            <td class="left">{{if $logs[data].flag=="1"}}帐户被锁定{{else}}正常{{/if}}</td>
            <td class="right"><a href="#" onclick="Add('{{$logs[data].id}}','{{$logs[data].addtime}}');">修改</a> |
	        	            <a href="#" onclick="Del('{{$logs[data].id}}');"  alt="Cancel"> 删   除 </a> | 
	        	             <a href="#" onclick="Add('{{$sites.ttype}}');">新加</a></td>
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

  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}