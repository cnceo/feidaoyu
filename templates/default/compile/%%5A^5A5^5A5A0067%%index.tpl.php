<?php /* Smarty version 2.6.7, created on 2012-07-24 13:21:05
         compiled from admin/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/index.tpl', 6, false),array('modifier', 'string_format', 'admin/index.tpl', 111, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
function View(id)
{
	if(!id)id="";
	location.href="?m=<?php echo ((is_array($_tmp='order')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=detail&orderno="+id;
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
              <td align="right"><?php echo $this->_tpl_vars['log']['order_total']; ?>
</td>

            </tr>
            <tr>
              <td>待发货订单:</td>
              <td align="right"><?php echo $this->_tpl_vars['log']['order_total']; ?>
</td>
            </tr>
            <tr>
              <td>待支付订单:</td>

              <td align="right"><?php echo $this->_tpl_vars['log']['order_total']; ?>
</td>
            </tr>
            <tr>
              <td>商品总数:</td>
              <td align="right"><?php echo $this->_tpl_vars['log']['product_total']; ?>
</td>
            </tr>
            <tr>

              <td>库存警告商品数:</td>
              <td align="right"><?php echo $this->_tpl_vars['log']['product_warn_quantity']; ?>
</td>
            </tr>
            <tr>
              <td>已成交订单数:</td>
              <td align="right"><?php echo $this->_tpl_vars['log']['order_succeed']; ?>
</td>
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
            <?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['logs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['data']['show'] = true;
$this->_sections['data']['max'] = $this->_sections['data']['loop'];
$this->_sections['data']['step'] = 1;
$this->_sections['data']['start'] = $this->_sections['data']['step'] > 0 ? 0 : $this->_sections['data']['loop']-1;
if ($this->_sections['data']['show']) {
    $this->_sections['data']['total'] = $this->_sections['data']['loop'];
    if ($this->_sections['data']['total'] == 0)
        $this->_sections['data']['show'] = false;
} else
    $this->_sections['data']['total'] = 0;
if ($this->_sections['data']['show']):

            for ($this->_sections['data']['index'] = $this->_sections['data']['start'], $this->_sections['data']['iteration'] = 1;
                 $this->_sections['data']['iteration'] <= $this->_sections['data']['total'];
                 $this->_sections['data']['index'] += $this->_sections['data']['step'], $this->_sections['data']['iteration']++):
$this->_sections['data']['rownum'] = $this->_sections['data']['iteration'];
$this->_sections['data']['index_prev'] = $this->_sections['data']['index'] - $this->_sections['data']['step'];
$this->_sections['data']['index_next'] = $this->_sections['data']['index'] + $this->_sections['data']['step'];
$this->_sections['data']['first']      = ($this->_sections['data']['iteration'] == 1);
$this->_sections['data']['last']       = ($this->_sections['data']['iteration'] == $this->_sections['data']['total']);
?>
              <tr>
            <td class="center"><a href="?m=<?php echo ((is_array($_tmp='order')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=detail&orderno=<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['orderno']; ?>
" target="_blank"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['orderno']; ?>
</a></td>
            <td class="left"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['contact']; ?>
<br> <?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['mobile']; ?>
 </td>
            <td class="right"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['quantity']; ?>
<br>￥<?php echo ((is_array($_tmp=$this->_tpl_vars['logs'][$this->_sections['data']['index']]['price_total'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
            <td class="left"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['province']; ?>
 <?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['city']; ?>
 <?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['county']; ?>
 <?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['address']; ?>
 <br> <?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['telphone']; ?>
</td>
            <td class="center"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['status']; ?>
</td>
            <td class="center"><a href="#" onclick="View('<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['orderno']; ?>
');">查看</a></td>
             <td class="center"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['createtime']; ?>
</td>
          </tr>
           <?php endfor; else: ?>
          <tr>
            <td colspan="8" class="center">No results!</td>
          </tr>
        <?php endif; ?>
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>