{{include file=admin/header.tpl}}
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">    
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/order.png) no-repeat; overflow:hidden; width:160px">订单查询</h1>   
  </div>   
  <div class="content">

      <table class="list">
      <form id="myForm" name="myForm" action="" method="GET">
      <input type="hidden" name="m" value="{{'order'|encrypt}}">
      <input type="hidden" name="a" value="doprint">
        <thead>
          <tr>
            <td class="right">订单编号</td>
            <td class="left" colspan="3"><input type="text" value="" id="orderno" name="orderno" size="20"></td>
          </tr>
        </thead>
        <tbody>
          <tr class="filter">
            <td class="left"></td>
            <td class="left" colspan="3"><a onclick="$('#myForm').submit();" class="button"><span>搜索</span></a></td>
          </tr>
         </form>
      
           </tbody>
      </table>
        <div class="buttons">
      <div style="clear:both"></div>
      </div>
  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}