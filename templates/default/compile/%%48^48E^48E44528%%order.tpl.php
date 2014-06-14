<?php /* Smarty version 2.6.7, created on 2012-09-27 15:11:43
         compiled from admin/order.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/order.tpl', 5, false),array('modifier', 'string_format', 'admin/order.tpl', 53, false),array('function', 'html_options', 'admin/order.tpl', 40, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
function go()
{
	location.href = "?m=<?php echo ((is_array($_tmp='order')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&order_id="+$("#order_id").val()+"&email="+$("#email").val()+"&price="+$("#price").val()+"&payflag="+$("#payflag").val();
}
</script>
<div id="content">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/order.png) no-repeat; overflow:hidden; width:160px">订单列表</h1>
  </div>
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">订单编号</td>
            <td class="left">联系人/手机</td>
             <td class="right">数量/金额</td>
            <td class="center">内容</td>
            <td class="center">状态</td>
            <td class="center">操作</td>
            <td class="center">创建时间</td>
          </tr>
        </thead>
        <tbody>
        <tr class="filter">
            <td width="1" style="text-align: center;"></td>
            <td class="left"><input type="text" value="<?php echo $_GET['order_id']; ?>
" id="order_id" size="15"></td>
            <td class="left"><input type="text" value="<?php echo $_GET['email']; ?>
" id="email"></td>
            <td class="right"><input type="text" value="<?php echo $_GET['price']; ?>
" id="price" size="10"></td>
            <td></td>
            <td class="center"><select id="payflag">
                                 <option value="">全部</option>
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['payflaglist'],'selected' => $_GET['payflag']), $this);?>

                              </select></td>
            <td class="center" colspan="2"><a onclick="go();" class="button"><span>搜索</span></a></td>

          </tr>
         </form>
         <form id="myForm" name="myForm" action="" method="post">
        <?php if (count($_from = (array)$this->_tpl_vars['logs'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
          <tr>
          <td style="text-align: center;">              <input type="checkbox" name="selected[]" value="<?php echo $this->_tpl_vars['data']['id']; ?>
" />
              </td>
            <td class="center"><a href="?m=<?php echo ((is_array($_tmp='order')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=detail&orderno=<?php echo $this->_tpl_vars['data']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['data']['order_id']; ?>
</a></td>
            <td class="left"><?php echo $this->_tpl_vars['data']['email']; ?>
</td>
            <td class="right">￥<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['totprice'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
            <td class="left"><table class="odr_smtable">
					<tbody>
						<tr>
						    <?php if (count($_from = (array)$this->_tpl_vars['data']['infolist'])):
    foreach ($_from as $this->_tpl_vars['data1']):
?>
							<td class="std1">
							<div class="divorder"><a class="mimg" href="/vps/host-<?php echo $this->_tpl_vars['data1']['id']; ?>
.html" target="_blank" title="<?php echo $this->_tpl_vars['data1']['cprodname']; ?>
"><img src="/images/gwche.jpg" /></a></div>
							</td>
							<?php endforeach; endif; unset($_from); ?>
							  <?php if (count($_from = (array)$this->_tpl_vars['data']['infos'])):
    foreach ($_from as $this->_tpl_vars['data1']):
?>
							<td class="std1">
							<div class="divorder"><?php echo $this->_tpl_vars['data1']['domain']; ?>
</div>
							</td>
							<?php endforeach; endif; unset($_from); ?>
						</tr>
					</tbody>
				</table><br> <?php echo $this->_tpl_vars['data']['telphone']; ?>
</td>
            <td class="center"><?php echo $this->_tpl_vars['data']['payflagname']; ?>
</td>
            <td class="center"><a href="?m=<?php echo ((is_array($_tmp='order')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=detail&orderno=<?php echo $this->_tpl_vars['data']['id']; ?>
" target="_blank" >查看</a></td>
             <td class="center"><?php echo $this->_tpl_vars['data']['addtime']; ?>
</td>
          </tr>
           <?php endforeach; else: ?>
          <tr>
            <td colspan="8" class="center">No results!</td>
          </tr>
        <?php endif; unset($_from); ?>
                            </tbody>
      </table>
        <div class="buttons">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/pages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      <div style="clear:both"></div>
      </div>
  </div>
</div>
</div></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>