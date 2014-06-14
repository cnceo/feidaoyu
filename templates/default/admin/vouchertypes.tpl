{{include file=admin/header.tpl}}
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m={{'vouchers'|encrypt}}&a=add&id="+id;
}
function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'vouchers'|encrypt}}&a=del",
				data: "id="+id+"types=vouchertype",
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
					 location.href="?m={{'vouchers'|encrypt}}";
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
              <td class="left">优惠券名称</td>
              <td class="center">发放类型</td>
              <td class="center">金额</td>
              <td class="center">订单下限</td>
              <td class="center">发放数量</td>
              <td class="center">使用数量</td>
              <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
             <td class="left">{{$logs[data].cvouchername}}</td>
              <td class="center">{{$logs[data].send_type_name}}</td>
              <td class="right">￥{{$logs[data].money|string_format:"%.2f"}}</td>
              <td class="right">￥{{$logs[data].orderamount|string_format:"%.2f"}}</td>
              <td class="center">{{$logs[data].sends}}</td>
              <td class="center">{{$logs[data].sends}}</td>
              <td class="right">{{if $logs[data].send_type!=2}}<a href="?m={{'vouchers'|encrypt}}&a=send&id={{$logs[data].id}}">发放</a> | {{/if}}<a href="?m={{'vouchers'|encrypt}}&a=viewlist&id={{$logs[data].id}}">查看</a> | <a href="#" onclick="Add('{{$logs[data].id}}','{{$logs[data].addtime}}');">修改</a> |
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