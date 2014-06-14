<?php /* Smarty version 2.6.7, created on 2012-10-11 11:45:55
         compiled from admin/order_vps.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/order_vps.tpl', 7, false),array('function', 'html_options', 'admin/order_vps.tpl', 44, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">


function go()
{
	location.href = "?m=<?php echo ((is_array($_tmp='order')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=vps&order_id="+$("#order_id").val()+"&email="+$("#email").val()+"&host="+$("#host").val()+"&status="+$("#status").val();
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
            <td class="left">联系人</td>
            <td class="center">主机</td>
            <td class="center">有效期</td>
            <td class="center">状态</td>
            <td class="center">操作</td>
            <td class="center">创建时间</td>
          </tr>
        </thead>
        <tbody>
        <tr class="filter">
            <td width="1" style="text-align: center;"></td>
            <td class="left"><input type="text" value="<?php echo $_GET['order_id']; ?>
" id="order_id" size="10"></td>
            <td class="left"><input type="text" value="<?php echo $_GET['email']; ?>
" id="email"></td>
            <td class="left"><input type="text" value="<?php echo $_GET['host']; ?>
" id="host"></td>
            <td></td>
            <td class="center"><select id="status">
                                 <option value="">全部</option>
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['vpsstatus'],'selected' => $_GET['status']), $this);?>

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
            <td class="left"><?php echo $this->_tpl_vars['data']['order_id']; ?>
</td>
            <td class="left"><?php echo $this->_tpl_vars['data']['email']; ?>
</td>
            <td class="left"><?php echo $this->_tpl_vars['data']['cprodname']; ?>
</td>
            <td class="left"><?php echo $this->_tpl_vars['data']['year']; ?>
年</td>
            <td class="center"><?php if ($this->_tpl_vars['data']['status'] == 1): ?>已付款<?php elseif ($this->_tpl_vars['data']['status'] == 2): ?>已经开通<?php else: ?>未付款<?php endif; ?></td>
            <td class="center"><a href="?m=<?php echo ((is_array($_tmp='order')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=vps_detail&id=<?php echo $this->_tpl_vars['data']['id']; ?>
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