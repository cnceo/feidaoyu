<?php /* Smarty version 2.6.7, created on 2012-10-10 14:35:45
         compiled from admin/order_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/order_detail.tpl', 10, false),array('function', 'html_options', 'admin/order_detail.tpl', 82, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
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
				url:  "?m=<?php echo ((is_array($_tmp='order')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost",
				data: data,
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							alert("处理成功");
							window.location= '?m=<?php echo ((is_array($_tmp='order')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
';
						 }
						 else
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
  <div class="heading">
    <h1 style="background-image: url('./images/payment.png');"><?php echo $this->_tpl_vars['sites']['title']; ?>
详情</h1>
  </div>
  <div class="content">

      <div id="tab_general" style="display: block;">
			          <table class="form">
			            <tbody>
			            <tr>
			              <td> 订单编号:</td>
			              <td><?php echo $this->_tpl_vars['log']['order_id']; ?>
</td>
			            </tr>
			            <tr>
			              <td> 创建时间:</td>
			              <td><?php echo $this->_tpl_vars['log']['addtime']; ?>
</td>
			            </tr>
			            <tr>
			            <td>域名:</td>
			            <td>
			            <?php if (count($_from = (array)$this->_tpl_vars['logdomain'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
			            <?php echo $this->_tpl_vars['data']['domain']; ?>

			            <?php endforeach; endif; unset($_from); ?>
			            </td>
			            </tr>
			              <tr>
			            <td>主机:</td>
			            <td>
			            <?php if (count($_from = (array)$this->_tpl_vars['logvps'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
			            <?php echo $this->_tpl_vars['data']['cprodname']; ?>

			            <?php endforeach; endif; unset($_from); ?>
			            </td>
			            </tr>
			 <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['log']['id']; ?>
">
			<tr>
			<td>处理状态</td>
			<td><select id="payflag" name="payflag">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['payflaglist'],'selected' => $this->_tpl_vars['log']['payflag']), $this);?>

                              </select></td>
			</tr>
        </tbody></table>
      </div>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>

</div>

</div></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>