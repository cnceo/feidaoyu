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
				data: "id="+id+"types=voucher",
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
    <h1 style="background:url(/admin/images/keyword.png) no-repeat; overflow:hidden; width:160px">优惠券</h1>
    <div class="buttons"><a onclick="Add();" class="button"><span>添加</span></a></div>
   
  </div>   
  <div class="content">

      <table class="list">
        <thead>
          <tr>
              <td class="center">券号</td>
              <td class="center">名称</td>
              <td class="center">类型</td>
              <td class="center">订单号</td>
              <td class="center">使用会员</td>
              <td class="center">使用时间</td>
              <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
             <td class="center">{{$logs[data].vno}}</td>
              <td class="center">{{$log.cvouchername}}</td>
              <td class="center">{{$log.send_type_name}}</td>
              <td class="center">{{$log.orderno}}</td>
              <td class="center">{{$log.username}}</td>
              <td class="center">{{if $logs[data].flag>0}}{{$log.usetime}}{{else}}未使用{{/if}}</td>
              <td class="right"> <a href="#" onclick="Del('{{$logs[data].id}}');"  alt="Cancel"> 删   除 </a>
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