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
    <h1 style="background:url(/admin/images/order.png) no-repeat; overflow:hidden; width:160px">订单列表</h1>
  </div>
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">订单编号</td>
            <td class="left">联系人/手机</td>
             <td class="right">数量/金额</td>
            <td class="center">内容</td>
            <td class="center">状态</td>
            <td class="center">操作</td>
            <td class="center">创建时间</td>
          </tr>
        </thead>
        <tbody>
        <tr class="filter">
            <td width="1" style="text-align: center;"></td>
            <td class="left"><input type="text" value="{{$smarty.get.order_id}}" id="order_id" size="15"></td>
            <td class="left"><input type="text" value="{{$smarty.get.email}}" id="email"></td>
            <td class="right"><input type="text" value="{{$smarty.get.price}}" id="price" size="10"></td>
            <td></td>
            <td class="center"><select id="payflag">
                                 <option value="">全部</option>
                                {{html_options options=$payflaglist selected=$smarty.get.payflag}}
                              </select></td>
            <td class="center" colspan="2"><a onclick="go();" class="button"><span>搜索</span></a></td>

          </tr>
         </form>
         <form id="myForm" name="myForm" action="" method="post">
        {{foreach from=$logs item=data}}
          <tr>
          <td style="text-align: center;">              <input type="checkbox" name="selected[]" value="{{$data.id}}" />
              </td>
            <td class="center"><a href="?m={{'order'|encrypt}}&a=detail&orderno={{$data.id}}" target="_blank">{{$data.order_id}}</a></td>
            <td class="left">{{$data.email}}</td>
            <td class="right">￥{{$data.totprice|string_format:"%.2f"}}</td>
            <td class="left"><table class="odr_smtable">
					<tbody>
						<tr>
						    {{foreach from=$data.infolist item=data1}}
							<td class="std1">
							<div class="divorder"><a class="mimg" href="/vps/host-{{$data1.id}}.html" target="_blank" title="{{$data1.cprodname}}"><img src="/images/gwche.jpg" /></a></div>
							</td>
							{{/foreach}}
							  {{foreach from=$data.infos item=data1}}
							<td class="std1">
							<div class="divorder">{{$data1.domain}}</div>
							</td>
							{{/foreach}}
						</tr>
					</tbody>
				</table><br> {{$data.telphone}}</td>
            <td class="center">{{$data.payflagname}}</td>
            <td class="center"><a href="?m={{'order'|encrypt}}&a=detail&orderno={{$data.id}}" target="_blank" >查看</a></td>
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