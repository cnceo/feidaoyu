<?php /* Smarty version 2.6.7, created on 2012-07-27 18:44:14
         compiled from default/contact.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="/js/jquery/jquery.form.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	  $("#myForm").validate({
	    	rules: {
	    		    name: {
		    			required: true
		    		},
		    		tel: {
		    			required: true
		    		},
		    		email: {
		    			required: true,
		    			email:true
		    		},
		    		content: {
		    			required: true
		    		}
	    	      },
	    	 messages: {
	    		 name: {
	 		    	required: "请填写你的姓名"
	     		},
	     		tel: {
	 		    	required: "请填写联系电话"
	     		},
	     		email:{
	     			required: "请填写邮箱",
	     			email:"请输入正确的邮箱"
	     		},
	     		content:{
	     			required: "请填写留言内容"
	     		}
	    	   },
	   	 });
	});

$.validator.setDefaults({
	submitHandler: function() {
	var data = $("#myForm").formToArray();
			$.ajax({
			type: "POST",
			url:  "/?type=default&m=contact&a=savePost",
			data: data,
			dataType: 'json',
			success: function(msg){
					if(msg.status == "true")
					 {
						 alert("留言成功");
						 window.location.reload();
					 }
					 else
					{
						alert(msg.message);
					}
			   }
		});
	}
	});



function  msgOnfocus(id,val)
{
	if(val==document.getElementById(id).value)
		document.getElementById(id).value="";
}

function  msgOnblur(id,val)
{
	if(""==document.getElementById(id).value.replace(/[ ]/g,""))
		document.getElementById(id).value=val;
}
</script>
<div class="container">
  <div class="wrapper mt32 mb23">
    <div class="wrapper_t"></div>
    <div class="wrapper_c con">
    <div class="contact_main">
    <h2>联系我们</h2>
    <a href=""><img class="image4" src="/images/addmap.png" width="842" height="293" /></a>
    <h2><?php echo $this->_tpl_vars['sites']['caddress']; ?>
</h2>
    <h2>601, 423, green Wolters Kluwer International Building 2, Xin Cun Road</h2>
    <p class="word1">海大软件团队创建于2006年,由三名资深留美技术人员回国创办,并与2009年正式成立公司开始商业化运作。海大软件早期定位于展示和实践梦想，基于互联网提供简单使用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。我们以成熟的产品、专业的技术和热诚的服务态度为客户提供优质信息系统，协助企业实现管理系统化、智能化，提高企业效率，增强企业核心竞争力，让我们与客户一起成长。</p>
    <p class="word2">电话：<?php echo $this->_tpl_vars['sites']['telphone']; ?>
<br />传真：<?php echo $this->_tpl_vars['sites']['fax']; ?>
<br /> 邮箱：info@seabig.cn</p>
    <p class="word2">电话：<?php echo $this->_tpl_vars['sites']['telphone']; ?>
<br /> 电话：<?php echo $this->_tpl_vars['sites']['telphone']; ?>
<br /> 网址：<?php echo $this->_tpl_vars['sites']['http']; ?>
 </p>
    <div class="clear"></div>
    <h2>在线留言</h2>
    <form method="post" id="myForm" name="myForm">
    <input type="hidden" name="type" value="message">
    <input class="text" type="text" value="姓名：" id="name" name="name" onfocus="msgOnfocus('name','姓名：')" onblur="msgOnblur('name','姓名：');"  /><br />
    <input class="text" type="text" value="邮件：" id="email" name="email"  onfocus="msgOnfocus('email','邮件：')" onblur="msgOnblur('email','邮件：')"  /><br />
    <input class="text" type="text" value="电话：" id="tel" name="tel"  onfocus="msgOnfocus('tel','电话：')" onblur="msgOnblur('tel','电话：')"  /><br />
    <textarea class="text1" cols="20" rows="20" id="content" name="content" onfocus="msgOnfocus('content','留言：')" onblur="msgOnblur('content','留言：')">留言：</textarea>
    <button type="reset" class="button1"></button>
    <button type="submit" class="button2"></button>
    </form>
    </div>
    </div>
    <div class="wrapper_b"></div>
  </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>