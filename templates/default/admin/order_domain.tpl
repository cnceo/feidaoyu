{{include file=admin/header.tpl}}
<script type="text/javascript">
function go()
{
	location.href = "?m={{'order'|encrypt}}&a=domain&order_id="+$("#order_id").val()+"&email="+$("#email").val()+"&domain="+$("#domain").val()+"&status="+$("#status").val();
}
</script>
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/order.png) no-repeat; overflow:hidden; width:160px">订单列表</h1>
  </div>
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">订单编号</td>
            <td class="left">联系人</td>
            <td class="center">域名</td>
            <td class="center">年</td>
            <td class="center">状态</td>
            <td class="center">操作</td>
            <td class="center">创建时间</td>
          </tr>
        </thead>
        <tbody>
        <tr class="filter">
            <td width="1" style="text-align: center;"></td>
            <td class="left"><input type="text" value="{{$smarty.get.order_id}}" id="order_id" size="10"></td>
            <td class="left"><input type="text" value="{{$smarty.get.email}}" id="email"></td>
            <td class="left"><input type="text" value="{{$smarty.get.domain}}" id="domain"></td>
            <td></td>
            <td class="center"><select id="status">
                                 <option value="">全部</option>
                                {{html_options options=$domainstatus selected=$smarty.get.status}}
                              </select></td>
            <td class="center" colspan="2"><a onclick="go();" class="button"><span>搜索</span></a></td>

          </tr>
         </form>
         <form id="myForm" name="myForm" action="" method="post">
        {{foreach from=$logs item=data}}
          <tr>
          <td style="text-align: center;">              <input type="checkbox" name="selected[]" value="{{$data.id}}" />
              </td>
            <td class="left">{{$data.order_id}}</td>
            <td class="left">{{$data.email}}</td>
            <td class="left">{{$data.domain}}</td>
            <td class="left">{{$data.year}}</td>
            <td class="center">{{if $data.status==1}}已付款{{elseif $data.status==2}}已经注册{{elseif $data.status==3}}注册失败{{else}}未付款{{/if}}</td>
            <td class="center"><a href="?m={{'order'|encrypt}}&a=domain_detail&id={{$data.id}}" target="_blank" >查看</a></td>
             <td class="center">{{$data.addtime}}</td>
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