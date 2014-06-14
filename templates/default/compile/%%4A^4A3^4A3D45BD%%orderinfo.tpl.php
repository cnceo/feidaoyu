<?php /* Smarty version 2.6.7, created on 2012-09-20 15:00:41
         compiled from user/orderinfo.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
</div> --><div class="portlet" id="yw4">
<div class="portlet-decoration">
<div class="portlet-title">我的个人信息</div>
</div>
<div class="portlet-content">
    <ul class="operations" id="yw5">
       <!--  <li><a class="T_navAddress" href="">- 收货地址</a></li> -->
        <li><a target="_blank" class="T_navAddress" href="/user/changepassword.html">修改密码</a></li>
    </ul>
</div>
</div>		</div>
	</div>
	<!-- aside -->
	<div class="main m_order">
<!--         <div class="m_order_box">
        	<h3 id="J_changeAddress">收货地址 </h3>
            <ul id="dAddress">
                <li><span class="label">姓名：</span>杨雕</li>
                <li><span class="label">地址：</span>上海 上海市 徐汇区, 新村路423号绿地威科大厦2号楼601室</li>
                <li><span class="label">联系电话：</span>15000812371</li>
            </ul>
            海全 黑名单修改


            <div style="display:none;" id="cAddress"></div>
            <h3 id="J_changeTime">送货时间 </h3>
            <ul id="dTime">
                <li>不限</li>
            </ul>
            <div style="display:none;" id="cTime"><ul></ul></div>

                    <dt>发票详情</dt>
                        <dd><span class="label">发票类型：</span>不开发票</dd>

        </div> -->


        <table class="odr_bigtable">
            <thead>
                <tr>
                    <th colspan="3" class="cfl">
                            <span class="datetime">成交日期：<?php echo $this->_tpl_vars['log']['addtime']; ?>
</span>
                            <span>订单号：</span>
                            <a href=""><?php echo $this->_tpl_vars['log']['order_id']; ?>
</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="btd1 notd">
                        <table class="odr_smtable">
                            <tbody>
                                    <?php if (count($_from = (array)$this->_tpl_vars['logs'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
                                <tr>
                                    <td class="std1 stdd1">
                                       <div class="divorder">
                                       <?php if ($this->_tpl_vars['data']['domain']): ?><img src="/images/gwche1.jpg" /><?php else: ?><a class="mimg" href="/vps/host-<?php echo $this->_tpl_vars['data']['id']; ?>
.html" target="_blank" title="<?php echo $this->_tpl_vars['data']['cprodname']; ?>
"><img src="/images/gwche.jpg" /></a><?php endif; ?>
                                       <div class="clear"></div>
                                       </div>
                                    </td>
                                    <td class="std1 stdd2"><?php if ($this->_tpl_vars['data']['domain']):  echo $this->_tpl_vars['data']['domain'];  else:  echo $this->_tpl_vars['data']['cprodname'];  endif; ?></td>
                                    <td class="std1 stdd3"><?php echo $this->_tpl_vars['data']['vyear']; ?>
年</td>
                                    <td class="std1 stdd4"><span>&yen;<?php echo $this->_tpl_vars['data']['hprice']; ?>
</span></td>
                                </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                            </tbody>
                        </table>
                    </td>
                    <td class="btd2">
                        <span>&yen;<?php echo $this->_tpl_vars['log']['totprice']; ?>
</span>
                        <p>网银支付</p>
                    </td>
                    <td class="btd3">
                        <a  class="abtn" href="javascript:void(0)" onclick="alipay('<?php echo $this->_tpl_vars['log']['order_id']; ?>
')"  >付款</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>