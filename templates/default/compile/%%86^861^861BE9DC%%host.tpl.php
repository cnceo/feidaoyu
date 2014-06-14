<?php /* Smarty version 2.6.7, created on 2012-10-19 23:36:13
         compiled from admin/host.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/host.tpl', 5, false),)), $this); ?>
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
    <h1 style="background:url(/admin/images/order.png) no-repeat; overflow:hidden; width:160px">到期提醒列表</h1>
  </div>
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">域名</td>
            <td class="left">创建时间</td>
             <td class="right">开始时间</td>
            <td class="center">结束时间</td>
            <!--<td class="center">操作</td>-->
       
          </tr>
        </thead>
        <tbody>
       
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
" target="_blank"><?php echo $this->_tpl_vars['data']['domain']; ?>
</a></td>
            <td class="left"><?php echo $this->_tpl_vars['data']['addtime']; ?>
</td>
            <td class="right"><?php echo $this->_tpl_vars['data']['stime']; ?>
</td>
           
            <td class="center"><?php echo $this->_tpl_vars['data']['etime']; ?>
</td>
           <!-- <td class="center">
            查看
            </td>-->
     
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