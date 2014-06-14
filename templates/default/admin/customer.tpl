{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'customer'|encrypt}}&a=add&id="+id;
}

function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'customer'|encrypt}}&a=del",
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
					 location.href="?m={{'customer'|encrypt}}";
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
	location.href = "?m={{'customer'|encrypt}}&username="+$("#username").val()+"&email="+$("#email").val()+"&customer_group_id="+$("#customer_group_id").val()+"&status="+$("#status").val();
}
function Batch()
{
	var data = $("#myForm").formToArray(); 
	if($("input[name='more']:checked").val()=="0")
	{
		msg = "删除";
	}
	else
	{
		msg = "移动";
	}
	
	if(confirm("您确认"+msg+"选中的会员吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'customer'|encrypt}}&a=batch",
				data: data,
				success: function(msg){ 
						alert("操作成功");
						location.href= "?m={{'customer'|encrypt}}";
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
    <h1 style="background:url(/admin/images/customer.png) no-repeat; overflow:hidden; width:160px">会员列表</h1>
    <div class="buttons"><a onclick="Add();" class="button"><span>添加新会员</span></a></div>
   
  </div>   
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">会员名称/用户名</td>
            <td class="left">Email</td>
            <td class="right">会员等级</td>
            <td class="left">状态</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        <tr class="filter">
            <td width="1" style="text-align: center;"></td>
            <td class="left"><input type="text" value="{{$smarty.get.username}}" id="username"></td>
            <td class="left"><input type="text" value="{{$smarty.get.email}}" id="email"></td>
            <td class="right"><select id="customer_group_id">
                             <option value="">全部</option>
						    {{html_options options=$cglist selected=$smarty.get.customer_group_id}}
						    </select></td>
            <td class="left"><select id="status">
                               <option value="">全部</option>
                                {{html_options options=$statuslist selected=$smarty.get.status}}
                              </select></td>
            <td class="right"><a onclick="go();" class="button"><span>搜索</span></a></td>
          </tr>
       
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
          <td style="text-align: center;">              <input type="checkbox" name="selected[]" value="{{$logs[data].id}}" />
              </td>
             <td class="left"><a href="?m={{'customer'|encrypt}}&a=detail&uid={{$logs[data].id}}" target="_blank">{{$logs[data].truename}} <br/>{{$logs[data].username}}</a></td>
            <td class="left">{{$logs[data].email}}</td>
            <td class="right">{{$logs[data].customer_group_id}}</td>
            <td class="left">{{$logs[data].status}}</td>
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
      <div class="buttons">
       <table style="border-width:0px 0px medium;"><tr><td style="border:0px solid">
          <select name="class_id">{{html_options options=$catelist selected=$smarty.get.status}}</select>&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="1" checked>移动&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="0">删除&nbsp; &nbsp; 
          <a onclick="Batch();" class="button"><span>操作</span></a>
		  </td><td style="border:0px solid">
			</td></tr></table>{{include file=admin/pages.tpl}} 
      <div style="clear:both"></div>
      </div>
</form>  
  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}