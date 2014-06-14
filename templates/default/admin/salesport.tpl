{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.date1').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">    
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/order.png) no-repeat; overflow:hidden; width:160px">销售报表</h1>   
  </div>   
  
  <div class="content">
    <div style="background: none repeat scroll 0% 0% rgb(231, 239, 239); border: 1px solid rgb(198, 215, 215); padding: 3px; margin-bottom: 15px;">
      <table cellspacing="0" cellpadding="6" width="100%">
        <form id="myForm" name="myForm" action="" method="GET">
      <input type="hidden" name="m" value="{{'salesport'|encrypt}}">
        <tbody><tr>
          <td>开始时间:<br>
            <input type="text" style="margin-top: 4px;" size="12" id="date_start" value="{{$smarty.get.date_start}}" name="date_start" class="date1"></td>
          <td>结束时间:<br>
            <input type="text" style="margin-top: 4px;" size="12" id="date_end" value="{{$smarty.get.date_end}}" name="date_end" class="date1"></td>
          <td>分组:<br>
            <select style="margin-top: 4px;" name="group">
             {{html_options options=$timeslist selected=$smarty.get.group}}
            </select></td>
          <td>订单状态:<br>
            <select style="margin-top: 4px;" name="status">
                                           <option value="">全部</option>
                                {{html_options options=$statuslist selected=$smarty.get.status}}
                              </select>
                                        </select></td>
          <td align="right"><a class="button" onclick="$('#myForm').submit();"><span>搜索</span></a></td>
        </tr>
      </tbody></form></table>
    </div>
    <table class="list">
      <thead>
        <tr>
          <td class="left">开始时间</td>
          <td class="left">结束时间</td>
          <td class="right">订单总数</td>
          <td class="right">合计金额</td>
        </tr>
      </thead>
      <tbody>
              {{section name=data loop=$logs}}          
        <tr>
          <td class="left">{{$logs[data].date_start}}</td>
          <td class="left">{{$logs[data].date_end}}</td>
          <td class="right">{{$logs[data].num}}</td>
          <td class="right">￥{{$logs[data].total|string_format:"%.2f"}}</td>
        </tr>
          {{sectionelse}}
          <tr>
            <td colspan="4" class="center">No results!</td>
          </tr>
        {{/section}}
              </tbody>
    </table>
    <div class="pagination"><div class="results"{{include file=admin/pages.tpl}} </div></div>
  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}