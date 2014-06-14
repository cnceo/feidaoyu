<?php /* Smarty version 2.6.7, created on 2012-07-24 17:36:41
         compiled from admin/category.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/category.tpl', 6, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
function Add(id)
{
	if(!id)id="";
	location.href="?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=add&id="+id;
}
function subAdd(id)
{
	if(!id)id="";
	location.href="?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=add&pid="+id;
}
function Del(id){
	 if(confirm("确认删除吗？,删除将包括所有到子项"))
		{
			$.ajax({
				type: "POST",
				url:  "?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=del",
				data: "id="+id,
				dataType: 'json', 
				success: function(msg){ 
				 if(msg.status == "true")
					 {
						 //location.href="?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
";
						 location.reload()
					 }
					 else
					{
						 alert(msg.message);
					}
				} 
			}); 
		}
}

function SaveUpdate()
{
	var data = $("#myForm").formToArray(); 
	$.ajax({
		type: "POST",
		url:  "?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=update",
		data: data,
		success: function(msg){ 
			 //location.reload();
		} 
	}); 
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
  <div class="heading">
    <h1 style="background-image: url('./images/category.png');">商品分类</h1>
    <div class="buttons"><a onclick="subAdd(<?php echo $_GET['cateid']; ?>
);" class="button"><span>添加新分类</span></a></div>

  </div>
  <div class="content">
    <form action="" method="post" id="myForm">
      <table class="list">
        <thead>
          <tr>
            <td class="left">分类名称</td>
            <td class="right">英文</td>
            <td class="right">排序</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        <?php if (count($_from = (array)$this->_tpl_vars['logs'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
       <!-- <?php if ($this->_tpl_vars['data']['prodnum'] == '0' && $this->_tpl_vars['data']['childnum'] == '0'): ?>
        <?php echo $this->_tpl_vars['data']['id']; ?>
,
        <?php endif; ?>-->
        <tr>
            <td class="left"><a href="?m=<?php echo ((is_array($_tmp='product')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&cateid=<?php echo $this->_tpl_vars['data']['id']; ?>
" title="浏览商品"><?php echo $this->_tpl_vars['data']['cname']; ?>
</a>(商品:<a href="?m=<?php echo ((is_array($_tmp='product')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&cateid=<?php echo $this->_tpl_vars['data']['id']; ?>
" title="浏览商品" style="color:blue;"><?php echo $this->_tpl_vars['data']['prodnum']; ?>
</a>,子类:<a href="?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&cateid=<?php echo $this->_tpl_vars['data']['id']; ?>
" title="查看子类" style="color:red;"><?php echo $this->_tpl_vars['data']['childnum']; ?>
</a>)</td>
            <td class="left"><?php echo $this->_tpl_vars['data']['ename']; ?>
</td>
            <td class="right"><input name="seque[<?php echo $this->_tpl_vars['data']['id']; ?>
]" value="0" size="2"></td>
            <td class="right"><a href="#" onclick="Add('<?php echo $this->_tpl_vars['data']['id']; ?>
');"  alt="Save"> 修改 </a>
					 | 
					<a href="#" onclick="Del('<?php echo $this->_tpl_vars['data']['id']; ?>
');"> 删除 </a>
					 | 
					<a href="#" onclick="Add();"> 新加 </a>
					 | 
					<a href="#" onclick="subAdd('<?php echo $this->_tpl_vars['data']['id']; ?>
');"> 新加子类 </a>
					 | 
					<a href="?m=<?php echo ((is_array($_tmp='category')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&cateid=<?php echo $this->_tpl_vars['data']['id']; ?>
"> 查看子类 </a>
					 | 
					<a href="?m=<?php echo ((is_array($_tmp='product')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&cateid=<?php echo $this->_tpl_vars['data']['id']; ?>
"> 浏览商品 </a></td>
          </tr>
         <?php endforeach; endif; unset($_from); ?> 
                            </tbody>
      </table>
    </form>
    <div class="buttons"><a onclick="SaveUpdate();" class="button"><span>排序</span></a></div>
     <div style="clear:both"></div>
  </div>
</div>
</div></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>