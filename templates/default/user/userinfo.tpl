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

$(document).ready(function(){

   	  $("#province").change(function(){
   	  	$("#city").load("/user/userinfo.html&a=citylist&pid="+$("#province").val());
   	  	$("#county").html("<option value=\"\">请选择区县</option>");
        });
	$("#city").change(function(){
   	  	$("#county").load("/user/userinfo.html&a=countylist&pid="+$("#city").val());
        });
});
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
                <li><a href="#">修改资料</a></li>
                <li><a href="/user/userinfo.html&a=password">修改密码</a></li>
                <li><a href="/user/userinfo.html&a=avatar" style="border:none;">修改头像</a></li>
                <div class="clear"></div>
            </ul>
           <form method="post" name="myForm" id="myForm">
               <span>真实姓名：</span><input type="text" name="truename" class="text1" value="{{$log.truename}}"/><div class="clear"></div>
               <span>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</span>{{html_radios name="gender" options=$genderlist selected=$log.gender id=gender}}
              <!--  <span>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</span><input class="Sex" name="Sex" type="radio" checked="checked" value="male" /><b>男</b><input name="Sex" type="radio" value="female" class="Sex" /><b>女</b> --><div class="clear"></div>
               <span>出生年月：</span>
              <select name="year" id="year" class="border1 h20" style="width:70px">
				                          <option value="">请选择</option>
				                          {{html_options options=$yearlist selected=$log.year}}
				                        </select>年
										<select name="month" id="month" class="border1 h20"  style="width:70px">
				                          <option value="">请选择</option>
				                          {{html_options options=$monthlist selected=$log.month}}
				                        </select>月
				                        <select name="day" id="day" class="border1 h20"  style="width:70px">
				                          <option value="">请选择</option>
				                          {{html_options options=$daylist selected=$log.day}}
				                        </select>日
               <!-- <select>
                  <option value="volvo">1月</option>
                  <option value="volvo">2月</option>
                  <option value="volvo">3月</option>
               </select>
               <select>
                  <option value="volvo">1日</option>
                  <option value="volvo">2日</option>
                  <option value="volvo">3日</option>
               </select> -->
               <div class="clear"></div>
             <span>常用手机：</span><input type="text" class="text1" name="mobile" id="mobile" value="{{$log.mobile}}"/><div class="clear"></div>
             <span>常用邮箱：</span><input type="text" class="text1" name="email" id="email" value="{{$log.email}}"/><div class="clear"></div>
             <span>所在城市：</span>
             <select id="province" name="province" class="region border1 h20" >
								     <option value="">请选择省份</option>
								     {{html_options options=$provincelist selected=$log.province}}
								     </select>
								     <select id="city" name="city" class="region border1 h20" >
								      <option value="">请选择城市</option>
								     {{html_options options=$citylist selected=$log.city}}
								     </select>
								     <select id="county" name="county" class="region border1 h20" >
								      <option value="">请选择区县{{$place}}</option>
								      {{html_options options=$countylist selected=$log.county}}
								     </select>
               <!-- <select>
                  <option value="volvo">江苏省</option>
                  <option value="volvo">山西省</option>
                  <option value="volvo">浙江省</option>
               </select>
               <select>
                  <option value="volvo">徐州</option>
                  <option value="volvo">太原</option>
                  <option value="volvo">嘉兴</option>
               </select>
               <select>
                  <option value="volvo">九里区</option>
                  <option value="volvo">迎泽区</option>
                  <option value="volvo">南湖区</option>
               </select> -->
               <div class="clear"></div>
               <span>所在学校：</span><input type="text" class="text1" name="school" id="school" value="{{$log.school}}"/><div class="clear"></div>
               <span>邮寄地址：</span><textarea class="text2"  cols="3" rows="40" name="address" id="address" >{{$log.address}}</textarea><div class="clear"></div>
               <span>邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编：</span><input type="text" class="text1" name="postcode" id="postcode" value="{{$log.postcode}}"/><div class="clear"></div>
              </form>
            <button class="button" type="button" onclick="saves();">保 存</button>
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