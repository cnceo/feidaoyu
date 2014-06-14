{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'parameter'|encrypt}}&a=add&view=small&cateid={{$smarty.get.cateid}}&id="+id;
}

function Remove(id,cid){
	 if(confirm("确认要移除该参数吗？本次操作将不可逆!"))
		{
			show_message();
			$.ajax({
				type: "POST",
				url:  "?m={{'parameter'|encrypt}}&a=remove",
				data: "id="+id+"&cid="+cid,
				success: function(msg){
				   hidden_message();
				   if(msg.status == "true")
				   {
				  	   location.reload();
				   }
				   else
				   {
				   	   alert(msg.message);
				   }
				}   
			});   
		}
}

function BatchRemove(){
	 if(confirm("确认要移除该参数吗？本次操作将不可逆!"))
		{
			var data = $("#myForm").formToArray();
			show_message(); 
			$.ajax({
				type: "POST",
				url:  "?m={{'parameter'|encrypt}}&a=batchremove",
				data: data,
				success: function(msg){ 
				   hidden_message();
				   if(msg.status == "true")
				   {
				  	   location.reload();
				   }
				   else
				   {
				   	   alert(msg.message);
				   }
				}   
			});   
		}
}

function go()
{
	location.href = "?m={{'parameter'|encrypt}}&a=poplist&cateid={{$smarty.get.cateid}}&name="+$("#name").val();
}

function Merge()
{
	var data = $("#myForm").formToArray(); 
	if($("#cname").val()=="")
	{
		alert("请输入合并后的参数名称");
		$("#cname").focus();
		return false;
	}
	
	
	if(confirm("您确认要合并选中的参数为"+$("#cname").val()+"吗？本次操作将不可逆!"))
		{
			show_message();
			$.ajax({
				type: "POST",
				url:  "?m={{'parameter'|encrypt}}&a=merge",
				data: data,
				success: function(msg){ 
					    hidden_message();
						//alert("操作成功");
						//location.href= "?m={{'parameter'|encrypt}}&cateid="+$("#cateid").val();
						location.reload();
				} 
			}); 
		}
}

function Seque()
{
	var data = $("#myForm").formToArray(); 
	
	if(confirm("您确认要继续操作吗？"))
		{
			show_message();
			$.ajax({
				type: "POST",
				url:  "?m={{'parameter'|encrypt}}&a=seque",
				data: data,
				success: function(msg){
					    hidden_message();
						//alert("操作成功");
						//location.href= "?m={{'parameter'|encrypt}}&cateid="+$("#cateid").val();
						location.reload();
				} 
			}); 
		}
}

