{{include file=admin/header.tpl}}
<script type="text/javascript">
function go()
{
	location.href = "?m={{'order'|encrypt}}&order_id="+$("#order_id").val()+"&email="+$("#email").val()+"&price="+$("#price").val()+"&payflag="+$("#payflag").val();
}
</script>
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/order.png) no-repeat; overflow:hidden; width:160px">到期提醒列表</h1>
  </div>
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">域名</td>
            <td class="left">创建时间</td>
             <td class="right">开始时间</td>
            <td class="center">结束时间</td>
            <!--<td class="center">操作</td>-->
       
          </tr>
        </thead>
        <tbody>
       
         <form id="myForm" name="myForm" action="" method="post">
        {{foreach from=$logs item=data}}
          <tr>
          <td style="text-align: center;">              <input type="checkbox" name="selected[]" value="{{$data.id}}" />
              </td>
            <td class="center"><a href="?m={{'order'|encrypt}}&a=detail&orderno={{$data.id}}" target="_blank">{{$data.domain}}</a></td>
            <td class="left">{{$data.addtime}}</td>
            <td class="right">{{$data.stime}}</td>
           
            <td class="center">{{$data.etime}}</td>
           <!-- <td class="center">
            查看
            </td>-->
     
          </tr>
           {{foreachelse}}
          <tr>
            <td colspan="8" class="center">No results!</td>
          </tr>
        {{/foreach}}
                            </tbody>
      </table>
        <div class="buttons">
        {{include file=admin/pages.tpl}}
      <div style="clear:both"></div>
      </div>
  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}