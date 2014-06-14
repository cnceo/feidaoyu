<?php /* Smarty version 2.6.7, created on 2012-10-10 14:58:44
         compiled from admin/domain_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/domain_detail.tpl', 22, false),array('function', 'html_options', 'admin/domain_detail.tpl', 90, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>

<script type="text/javascript">
$(document).ready(function(){
$('.date1').datepicker({dateFormat: 'yy-mm-dd'});
  $("#myForm").validate({
    	rules: {

    	      },
    	 messages: {
    	      }
   	 });
});

$.validator.setDefaults({
	 submitHandler: function() {
	 	      var data = $("#myForm").formToArray();
				$.ajax({
				type: "POST",
				url:  "?m=<?php echo ((is_array($_tmp='order')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost_domain",
				data: data,
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							alert("处理成功");
							window.location= '?m=<?php echo ((is_array($_tmp='order')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=domain';
						 }
						 else
						{
							alert(msg.message);
						}
				   }
			});
	}
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
			              <td><?php echo $this->_tpl_vars['order_id']; ?>
</td>
			            </tr>
			            <tr>
			              <td> 邮箱:</td>
			              <td><?php echo $this->_tpl_vars['email']; ?>
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
			            <?php echo $this->_tpl_vars['log']['domain']; ?>

			            </td>
			            </tr>
			             <form id="myForm" name="myForm" action="" method="post">
			             <tr>
			            <td>有效期:</td>
			            <td>
			            <input type="text" name="year" id="year" value="<?php echo $this->_tpl_vars['log']['year']; ?>
">年
			            </td>
			            </tr>

			              <tr>
			            <td>时间:</td>
			            <td>
			            起始日<input type="text" name="stime" class="date1" value="<?php echo $this->_tpl_vars['log']['stime']; ?>
">-到期日<input type="text" name="etime" class="date1" value="<?php echo $this->_tpl_vars['log']['etime']; ?>
">
			            </td>
			            </tr>

	            <input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['log']['id']; ?>
">
			<tr>
			<td>处理状态</td>
			<td><select id="status" name="status">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['domainstatus'],'selected' => $this->_tpl_vars['log']['status']), $this);?>

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