function Group()
{
	var data = $("#myForm").formToArray(); 
	if($("#gname").val()=="")
	{
		alert("请输入参数组名称");
		$("#cname").focus();
		return false;
	}
	
	
	if(confirm("您确认要设置组"+$("#cname").val()+"吗？"))
		{
			show_message();
			$.ajax({
				type: "POST",
				url:  "?m={{'parameter'|encrypt}}&a=group",
				data: data,
				success: function(msg){ 
					    hidden_message();
						//alert("操作成功");
						//location.href= "?m={{'parameter'|encrypt}}&cateid="+$("#cateid").val();
						location.reload();
				} 
			}); 
		}
}
</script>
<div id="content">
<div class="box">    
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/parameter.png) no-repeat; overflow:hidden; width:160px">参数列表</h1>
    <!--<div class="buttons"><a onclick="Add();" class="button"><span>添加新参数</span></a></div>-->
  </div>   
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">参数名称</td>
            <td class="left">排序</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
         </form>
         <form id="myForm" name="myForm" action="" method="post">
         <input type="hidden" name="cateid" id="cateid" value="{{$smarty.get.cateid}}" size="20">
         <tr class="filter">
          <td style="text-align: center;"> <td class="left" colspan="4"><b>重要特征</b></td>
          </tr>
        {{foreach from=$logs.para1 item=data}}
          <tr>
          <td style="text-align: center;"> 
           <input type="checkbox" name="selected[]" value="{{$data.id}}" />
              </td>
            <td class="left">{{if $data.paragroup}}[{{$data.paragroup}}]{{/if}}{{$data.name}}</td>
             <td class="left"><input name="seque[{{$data.id}}]" value="{{$data.seque|default:'0'}}" size="2"></td>
            <td class="right"><!--<a href="#" onclick="Add('{{$data.id}}');">修改</a>
	         |<a href="#" onclick="Remove('{{$data.id}}','{{$smarty.get.cateid}}');">移除</a>--></td>
          </tr>
        {{/foreach}}
        <tr class="filter">
          <td style="text-align: center;"> <td class="left" colspan="4"><b>常规参数</b></td>
          </tr>
         {{foreach from=$logs.para2 item=data}}
          <tr>
          <td style="text-align: center;"> 
           <input type="checkbox" name="selected[]" value="{{$data.id}}" />
              </td>
            <td class="left">{{if $data.paragroup}}[{{$data.paragroup}}]{{/if}}{{$data.name}}</td>
            <td class="left"><input name="seque[{{$data.id}}]" value="{{$data.seque|default:'0'}}" size="2"></td>
            <td class="right"><!--<a href="#" onclick="Add('{{$data.id}}');">修改</a>
	        |<a href="#" onclick="Remove('{{$data.id}}','{{$smarty.get.cateid}}');">移除</a>--></td>
          </tr>
        {{/foreach}}
        <tr class="filter">
          <td style="text-align: center;"> <td class="left" colspan="4"><b>基本参数</b></td>
          </tr>
         {{foreach from=$logs.para3 item=data}}
          <tr>
          <td style="text-align: center;"> 
           <input type="checkbox" name="selected[]" value="{{$data.id}}" />
              </td>
            <td class="left">{{if $data.paragroup}}[{{$data.paragroup}}]{{/if}}{{$data.name}}</td>
            <td class="left"><input name="seque[{{$data.id}}]" value="{{$data.seque|default:'0'}}" size="2"></td>
            <td class="right"><!--<a href="#" onclick="Add('{{$data.id}}');">修改</a>
	        |<a href="#" onclick="Remove('{{$data.id}}','{{$smarty.get.cateid}}');">移除</a>--></td>
          </tr>
        {{/foreach}}
        <tr>
          <td style="text-align: center;"> <td class="left" colspan="4"><b>其他参数(机器人)</b></td>
          </tr>
         {{foreach from=$logs.para4 item=data}}
          <tr>
          <td style="text-align: center;"> 
           <input type="checkbox" name="selected[]" value="{{$data.id}}" />
              </td>
            <td class="left">{{if $data.paragroup}}[{{$data.paragroup}}]{{/if}}{{$data.name}}</td>
            <td class="left"><input name="seque[{{$data.id}}]" value="{{$data.seque|default:'0'}}" size="2"></td>
            <td class="right"><a href="#" onclick="Add('{{$data.id}}');">修改</a>
	        |<a href="#" onclick="Remove('{{$data.id}}','{{$smarty.get.cateid}}');">移除</a></td>
          </tr>
        {{/foreach}}
                            </tbody>
      </table>
       <table style="border-width:0px 0px medium;" width="100%">
        <tr><td style="border:0px solid" width="50%">   
		  </td><td style="border:0px solid;text-align:right;" width="50%">
		  <a onclick="Seque();" class="button"><span>排序</span></a><a onclick="BatchRemove();" class="button"><span>批量移除</span></a>
			</td></tr>
       <tr><td style="border:0px solid" width="50%">
          <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />全选    
		  </td><td style="border:0px solid;text-align:right;" width="50%">
		  <b>选中的参数合并为</b>&nbsp;&nbsp;&nbsp; <input type="text" name="cname" id="cname" value="" size="20">&nbsp;&nbsp;&nbsp;<a onclick="Merge();" class="button"><span>操作</span></a>
			</td></tr>
	      <tr><td style="border:0px solid" width="50%">   
		  </td><td style="border:0px solid;text-align:right;" width="50%">
		  <b>设置分组为</b>&nbsp;&nbsp;&nbsp; 
		  <select name="cid">
		  <option value="1">重要特征</option>
		  <option value="2">常规参数</option>
		  <option value="3">基本参数</option>
		  </select>
		  <input type="text" name="gname" id="gname" value="" size="20">&nbsp;&nbsp;&nbsp;<a onclick="Group();" class="button"><span>操作</span></a>
			</td></tr>
			</table>
      <div style="clear:both"></div>
       </form>
  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}