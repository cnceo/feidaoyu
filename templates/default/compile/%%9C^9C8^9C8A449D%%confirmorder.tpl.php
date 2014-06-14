<?php /* Smarty version 2.6.7, created on 2012-09-20 16:55:58
         compiled from user/confirmorder.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strtolower', 'user/confirmorder.tpl', 81, false),array('modifier', 'replace', 'user/confirmorder.tpl', 81, false),array('function', 'html_options', 'user/confirmorder.tpl', 100, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
    $.validator.setDefaults({
    	 submitHandler: function() {
    	 	var data = $("#myForm").formToArray();
    				$.ajax({
    				type: "POST",
    				url:  "/user/order.html&a=book",
    				data: data,
    				dataType: 'json',
    				success: function(msg){
    					    if(msg.status == "true")
    						   {
    								  location.href = "/user/checkout.html&order_id="+msg.order_id;
    						    }
    						    else if(msg.status == "nologin")
    						    {
    						    	location.href = "/user/login.html?baseurl="+msg.order_id;
    						    }else
    						    {
    						    	alert(msg.message);
    						    }
    				   }
    			});
    	}
    });

    $(document).ready(function(){

       	   $("#myForm").validate({
        	rules: {
        	      },
        	 messages: {
        	      }
       	 });
    });

    function goo(obj)
    {
      obj.disabled =true;
      document.getElementById("submit").style.backgroundColor = "#ccc";
      document.getElementById("submit").value="正在处理";
      $('#myForm').submit();
    }
	</script>
<div class="headborder"></div>

<div class="breadcrumbs">
<a href="/">飞刀鱼首页</a> <span class='separator'>></span> <span>确认订单</span></div><!-- breadcrumbs -->

        <div id="container">
	<div class="shopCarbag">
	<ul class="cfl">
		<li class="item1"><span>1</span>购物车结算</li>
		<li class="selected item2"><span>2</span>确认订单信息</li>
		<li class="item3"><span>3</span>支付订单</li>
	</ul>
</div>
<div class="flash-success xmcart_message" style="display:none" id="flash-success"></div>
<div class="shopCarBox" id="shopCarBox">
    	<div class="shopCar_titIcon">
		<h2 class="shopCarTit" title="我的购物车">订单信息</h2>
	</div>
	<ul class="shopCartname cfl">
		<li class="item1">商品名称</li>
		<li class="item2">单品价格</li>
		<li class="item3">年限</li>
		<li class="item4">小计</li>
		<!-- <li class="item5">操作</li> -->
	</ul>
	<ul class="shopCarUl">

<li class="  shopCarLi" >
 <form id="myForm" name="myForm" method="post" >
 <input type="hidden" name="payflag" value="1" />
<?php if (count($_from = (array)$this->_tpl_vars['shopcart'])):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['data']):
?>
	<div class="shopCarLi_box cfl">
			<p class="mi_goods_pic" >
                  				<a href="/vps/<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data']['classname'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
-<?php echo $this->_tpl_vars['data']['id']; ?>
.html" target="_blank">
					<img src="/images/<?php if ($this->_tpl_vars['data']['ptype'] == 'vps'): ?>gwche<?php else: ?>gwche1<?php endif; ?>.jpg" />
				</a>
			</p>
			<p class="mi_goods_name">
			<?php if ($this->_tpl_vars['data']['ptype'] == 'vps'): ?>
                <a href="/product/<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data']['classname'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
-<?php echo $this->_tpl_vars['data']['id']; ?>
.html" target="_blank" target="_blank"><strong><?php echo $this->_tpl_vars['data']['cprodname']; ?>
</strong></a>
                <span>编号：<?php echo $this->_tpl_vars['data']['id']; ?>
</span>
                <?php else: ?>
                <strong><?php echo $this->_tpl_vars['data']['domain']; ?>
</strong>
                <?php endif; ?>
               <!--  <span class="mi_goods_name_showPacket" animateid="1">展开详情</span> -->
			</p>
            <p class="mi_cellPrice">
                &yen;<span><?php echo $this->_tpl_vars['data']['price']; ?>
</span>
            </p>
		    <p class="mi_selectNum">
		    <?php echo $this->_tpl_vars['data']['year']; ?>
年
		    <input name="year" type="hidden" value="<?php echo $this->_tpl_vars['data']['year']; ?>
">
               <!--  <select name="year" id="year_<?php echo $this->_tpl_vars['k']; ?>
" onchange = "addyear('<?php echo $this->_tpl_vars['k']; ?>
','<?php echo $this->_tpl_vars['data']['price']; ?>
')"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['yearlist'],'selected' => $this->_tpl_vars['data']['year']), $this);?>
</select> -->
            </p>
            <p class="mi_cellTotalprice">
                &yen;<span><?php echo $this->_tpl_vars['data']['tprice']; ?>
</span>
            </p>
          <!--   <p class="mi_del_order"><a  href="javascript:void(0)" onclick="delProduct('<?php echo $this->_tpl_vars['k']; ?>
');">删除</a></p> -->
    </div>
    <?php endforeach; else: ?>
    暂无产品
    <?php endif; unset($_from); ?>
    <span class='shopCarLi_package_icon'></span>
</li>
</ul>
<ul class="shopCarTotal cfl">
    <!-- <li class="item1"><a class="T_emptyCart bnt_blue_1" href="javascript:void(0)" onclick="clearCart()">清空购物车</a></li> -->
    <li class="item2">商品金额合计： <strong>&yen;<span><?php echo $this->_tpl_vars['totalprice']; ?>
</span></strong></li>
</ul>

	<ul class="shopCarCheck cfl">
		<li class="item1">
			<!-- <span>在线支付满200元免运费</span><br/> -->

    	</li>
	   <li class="item2 cfl" style="width:auto;">
			<input type="button" class="shopBtn" id="submit" value="确认,下一步 " onclick="goo(this)"><!-- <a class="proCon_form_box_btnNogoods" href="/">继续购买配件</a> -->
       </li>
	</ul>
	<input type="hidden" name="totprice" value="<?php echo $this->_tpl_vars['totalprice']; ?>
">
	</form>
    </div>

<div id="promotion_mi">
    </div>

</div>





<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>