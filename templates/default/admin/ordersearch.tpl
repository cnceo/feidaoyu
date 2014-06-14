{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.date1').datepicker({dateFormat: 'yy-mm-dd'});
   $("#province").change(function(){
   	  	jQuery("#city").load("?m={{'ordersearch'|encrypt}}&a=citylist&pid="+jQuery("#province").val());
   	  	jQuery("#county").html("<option value=\"\">请选择区县</option>");
        });
	  $("#city").change(function(){
   	  	jQuery("#county").load("?m={{'ordersearch'|encrypt}}&a=countylist&pid="+jQuery("#city").val());
        });
});
</script>
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
        <thead>
          <tr>
            <td class="right">订单编号</td>
            <td class="left" colspan="3"><input type="text" value="" id="orderno" name="orderno" size="20"></td>
          </tr>
           <tr>
            <td class="right">电子邮件</td>
            <td class="left" colspan="3"><input type="text" value="" id="email" name="email" size="50"></td>
          </tr>
           <tr>
            <td class="right">会员</td>
            <td class="left"><input type="text" value="" id="username" name="username" size="20"></td>
             <td class="right">收货人</td>
            <td class="left"><input type="text" value="" id="contact"  name="contact" size="20"></td>
          </tr>
          <tr>
            <td class="right">地址</td>
            <td class="left"><input type="text" value="" id="address" name="address" size="20"></td>
             <td class="right">邮编</td>
            <td class="left"><input type="text" value="" id="postcode"  name="postcode" size="20"></td>
          </tr>
          <tr>
            <td class="right">电话</td>
            <td class="left"><input type="text" value="" id="telphone" name="telphone" size="20"></td>
             <td class="right">手机</td>
            <td class="left"><input type="text" value="" id="mobile" name="mobile" size="20"></td>
          </tr>
          <tr>
            <td class="right">所在区域</td>
            <td class="left" colspan="3"><select id="province" name="province" class="region" >
				     <option value="">请选择省份</option>
				     {{html_options options=$provincelist}}
				     </select>
				     <select id="city" name="city" class="region" >
				      <option value="">请选择城市</option>
				     {{html_options options=$citylist}}
				     </select>
				     <select id="county" name="county" class="region" >
				      <option value="">请选择区县</option>
				      {{html_options options=$countylist}}
				     </select> </td>            
          </tr>
          <tr>
            <td class="right">配送方式</td>
            <td class="left" colspan="3"><select id="status">
                                 <option value="">全部</option>
                                {{html_options options=$statuslist}}
                              </select></td>            
          </tr>
          <tr>
            <td class="right">下单时间</td>
            <td class="left" colspan="3">开始<input type="text" name="starttime" id="starttime" value="" class="date1" />  结束 <input type="text" name="endtime" id="endtime" value="" class="date1" /></td>            
          </tr>
          <tr>
            <td class="right">付款状态</td>
            <td class="left" colspan="3"><select id="payflag">
                                 <option value="">全部</option>
                                {{html_options options=$payflaglist}}
                              </select></td>            
          </tr>
           <tr>
            <td class="right">订单状态</td>
            <td class="left" colspan="3"><select id="status">
                                 <option value="">全部</option>
                                {{html_options options=$statuslist}}
                              </select></td>            
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