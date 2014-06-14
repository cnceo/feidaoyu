{{include file=global/header.tpl}}
<script>
function alipay(orderid)
{
	location.href="/user/payment.html&order_id="+orderid;
	}
</script>
<div class="headborder"></div>

<div id="container" class="cfl">
	<div class="aside">
		<div class="nav">
			<div class="portlet" id="yw0">
            <div class="portlet-decoration">
                <div class="portlet-title">我的订单</div>
            </div>
            <div class="portlet-content">
                <ul class="operations" id="yw1">
                    <li><a class="T_navChange" href="/user/vps.html">主机管理</a></li>
                    <li><a class="T_navChange" href="/user/domain.html">域名管理</a></li>
                     <li><a class="T_navOrder" href="/user/order.html">交易订单</a></li>
                </ul>
            </div>
        </div>

<!-- <div class="portlet" id="yw2">
<div class="portlet-decoration">
<div class="portlet-title">我的售后服务单</div>
</div>
<div class="portlet-content">
    <ul class="operations" id="yw3">
        <li><a class="T_navChange" href="">- 换货单</a></li>
        <li><a class="T_navChange" href="">- 退款单</a></li>
        <li><a class="T_customerservice" href="">- 维修单</a></li>
        <li><a class="T_customerservice" href="">- 预约服务单</a></li>
    </ul>
</div>
</div> -->


<div class="portlet" id="yw4">
<div class="portlet-decoration">
<div class="portlet-title">我的个人信息</div>
</div>
<div class="portlet-content">
    <ul class="operations" id="yw5">
  <!--       <li><a class="T_navAddress" href="">- 收货地址</a></li> -->
        <li><a target="_blank" class="T_navAddress" href="/user/changepassword.html">修改密码</a></li>
    </ul>
</div>
</div>
</div>
</div>
	<!-- aside -->

	<div class="main">
	{{foreach from=$logs item=data}}
		<table class="odr_bigtable">
	<thead>
		<tr>
			<th colspan="3" class="cfl">
					<span class="datetime">成交日期：{{$data.addtime}}</span>
					<span>订单号：</span>
					<a href="">{{$data.order_id}}</a>
            </th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="btd1 notd">
			    <table class="odr_smtable">
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
				</table>
            </td>
			<td class="btd2">
				<span>&yen;{{$data.totprice}}</span>
                <p>网银支付</p>
			</td>
			<td class="btd3">
				<a  class="abtn" href="javascript:void(0)" {{if $data.payflag=='1'}}onclick="alipay('{{$data.order_id}}')"{{/if}}>{{$data.payflagname}}</a><a href="/user/order.html&a=orderinfo&order_id={{$data.order_id}}" class="agray">订单详情</a>
            </td>
		</tr>
	</tbody>
</table>
{{foreachelse}}
暂无订单
{{/foreach}}
<style type="text/css">
ul.yiiPager .hidden a,ul.yiiPager a:link, ul.yiiPager a:visited {
    border: none;
    color: #888888;
}
.yiiPager li.selected a {
    background: none repeat scroll 0 0 #B8B8BA;
    color: #FFFFFF;
}
 </style>
<div class="acc_page" >
   </div>
	</div>
	<!-- main -->
</div>
{{include file=global/footer.tpl}}
