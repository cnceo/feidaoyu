<?php /* Smarty version 2.6.7, created on 2012-07-24 13:22:03
         compiled from admin/customer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/customer.tpl', 6, false),array('function', 'html_options', 'admin/customer.tpl', 98, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=add&id="+id;
}

function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=del",
				data: "id="+id,
				success: function(msg){ 
				 if (msg=='error')
				 {
					 alert("保存失败");
				 }
				 else if (msg=='Permission denied')
					 {
						 alert("权限限制");
					 }
				 else if (msg=='succeed')
				 {
					 location.href="?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
";
				 }
				 else
				{
					 alert("未知错误");
				}    
				}   
			});   
		}
}
function go()
{
	location.href = "?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&username="+$("#username").val()+"&email="+$("#email").val()+"&customer_group_id="+$("#customer_group_id").val()+"&status="+$("#status").val();
}
function Batch()
{
	var data = $("#myForm").formToArray(); 
	if($("input[name='more']:checked").val()=="0")
	{
		msg = "删除";
	}
	else
	{
		msg = "移动";
	}
	
	if(confirm("您确认"+msg+"选中的会员吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=batch",
				data: data,
				success: function(msg){ 
						alert("操作成功");
						location.href= "?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
";
				} 
			}); 
		}
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
    <h1 style="background:url(/admin/images/customer.png) no-repeat; overflow:hidden; width:160px">会员列表</h1>
    <div class="buttons"><a onclick="Add();" class="button"><span>添加新会员</span></a></div>
   
  </div>   
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">会员名称/用户名</td>
            <td class="left">Email</td>
            <td class="right">会员等级</td>
            <td class="left">状态</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        <tr class="filter">
            <td width="1" style="text-align: center;"></td>
            <td class="left"><input type="text" value="<?php echo $_GET['username']; ?>
" id="username"></td>
            <td class="left"><input type="text" value="<?php echo $_GET['email']; ?>
" id="email"></td>
            <td class="right"><select id="customer_group_id">
                             <option value="">全部</option>
						    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cglist'],'selected' => $_GET['customer_group_id']), $this);?>

						    </select></td>
            <td class="left"><select id="status">
                               <option value="">全部</option>
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statuslist'],'selected' => $_GET['status']), $this);?>

                              </select></td>
            <td class="right"><a onclick="go();" class="button"><span>搜索</span></a></td>
          </tr>
       
         <form id="myForm" name="myForm" action="" method="post">
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
          <td style="text-align: center;">              <input type="checkbox" name="selected[]" value="<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
" />
              </td>
             <td class="left"><a href="?m=<?php echo ((is_array($_tmp='customer')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=detail&uid=<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['truename']; ?>
 <br/><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['username']; ?>
</a></td>
            <td class="left"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['email']; ?>
</td>
            <td class="right"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['customer_group_id']; ?>
</td>
            <td class="left"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['status']; ?>
</td>
            <td class="right"><a href="#" onclick="Add('<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
','<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['addtime']; ?>
');">修改</a> |
	        	            <a href="#" onclick="Del('<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
');"  alt="Cancel"> 删   除 </a> | 
	        	             <a href="#" onclick="Add('<?php echo $this->_tpl_vars['sites']['ttype']; ?>
');">新加</a></td>
          </tr>
           <?php endfor; else: ?>
          <tr>
            <td colspan="7" class="center">No results!</td>
          </tr>
        <?php endif; ?>
                            </tbody>
      </table>
      <div class="buttons">
       <table style="border-width:0px 0px medium;"><tr><td style="border:0px solid">
          <select name="class_id"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['catelist'],'selected' => $_GET['status']), $this);?>
</select>&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="1" checked>移动&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="0">删除&nbsp; &nbsp; 
          <a onclick="Batch();" class="button"><span>操作</span></a>
		  </td><td style="border:0px solid">
			</td></tr></table><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/pages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
      <div style="clear:both"></div>
      </div>
</form>  
  </div>
</div>
</div></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>