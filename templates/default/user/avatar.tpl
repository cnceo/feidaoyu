{{include file=global/header.tpl}}
<!--主体开始-->
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
 function saves() {
	 	        var data = $("#myForm").formToArray();
				$.ajax({
				type: "POST",
				url:  "/user/userinfo.html&a=update",
				data: data,
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							alert("保存成功");
						 	location=location
						 }
						 else
						{
							alert(msg.message);
						}
				   }
			});
	}


function Back()
{

history.go(-1);

}

</script>
  <div class="individual-main">
     {{include file=user/left.tpl}}
    <div class="individual-main-c">
        <div class="xiugaimima-block">
           <h3><img src="/images/individual-center_40.jpg" width="78" height="17"/></h3>
            <ul>
                <li><a href="/user/userinfo.html">修改资料</a></li>
                <li><a href="/user/userinfo.html&a=password">修改密码</a></li>
                <li><a href="#" style="border:none;">修改头像</a></li>
                <div class="clear"></div>
            </ul>
            <div class="xiugai_main">
               <div class="xiugai-l">
                  <div class="photo1"><a href=""></a></div>
                  <p>头像保存后，如 果不能立即显示，请F5按刷新按钮 </p>
               </div>
               <div class="xiugai-r">
                  <p>你可以在下方选择自己喜欢的头像</p>
                  <ul class="xiugai-r-r">
                     <li>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_05.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_05.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_05.png" width="48" height="48" /></a>
                     </li>
                     <li>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_05.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_05.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                     </li>
                     <li>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_05.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_05.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                     </li>
                     <li>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_05.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_05.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                     </li>
                     <li>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_03.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_05.png" width="48" height="48" /></a>
                        <a href=""><img src="/images/xiugaitouxiang_21.png" width="48" height="48" /></a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="clear"></div>
            <a href="" class="button1">上传头像</a><b>建议300k以内</b>
            <a href="" class="button2">保 存</a>
        </div>



     </div>
     <div class="individual-main-r">
        <div class="individual-block2">
             <div class="title_Mod">
                  <h2><a href=""><img src="/images/individual-center_05.jpg" width="38" height="22"/></a> </h2>
                  <div class="hda_more"><a href=""></a></div>
             </div>
             <div class="image7"><img src="/images/Hda_edu_36.jpg" width="250" height="229"/></div>
        </div>

         <div class="individual-block2">
             <div class="title_Mod">
                  <h2><a href=""><img src="/images/individual-center_18.jpg" width="78" height="22"/></a> </h2>
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
                  <h2><a href=""><img src="/images/individual-center_29.jpg" width="78" height="22"/></a> </h2>
                  <div class="hda_more"><a href=""></a></div>
             </div>
        </div>

        <div class="individual-block2">
             <div class="title_Mod">
                  <h2><a href=""><img src="/images/individual-center_36.png" width="58" height="22"/></a> </h2>
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
  <div class="ad_banner"> <a href=""><img src="/images/Hda_edu_103.jpg" width="728" height="90" /></a> </div>

<!--主体结束-->
{{include file=global/footer.tpl}}