<?php /* Smarty version 2.6.7, created on 2012-09-05 15:36:53
         compiled from user/cart.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="headborder"></div>

<div class="breadcrumbs">
<a href="">小米网首页</a> <span class='separator'>></span> <span>我的购物车</span></div><!-- breadcrumbs -->
                
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
		<li class="item3">购买数量</li>
		<li class="item4">小计</li>
		<li class="item5">操作</li>
	</ul>
	<ul class="shopCarUl">
       
<li class="  shopCarLi" >
	<div class="shopCarLi_box cfl">
			<p class="mi_goods_pic" >
                  				<a href="" target="_blank">
					<img src="images/1268_1_1346410057_4.jpg" />
				</a>                       
			</p>
			<p class="mi_goods_name">
                <a href="/goods/1268" target="_blank"><strong>MI1极清高透贴膜（单片装）</strong></a>
                <span>编号：1268</span>
                <span class="mi_goods_name_showPacket" animateid="1">展开详情</span>
			</p>
            <p class="mi_cellPrice">
                &yen;<span>15</span>
            </p>
		    <p class="mi_selectNum">
                <select name="Cart[1268_0]" id="Cart_1268_0">
                    <option value="1" selected="selected">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select> 
            </p>
            <p class="mi_cellTotalprice">
                &yen;<span>15</span>
            </p>
            <p class="mi_del_order"><a  href="">删除</a></p>
    </div>
    <span class='shopCarLi_package_icon'></span>    
</li>
</ul>
<ul class="shopCarTotal cfl">
    <li class="item1"><a class="T_emptyCart bnt_blue_1" href="#">清空购物车</a></li>
    <li class="item2">商品金额合计： <strong>&yen;<span>15</span></strong></li>
</ul>
	
	<ul class="shopCarCheck cfl">
		<li class="item1">
			<span>在线支付满200元免运费</span><br/>
	     
    	</li>
	   <li class="item2 cfl">
			<a class="shopBtn" id="mi_checkout" href="">去结算</a><a class="proCon_form_box_btnNogoods" href="">继续购买配件</a>
       </li>
	</ul>
    </div>

<div id="promotion_mi">
    </div>

</div>





<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>