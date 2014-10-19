{{include file=global/header.tpl}}
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
function clearCart(){
	 if(confirm("确认清空购物车吗？"))
		{
	$.ajax({
		type: "POST",
		url:  "/cart.html&a=clearCart",
		data: "time="+new Date(),
		dataType: 'json',
		success: function(msg){
			location.href="/";
		   }
	});
		}
	}

function delProduct(k){
	 if(confirm("确认删除吗？"))
		 {
	$.ajax({
	type: "POST",
	url:  "/cart.html&a=delProduct",
	data: "k="+k,
	dataType: 'json',
	success: function(msg){
		if(msg.does){
		//location.reload();
			location.href="/cart.html";
		}else {
		location.href="/";
		}
	   }
});
		 }
}

    function addyear(k,p,t)
    {
    	var y = document.getElementById("year_"+k);
    	var year = y.options[y.selectedIndex].value;
    	$.ajax({
    		type: "POST",
    		url:  "/cart.html&a=addyear",
    		data: "year="+year+"&k="+k+"&tprice="+p+"&ptype="+t,
    		dataType: 'json',
    		success: function(msg){
    			if(msg.does){
    			location.reload();
    			}else {
    			location.href="/";
    			}
    		   }
    	});
    }

    function account()
    {
    	location.href="/user/order.html&a=confirm_order";
    }
	</script>
<div class="headborder"></div>

<div class="breadcrumbs">
<a href="/">飞刀鱼首页</a> <span class='separator'>></span> <span>我的购物车</span></div><!-- breadcrumbs -->

        <div id="container">
	<div class="shopCarbag">
	<ul class="cfl">
		<li class="selected item1"><span>1</span>购物车结算</li>
		<li class="item2"><span>2</span>填写订单信息</li>
		<li class="item3"><span>3</span>支付/确定订单</li>
	</ul>
</div>
<div class="flash-success xmcart_message" style="display:none" id="flash-success"></div>
<div class="shopCarBox" id="shopCarBox">
    	<div class="shopCar_titIcon">
		<h2 class="shopCarTit" title="我的购物车">我的购物车</h2>
	</div>
	<ul class="shopCartname cfl">
		<li class="item1">商品名称</li>
		<li class="item2">单品价格</li>
		<li class="item3">年限</li>
		<li class="item4">小计</li>
		<li class="item5">操作</li>
	</ul>
	<ul class="shopCarUl">

<li class="  shopCarLi" >
 <form id="myForm" name="myForm" method="post">
 <input type="hidden" name="payflag" value="1" />
{{foreach from=$shopcart item=data key=k}}
	<div class="shopCarLi_box cfl">
			<p class="mi_goods_pic" >
                <a href="" target="_blank">
					<img src="images/{{if $data.ptype=='vps'}}gwche{{else}}gwche1{{/if}}.jpg" />
				</a>
			</p>
			<p class="mi_goods_name">
			{{if $data.ptype=='vps'}}
                <a href="/product/{{$data.classname|strtolower|replace:' ':'-'}}-{{$data.id}}.html" target="_blank" target="_blank"><strong>{{$data.cprodname}}</strong></a>
                <span>编号：{{$data.id}}</span>
                {{else}}
                <strong>{{$data.domain}}</strong>
                {{/if}}
               <!--  <span class="mi_goods_name_showPacket" animateid="1">展开详情</span> -->
			</p>
            <p class="mi_cellPrice">
                &yen;<span>{{$data.price}}</span>
            </p>
		    <p class="mi_selectNum">
                <select name="year" id="year_{{$k}}" onchange = "addyear('{{$k}}','{{$data.price}}','{{$data.ptype}}')">{{html_options options=$yearlist selected=$data.year}}</select> {{if $data.ptype=='vps'}} <br />3年<span class="yellow"> 8 </span>折<br />2年<span class="yellow"> 8.5 </span>折&nbsp;{{/if}}
            </p>
            <p class="mi_cellTotalprice">
                &yen;<span>{{$data.tprice}}</span>
            </p>
            <p class="mi_del_order"><a  href="javascript:void(0)" onclick="delProduct('{{$k}}');">删除</a></p>
    </div>
    {{foreachelse}}
    暂无产品
    {{/foreach}}
    <span class='shopCarLi_package_icon'></span>
</li>
</ul>
<ul class="shopCarTotal cfl">
    <li class="item1"><a class="T_emptyCart bnt_blue_1" href="javascript:void(0)" onclick="clearCart()">清空购物车</a></li>
    <li class="item2">商品金额合计： <strong>&yen;<span>{{$totalprice}}</span></strong></li>
</ul>

	<ul class="shopCarCheck cfl">
            <li class="item1">
			<!-- <span>在线支付满200元免运费</span><br/> -->
            </li>
	   <li class="item2 cfl">
			<a class="shopBtn" id="mi_checkout" href="javascript:void(0)" {{if $cartcount>0}}onclick="account()";{{/if}}>去结算</a><a class="proCon_form_box_btnNogoods" href="/">继续购买产品</a>
            </li>
	</ul>
	<input type="hidden" name="totprice" value="{{$totalprice}}">
	</form>
    </div>

<div id="promotion_mi">
    </div>

</div>





{{include file=global/footer.tpl}}