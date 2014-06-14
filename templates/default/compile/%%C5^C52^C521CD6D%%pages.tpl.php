<?php /* Smarty version 2.6.7, created on 2012-07-24 13:21:36
         compiled from admin/pages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/pages.tpl', 7, false),)), $this); ?>
<table cellspacing="0" class="actions">
        <tbody><tr>
                    <td class="pager">
            <?php echo $this->_tpl_vars['pages']['link']; ?>

            
            共<?php echo $this->_tpl_vars['pages']['total']; ?>
页            <span class="separator">|</span>
            每页<select onchange="loadByPagesize(this);" name="limit"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sites']['pagesize'],'selected' => $this->_tpl_vars['sites']['currentps']), $this);?>

								            </select>条      <span class="separator">|</span>      <?php echo $this->_tpl_vars['pages']['fromto']; ?>

            <span class="separator">|</span>
            共有<?php echo $this->_tpl_vars['pages']['totalnum']; ?>
个记录 <span class="separator">|</span> 跳转 <?php echo $this->_tpl_vars['pages']['jump']; ?>

                    </td>
                <td class="filter-actions a-right f-right">
                </td>
        </tr>
    </tbody></table>