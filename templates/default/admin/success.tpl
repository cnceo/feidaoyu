{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'success'|encrypt}}&a=add&id="+id;
}
function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'success'|encrypt}}&a=del",
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
					 location.href="?m={{'success'|encrypt}}";
				 }
				 else
				{
					 alert("未知错误");
				}
				}
			});
		}
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

	if(confirm("您确认"+msg+"选中的内容吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'success'|encrypt}}&a=batch",
				data: data,
				success: function(msg){
						alert("操作成功");
						location.href= "?m={{'success'|encrypt}}&cateid="+$("#class_id").val();
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
    <h1 style="background:url(/admin/images/article.png) no-repeat; overflow:hidden; width:160px">成功案例列表</h1>
    <div class="buttons"><a onclick="Add();" class="button"><span>添加新成功案例</span></a></div>

  </div>
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="center">标题</td>
            <td class="center">内容</td>
            <td class="center">图片</td>
            <td class="center">时间</td>
            <td class="center">状态</td>
            <td class="center">操作</td>
          </tr>
        </thead>
        <tbody>
         </form>
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
          <td style="text-align: center;">              <input type="checkbox" name="selected[]" value="{{$logs[data].id}}" />
              </td>
            <td class="left"><a href="/{{$logs[data].classname}}/{{$logs[data].id}}.html" target="_blank">{{$logs[data].title}}</a></td>
            <td class="left">{{$logs[data].content|truncate:60:"UTF-8":""}}</td>
            <td class="center"><img alt="{{$logs[data].title}}" src="{{if $logs[data].picpath}}{{$smarty.const.IMG_HOST}}{{$logs[data].picpath}}.100x100.jpg{{else}}/images/no_image-100x100.jpg{{/if}}" width="90" height="90"></td>
            <td class="center">{{$logs[data].addtime}}</td>
            <td class="center">{{$logs[data].status}}</td>
            <td class="center"><a href="#" onclick="Add('{{$logs[data].id}}','{{$logs[data].addtime}}');">修改</a> |
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
          <select name="class_id">{{$catelist}}</select>&nbsp; &nbsp;
          <input type="radio" name="more" id="more" value="1" checked>移动&nbsp; &nbsp;
          <input type="radio" name="more" id="more" value="0">删除&nbsp; &nbsp;
          <a onclick="Batch();" class="button"><span>操作</span></a>
		  </td><td style="border:0px solid">
			</td></tr></table>{{include file=admin/pages.tpl}}
      <div style="clear:both"></div>
      </div>

  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}