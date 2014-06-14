<?php /* Smarty version 2.6.7, created on 2012-09-25 19:22:32
         compiled from user/opendomain.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'user/opendomain.tpl', 15, false),)), $this); ?>
<div>
<table>
<input type="hidden" name="domain" id="domains<?php echo $this->_tpl_vars['log']['id']; ?>
" value="<?php echo $this->_tpl_vars['log']['domain']; ?>
">
<input type="hidden" name="hid" id="hid<?php echo $this->_tpl_vars['log']['id']; ?>
" value="<?php echo $this->_tpl_vars['log']['id']; ?>
">
<?php if (count($_from = (array)$this->_tpl_vars['domainlist'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
<tr>
<td><?php echo $this->_tpl_vars['data']['domain']; ?>
</td>
<td><?php echo $this->_tpl_vars['data']['host']; ?>
--<?php echo $this->_tpl_vars['data']['order']; ?>
</td>
<td><a href="javascript:void(0)" onclick="canceldomain('<?php echo $this->_tpl_vars['data']['domain']; ?>
',<?php echo $this->_tpl_vars['data']['id']; ?>
)" >取消绑定</a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr><td><input type="text" name="wdomain" id="wdomain<?php echo $this->_tpl_vars['log']['id']; ?>
">.<?php echo $this->_tpl_vars['log']['domain']; ?>
</td>
<td>
<select name="opendomain" id="opendomain<?php echo $this->_tpl_vars['log']['id']; ?>
">
               <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['vpslist']), $this);?>

             </select></td>
             <td><a href="javascript:void(0)" onclick="binding(<?php echo $this->_tpl_vars['log']['id']; ?>
)" >绑定</a></td>
             <tr>
</table>
</div>