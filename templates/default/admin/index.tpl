{{include file="admin/header.tpl"}}
<script type="text/javascript">
function View(id)
{
	if(!id)id="";
	location.href="?m={{'order'|encrypt}}&a=detail&orderno="+id;
}
</script>




<div id="content">
<div class="breadcrumb">
    <a href="./">首页</a>

  </div>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('view/image/home.png');">控制面板</h1>
  </div>
  <div class="content">
    <div style="display: inline-block; width: 100%; margin-bottom: 15px; clear: both;">

      <div style="float: left; width: 49%;">
        <div style="background: #547C96; color: #FFF; border-bottom: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;">统计</div>
        <div style="background: #FCFCFC; border: 1px solid #8EAEC3; padding: 10px; height: 180px;">
          <table cellpadding="2" style="width: 100%;">
            <tr>
              <td width="80%">营业额:</td>
              <td align="right">￥0.00</td>

            <tr>
              <td>年度营业额:</td>
              <td align="right">￥0.00</td>
            </tr>
            <tr>
              <td>订单总数:</td>
              <td align="right">{{$log.order_total}}</td>

            </tr>
            <tr>
              <td>待发货订单:</td>
              <td align="right">{{$log.order_total}}</td>
            </tr>
            <tr>
              <td>待支付订单:</td>

              <td align="right">{{$log.order_total}}</td>
            </tr>
            <tr>
              <td>商品总数:</td>
              <td align="right">{{$log.product_total}}</td>
            </tr>
            <tr>

              <td>库存警告商品数:</td>
              <td align="right">{{$log.product_warn_quantity}}</td>
            </tr>
            <tr>
              <td>已成交订单数:</td>
              <td align="right">{{$log.order_succeed}}</td>
            </tr>

          </table>
        </div>
      </div>
      <div style="float: right; width: 49%;">
        <div style="background: #547C96; color: #FFF; border-bottom: 1px solid #8EAEC3;">
          <div style="width: 100%; display: inline-block;">
            <div style="float: left; font-size: 14px; font-weight: bold; padding: 7px 0px 0px 5px; line-height: 12px;">分析</div>
            <div style="float: right; font-size: 12px; padding: 2px 5px 0px 0px;">请选择:              <select id="range" onchange="getSalesChart(this.value)" style="margin: 2px 3px 0 0;">

                <option value="day">今日</option>
                <option value="week">本周</option>
                <option value="month">本月</option>
                <option value="year">今年</option>
              </select>
            </div>
          </div>

        </div>
        <div style="background: #FCFCFC; border: 1px solid #8EAEC3; padding: 10px; height: 49%;">
          <div id="report" style="width: 400px; height: 180px; margin: auto;"></div>
        </div>
      </div>
    </div>
    <div>
      <div style="background: #547C96; color: #FFF; border-bottom: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;">最新订单</div>

      <div style="background: #FCFCFC; border: 1px solid #8EAEC3; padding: 10px;">
        <table class="list" style="">
          <thead>
            <tr>
				<td class="center">订单编号</td>
				<td class="left">联系人/手机</td>
				<td class="right">数量/金额</td>
				<td class="center">收货地址/电话</td>
				<td class="center">状态</td>
				<td class="center">操作</td>
				<td class="center">创建时间</td>
            </tr>
          </thead>
          <tbody>
            {{section name=data loop=$logs}}
              <tr>
            <td class="center"><a href="?m={{'order'|encrypt}}&a=detail&orderno={{$logs[data].orderno}}" target="_blank">{{$logs[data].orderno}}</a></td>
            <td class="left">{{$logs[data].contact}}<br> {{$logs[data].mobile}} </td>
            <td class="right">{{$logs[data].quantity}}<br>￥{{$logs[data].price_total|string_format:"%.2f"}}</td>
            <td class="left">{{$logs[data].province}} {{$logs[data].city}} {{$logs[data].county}} {{$logs[data].address}} <br> {{$logs[data].telphone}}</td>
            <td class="center">{{$logs[data].status}}</td>
            <td class="center"><a href="#" onclick="View('{{$logs[data].orderno}}');">查看</a></td>
             <td class="center">{{$logs[data].createtime}}</td>
          </tr>
           {{sectionelse}}
          <tr>
            <td colspan="8" class="center">No results!</td>
          </tr>
        {{/section}}
                      </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!--[if IE]>
<script type="text/javascript" src="js/jquery/flot/excanvas.js"></script>
<![endif]-->

<script type="text/javascript" src="js/jquery/flot/jquery.flot.js"></script>
<script type="text/javascript"><!--
function getSalesChart(range) {
	$.ajax({
		type: 'GET',
		url: 'index.php?route=common/home/chart&token=1679091c5a880faf6fb5e6087eb1b2dc&range=' + range,
		dataType: 'json',
		async: false,
		success: function(json) {
			var option = {	
				shadowSize: 0,
				lines: { 
					show: true,
					fill: true,
					lineWidth: 1
				},
				grid: {
					backgroundColor: '#FFFFFF'
				},	
				xaxis: {
            		ticks: json.xaxis
				}
			}

			$.plot($('#report'), [json.order, json.customer], option);
		}
	});
}

getSalesChart($('#range').val());
//--></script>
</div></div>
{{include file="admin/footer.tpl"}}