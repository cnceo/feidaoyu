{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.date1').datepicker({dateFormat: 'yy-mm-dd'});
});
function autodo(val)
{
	var data = $("#myForm").formToArray(); 
	if(!$("#dodate").val())
	{
		alert("请选择时间");
		return false;
	}
	
	$.ajax({
				type: "POST",
				url:  "?m={{'product'|encrypt}}&a=autodo&do="+val,
				data: data,
				success: function(msg){ 
						alert("操作成功");
						location.href= "?m={{'product'|encrypt}}&a=auto";
				} 
			}); 
}
</script>
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">    
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/product.png) no-repeat; overflow:hidden; width:160px">商品自动上下架</h1>
    <div class="buttons"><a onclick="Add();" class="button"><span>添加新商品</span></a></div>
   
  </div>   
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">商品名称</td>
            <td class="center">上架时间</td>
            <td class="center">下架时间</td>
            <td class="right">当前状态</td>
          </tr>
        </thead>
        <tbody>
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
          <td style="text-align: center;">              <input type="checkbox" name="selected[]" value="{{$logs[data].id}}" />
              </td>
            <td class="left"><a href="/cn/product/{{$logs[data].id}}.html" target="_blank">{{$logs[data].cprodname}}</a></td>
            <td class="center">{{$logs[data].up_date}}</td>
            <td class="center">{{$logs[data].under_date}}</td>
            <td class="right">{{$logs[data].status}}</td>
          </tr>
           {{sectionelse}}
          <tr>
            <td colspan="4" class="center">No results!</td>
          </tr>
        {{/section}}
                            </tbody>
      </table>
      <div class="buttons">
       <table style="border-width:0px 0px medium;"><tr>
       <td style="border:0px solid">   
       <input type="text" name="dodate" id="dodate" value="" class="date1" />
       <a onclick="autodo(1);" class="button"><span>定时批量上架</span></a>  <a onclick="autodo(0);" class="button"><span>定时批量下架</span></a>
		  </td><td style="border:0px solid">
			</td></tr></table>{{include file=admin/pages.tpl}} 
      <div style="clear:both"></div>
      </div>
 </form>
  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}