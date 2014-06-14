<?php /* Smarty version 2.6.7, created on 2012-07-26 14:55:15
         compiled from admin/msg_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/msg_add.tpl', 38, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="js/editor/tiny_mce.js"></script>
<script type="text/javascript" src="js/editor/editor_full.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		title: {
	    			required: true
	    		},
	    		content: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    title: {
    		    	required: "请填写标题"
	    		},
	    		content: {
    		    	required: "请填写内容"
	    		}
    	      },
		showErrors:function(errorMap,errorList){
			        $(".warning").css('display','block');
			        $(".warning").html("带*为必填项，共有 " + this.numberOfInvalids() + " 错误，请仔细检查！");
			        this.defaultShowErrors();
			   }

   	 });
});

       $.validator.setDefaults({
			 submitHandler: function() {
			 	tinyMCE.triggerSave(false, false);
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m=<?php echo ((is_array($_tmp='success')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=savePost",
						data: data,
						dataType: 'json',
						success: function(msg){

							    if(msg.status == "true")
								    {
										   window.location= '?m=<?php echo ((is_array($_tmp='success')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
';
								    }
								    else
								    {
								    	$(".warning").html(msg.message);
								    	$(".warning").css('display','block');
								    }
						   }
					});
			}

		});

	function Back()
	{
		
			history.go(-1);
		
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
    <h1 style="background-image: url('./images/payment.png');"><?php if ($this->_tpl_vars['log']['id'] == ""): ?>添加<?php else: ?>修改<?php endif;  echo $this->_tpl_vars['sites']['title']; ?>
</h1>
    <div class="buttons">

    <a onclick="Back();" class="button"><span>返回</span></a></div>

  </div>
  <div class="content">
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['log']['id']; ?>
">
      <div id="tab_general" style="display: block;">
	<table class="form">
		<tbody>
				<tr>
			         <td><span class="required"></span> 留言人:</td>
			          <td> <?php echo $this->_tpl_vars['log']['name']; ?>
    </td>
			     </tr>
			      <tr>
			           <td>留言内容:</td>
			           <td><?php echo $this->_tpl_vars['log']['content']; ?>
</td>
			       </tr>
          		<tr>
            		<td>电话:</td>
            		<td><?php echo $this->_tpl_vars['log']['tel']; ?>
</td>
          		</tr>
          		<tr>
            		<td>邮箱:</td>
            		<td><?php echo $this->_tpl_vars['log']['email']; ?>
</td>
          		</tr>
           		<tr>
            		<td>状态:</td>
            		<td><?php echo $this->_tpl_vars['log']['type']; ?>
</td>
          		</tr>
          		
          		
        </tbody>
      </table>

      </div>
    </form>
     <div class="buttons">
     <a onclick="Back();" class="button"><span>返回</span></a></div>
     <div style="clear:both"></div>
  </div>

</div>

</div></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>