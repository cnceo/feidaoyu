<?php /* Smarty version 2.6.7, created on 2012-07-25 11:09:58
         compiled from admin/solution.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/solution.tpl', 5, false),array('function', 'html_options', 'admin/solution.tpl', 113, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
function go()
{
	location.href = "?m=<?php echo ((is_array($_tmp='product')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&prodname="+$("#prodname").val()+"&cateid="+$("#cateid").val()+"&model="+$("#model").val()+"&brand="+$("#brand").val()+"&quantity="+$("#quantity").val()+"&status="+$("#status").val();
}
function Del(id){
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m=<?php echo ((is_array($_tmp='solution')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
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
					 location.href="?m=<?php echo ((is_array($_tmp='solution')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
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
function Batch()
{
	var data = $("#myForm").formToArray(); 
	if($("input[name='more']:checked").val()=="0")
	{
		msg = "删除";
	}
	else if($("input[name='more']:checked").val()=="3")
	{
		msg = "上架";
	}
	else if($("input[name='more']:checked").val()=="4")
	{
		msg = "下架";
	}
	else
	{
		msg = "移动";
	}
	
	if(confirm("您确认"+msg+"选中的商品吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m=<?php echo ((is_array($_tmp='product')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=batch",
				data: data,
				success: function(msg){ 
						alert("操作成功");
						if($("input[name='more']:checked").val()=="3" ||$("input[name='more']:checked").val()=="4" )
						{
							location.href= "?m=<?php echo ((is_array($_tmp='product')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&status=1";
						}
						else if($("input[name='more']:checked").val()=="4")
						{
							location.href= "?m=<?php echo ((is_array($_tmp='product')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&status=0";
						}
						else
						{
							location.href= "?m=<?php echo ((is_array($_tmp='product')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&cateid="+$("#class_id").val();
						}
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
    <h1 style="background:url(/admin/images/product.png) no-repeat; overflow:hidden; width:160px">产品与解决方案</h1>
    <div class="buttons"><a onclick="Add('<?php echo ((is_array($_tmp='solution')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
',null,'&cateid=<?php echo $_GET['cateid']; ?>
');" class="button"><span>添加方案</span></a></div>
   
  </div>   
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left">方案名称</td>
            <td class="center">图片</td>
            <td class="left">添加日期</td>
            <td class="left">状态</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        <tr class="filter">
            <td width="1" style="text-align: center;"></td>
            
            <td class="left"><input type="text" value="<?php echo $_GET['prodname']; ?>
" id="prodname"></td>
            <td class="center"></td>
            <td class="right"><input type="text" value="<?php echo $_GET['quantity']; ?>
" id="quantity" size="8"></td>
            <td class="left"><select id="status">
                                <option value="">全部</option>
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statuslist'],'selected' => $_GET['status']), $this);?>

                              </select></td>
            <td class="right"><a onclick="go();" class="button"><span>搜索</span></a></td>
          </tr>
         </form>
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
            
            <td class="left"><a href="/product/<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
.html" target="_blank"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['title']; ?>
</a></td>
            <td class="center"><?php if ($this->_tpl_vars['logs'][$this->_sections['data']['index']]['picpath']): ?><img src="<?php echo @IMG_HOST;  echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['picpath']; ?>
.100x100.jpg" alt="<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['title']; ?>
" style="padding: 1px; border: 1px solid #DDDDDD;" width="40"/><?php endif; ?></td>
            <td class="right"><span><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['addtime']; ?>
</span></td>
            <td class="left"><?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['status_name']; ?>
</td>
            <td class="right"><a href="#" onclick="Add('<?php echo ((is_array($_tmp='solution')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
','<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
');">修改</a> |
	        	            <a href="#" onclick="Del('<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
');"  alt="Cancel"> 删   除 </a> | 
	        	             <a href="#" onclick="Add('<?php echo ((is_array($_tmp='solution')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
',null,'&cateid=<?php echo $_GET['cateid']; ?>
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
          <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
          <select name="class_id" id="class_id"><?php echo $this->_tpl_vars['catelist']; ?>
</select>&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="1" checked>移动&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="0">删除&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="3">上架&nbsp; &nbsp;
          <input type="radio" name="more" id="more" value="4">下架&nbsp; &nbsp;
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