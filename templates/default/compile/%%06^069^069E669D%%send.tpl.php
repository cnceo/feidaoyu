<?php /* Smarty version 2.6.7, created on 2012-09-03 10:06:05
         compiled from ask/send.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script charset="utf-8" src="js/editor/kindeditor-min.js"></script>
<script charset="utf-8" src="js/editor/lang/zh_CN.js"></script>
<script charset="utf-8" src="js/editor/kindeditor-simple.js"></script>
<script type="text/javascript">
$.validator.setDefaults({
	 submitHandler: function() {
	 	        var data = $("#myForm").formToArray();
				$.ajax({
				type: "POST",
				url:  "/user/shopping.html&a=savePost",
				data: data,
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							alert("保存成功");
						 	location.href = '/user/shopping.html';
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
				num:{
					required:true
				},
				phone:{
				    required:true
				},
				address:{
					required:true
				}
   	      },
   	 messages: {
				num: {
	    			required: "请填写数量"
	    		},
				phone: {
	    			required: "请填写联系方式"
	    		},
				address: {
	    			required: "请填写地址"
	    		}
   	 }
  	 });
});
</script>
<div class="ask-inside">
   <div class="ask-inside-t">
      <h3 class="mark">提问</h3>
   </div>
   <div class="ask-inside-b">
      <ul>
         <li><span>问题标题：</span><form><input name="" type="text" class="ask-text"/></form></li>
         <li><span>问题内容：</span><form><textarea name="" cols="" rows="" class="ask-textarea"></textarea></form></li>
         <li class="grey_dash_bg">
            <div class="setting">
                 <input name="" type="chckbox" value="" class="ask-chckbox"/><span>悬赏 </span>
                 <select>
                    <option>5分</option>
                    <option>10分</option>
                    <option>15分</option>
                    <option>20分</option>
                    <option>30分</option>
                    <option>40分</option>
                    <option>50分</option>
                 </select>
                  <input name="" type="chckbox" value="" class="ask-chckbox"/><span>紧急 </span>
                  <input name="" type="chckbox" value="" class="ask-chckbox"/><span>匿名 </span>
              </div>
         </li>
         <li class="grey_dash_bg">
              <em>标签信息：</em>
              <form><input name="" type="text" class="ask-text1"/></form>

         </li>
         <li class="grey_dash_bg"><span>问题标题：</span><a href="">自选分类</a></li>
      </ul>
   </div>
</div>

























<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>