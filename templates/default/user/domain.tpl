{{include file=global/header.tpl}}
<script type="text/javascript" src="/js/jquery/thickbox/thickbox.min.js"></script>
<link  rel="stylesheet" type="text/css" href="/js/jquery/thickbox/thickbox.css" />
<script>
function opendomain(id)
{
	$("#opendomain").load("/user/domain.html&a=opendomain&did="+id);
}

function binding(id)
{
	var domain = document.getElementById("domains"+id).value;
	var hid = document.getElementById("hid"+id).value;
	var open = document.getElementById("opendomain"+id);
	var opendomain = open.options[open.selectedIndex].value;
	var wdomain = document.getElementById("wdomain"+id).value;
	$.ajax({
		type: "POST",
		url:  "/user/domain.html&a=savedomain",
		data: { domain:domain,opendomain:opendomain,hid:hid,wdomain:wdomain},
		dataType: 'json',
		success: function(msg){
				if(msg.status == "true")
				 {
					 alert("绑定成功!");
					 window.location.href='/user/domain.html';
				 }else if(msg.status == "false2"){
					 alert(msg.message);
				 }
				 else
				{
					alert("绑定失败");

				}
		   }
	});
	}

	function canceldomain(domain,id)
	{
		$.ajax({
			type: "POST",
			url:  "/user/domain.html&a=canceldomain",
			data: {host:domain,id:id},
			dataType: 'json',
			success: function(msg){
					if(msg.status == "true")
					 {
						 alert("取消成功!");
						 window.location.href='/user/domain.html';
					 }
					 else
					{
						alert("取消失败");

					}
			   }
		});
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
</div><!-- <div class="portlet" id="yw2">
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
</div>		</div>
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
							<td class="std2 width125">
								<span>域名:<br>{{$data.domain}}</span>
							</td>
							<td class="std2 width45">
								<span>{{$data.year}}年</span>
							</td>
							<td class="std3 width125"><span>成功日:{{$data.stime|default:"暂未开通"}}</span></td>
						</tr>
					</tbody>
				</table>
            </td>
			<td class="std3"><span>到期日:{{$data.etime|default:"暂未开通"}}</span></td>
			<td class="btd3 width75">
				{{if $data.status=='1'}}已经付款,正在注册{{elseif $data.status=='3'}}注册失败{{else}}<a href="javascript:void(0)" onclick="opendomain('{{$data.id}}')">操作</a>{{/if}}
            </td>
		</tr>
	</tbody>
</table>
 <div id="opendomain"></div>
{{foreachelse}}
暂无域名
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
