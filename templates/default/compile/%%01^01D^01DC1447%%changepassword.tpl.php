<?php /* Smarty version 2.6.7, created on 2012-09-10 22:36:35
         compiled from user/changepassword.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--主体开始-->
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
$.validator.setDefaults({
	 submitHandler: function() {
				$.ajax({
				type: "POST",
				url:  "/user/changepassword.html&a=update",
				data: "password="+$("#newpasswd").val(),
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							alert("保存成功");
						 	location.href = '/user/changepassword.html';
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
    			oldpasswd: {
    		    	required: true,
	    			minlength: 6,
	    			remote:"/?type=user&m=changepassword&a=checkpasswd"
	    		},
    		    newpasswd: {
    		    	required: true,
	    			minlength: 6
	    		},
	    		repasswd: {
	    			required: true,
	    			minlength: 6,
	    			equalTo:"#newpasswd"
	    		}
    	      },
    	 messages: {
    		    oldpasswd: {
    		    	required: "请输入旧密码",
	    			minlength: "密码要求由长度为6-16位字符组成",
	    			remote:"旧密码不正确"
	    		},
    		    newpasswd: {
    		    	required: "请输入新密码",
	    			minlength: ""
	    		},
	    		repasswd: {
	    			required: "请再次输入新密码",
	    			minlength: "密码要求由长度为6-16位字符组成",
	    			equalTo:"新密码两次输入不一致"
	    		}
    	      }
   	 });
});


</script>
  <div class="individual-main">
     <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/left.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
     <div class="individual-main-c">
        <div class="xiugaimima-block">
           <h3><img src="images/individual-center_40.jpg" width="78" height="17"/></h3>
            <ul>
                <li><a href="/user/userinfo.html">修改资料</a></li>
                <li><a href="#">修改密码</a></li>
                <li><a href="/user/userinfo.html&a=avatar" style="border:none;">修改头像</a></li>
                <div class="clear"></div>
            </ul>
            <form method="post" name="myForm" id="myForm">
               <span>原有密码：</span><input type="password" class=" password1" id="oldpasswd" name="oldpasswd"/><em>*</em><p>请输入原有密码</p><div class="clear"></div>
               <span>新 密 码：</span><input type="password" class=" password1" id="newpasswd" name="newpasswd"/><em>*</em><p>请设置登录密码</p><div class="clear"></div>
               <span>重复密码：</span><input type="password" class=" password1" id="repasswd" name="repasswd"/><em>*</em><p>重新填写密码</p><div class="clear"></div>
            </form>
            <button class="button" onclick="">保 存</button>
        </div>



     </div>
     <div class="individual-main-r">
        <div class="individual-block2">
             <div class="title_Mod">
                  <h2><a href=""><img src="images/individual-center_05.jpg" width="38" height="22"/></a> </h2>
                  <div class="hda_more"><a href=""></a></div>
             </div>
             <div class="image7"><img src="images/Hda_edu_36.jpg" width="250" height="229"/></div>
        </div>

         <div class="individual-block2">
             <div class="title_Mod">
                  <h2><a href=""><img src="images/individual-center_18.jpg" width="78" height="22"/></a> </h2>
                  <div class="hda_more"><a href=""></a></div>
             </div>
             <ul>
                 <li>>> <a href="">凤凰欢乐岛8月海岛学习之旅起航啦！</a></li>
                 <li>>> <a href="">校讯通用户30天学习体验卡使用说明！</a></li>
                 <li>>> <a href="">种菜魔法师活动上线啦！</a></li>
                 <li>>> <a href="">凤凰欢乐岛8月海岛学习之旅起航啦！</a></li>
                 <li>>> <a href="">校讯通用户30天学习体验卡使用说明！</a></li>
                 <li>>> <a href="">种菜魔法师活动上线啦！</a></li>
                 <li>>> <a href="">种菜魔法师活动上线啦！</a></li>
                 <li>>> <a href="">种菜魔法师活动上线啦！</a></li>
             </ul>
        </div>

        <div class="individual-block2">
             <div class="title_Mod">
                  <h2><a href=""><img src="images/individual-center_29.jpg" width="78" height="22"/></a> </h2>
                  <div class="hda_more"><a href=""></a></div>
             </div>
        </div>

        <div class="individual-block2">
             <div class="title_Mod">
                  <h2><a href=""><img src="images/individual-center_36.png" width="58" height="22"/></a> </h2>
                  <div class="hda_more"><a href=""></a></div>
             </div>
             <div class="block-bg">
                <div class="block-bg-t"><a class="block8" href="">每月</a><a class="block9" href="">每周</a><a class="block9" href="">每日</a></div>
                <ul>
                    <li><a href=""><span class="block11">1</span><p class="block12">李天乐<br /><span>积分1823</span></p></a><div class="clear"></div></li>
                    <li><a href=""><span class="block11">1</span><p class="block12">李天乐<br /><span>积分1823</span></p></a><div class="clear"></div></li>
                    <li><a href=""><span class="block11">1</span><p class="block12">李天乐<br /><span>积分1823</span></p></a><div class="clear"></div></li>
                    <li><a href=""><span class="block11-1">1</span><p class="block12">李天乐<br /><span>积分1823</span></p></a><div class="clear"></div></li>
                    <li><a href=""><span class="block11-1">1</span><p class="block12">李天乐<br /><span>积分1823</span></p></a><div class="clear"></div></li>
                    <li><a href=""><span class="block11-1">1</span><p class="block12">李天乐<br /><span>积分1823</span></p></a><div class="clear"></div></li>
                    <li><a href=""><span class="block11-1">1</span><p class="block12">李天乐<br /><span>积分1823</span></p></a><div class="clear"></div></li>
                    <li><a href=""><span class="block11-1">1</span><p class="block12">李天乐<br /><span>积分1823</span></p></a><div class="clear"></div></li>
                    <li><a href=""><span class="block11-1">1</span><p class="block12">李天乐<br /><span>积分1823</span></p></a><div class="clear"></div></li>
                    <li><a href=""><span class="block11-1">1</span><p class="block12">李天乐<br /><span>积分1823</span></p></a><div class="clear"></div></li>
                    <div class="clear"></div>
                </ul>

             </div>
        </div>
     </div>
  </div>
  <div class="clear"></div>
  <div class="ad_banner"> <a href=""><img src="images/Hda_edu_103.jpg" width="728" height="90" /></a> </div>

<!--主体结束-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>