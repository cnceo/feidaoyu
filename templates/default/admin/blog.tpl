{{include file=admin/header.tpl}}
<script type="text/javascript">
function Batch()
{
	var data = $("#myForm").formToArray(); 
	if(confirm("您确认选中的内容显示在首页上吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'blog'|encrypt}}&a=batch",
				data: data,
				success: function(msg){ 
						alert("操作成功");
						//location.href= "?m={{'blog'|encrypt}}";
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
    <h1 style="background:url(/admin/images/keyword.png) no-repeat; overflow:hidden; width:160px">博文列表</h1>   
  </div>   
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="center">标题</td>
            <td class="center">发布时间</td>
            <td class="center">最后修改时间</td>
          </tr>
        </thead>
        <tbody>
        
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
          <td style="text-align: center;">              <input type="checkbox" name="selected[]" value="{{$logs[data].ID}}" {{if $logs[data].flag}}checked{{/if}}/>
              </td>
            <td class="left"><a href="http://blog.mpets.com.cn/?p={{$logs[data].ID}}" target="_blank">{{$logs[data].post_title}}</a></td>
            <td class="center">{{$logs[data].post_date}}</td>
            <td class="center">{{$logs[data].post_modified}}</td>
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