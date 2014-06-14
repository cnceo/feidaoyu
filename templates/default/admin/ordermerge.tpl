{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.date1').datepicker({dateFormat: 'yy-mm-dd'});
	  $("#ordernolist1").change(function(){
   	  	$("#to_order").val($("#ordernolist1").val());
        });
       $("#ordernolist2").change(function(){
   	  	$("#from_order").val($("#ordernolist2").val());
        });
});
</script>
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">    
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/order.png) no-repeat; overflow:hidden; width:160px">订单合并</h1>   
  </div>   
  <div class="content">

      <table class="list">
      <form id="myForm" name="myForm" action="" method="GET">
      <input type="hidden" name="m" value="{{'order'|encrypt}}">
        <thead>
          <tr>
            <td class="right">主订单编号</td>
            <td class="left" colspan="3"><input type="text" value="" id="to_order" name="to_order" size="20"> 	<select id="ordernolist1">
                                 <option value="">请选择</option>
                                {{html_options options=$orderlist}}
                              </select>   <br/>当两个订单不一致时，合并后的订单信息（如：支付方式、配送方式、包装、贺卡、红包等）以主订单为准。</td>
          </tr>
          <tr>
            <td class="right">从订单编号</td>
            <td class="left" colspan="3"><input type="text" value="" id="from_order" name="from_order" size="20"> 	<select id="ordernolist2">
                                 <option value="">请选择</option>
                                {{html_options options=$orderlist}}
                              </select>   <br/></td>
          </tr>
        </thead>
        <tbody>
          <tr class="filter">
            <td class="left"></td>
            <td class="left" colspan="3"><a onclick="$('#myForm').submit();" class="button"><span>合并</span></a></td>
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