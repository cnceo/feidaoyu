{{include file=global/header.tpl}}
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
$.validator.setDefaults({
	 submitHandler: function() {
	 	var data = $("#myForm").formToArray();
				$.ajax({
				type: "POST",
				url:  "/domain.html&a=selectdomain",
				data: data,
				dataType: 'json',
				async:true,
				beforeSend:function(){$("#sdomain").html("<img src='../images/loading1.gif'/>正在查询中..请稍后！");},
				success: function(msg){
					    if(msg.status == "true")
						    {
					    	$("#sdomain").load("/domain.html&a=domains");
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
    		   domain: {
	    			required: true,
	    		}
    	      },
    	 messages: {
    		 domain: {
    	 	    	required: "请输入域名",
    	 	    }
    	      }
   	 });

});

function addcart(domain,dom,price)
{
	var year = 1;
	/* if(domain)location.href="/cart.html&a=addcarts&domain="+domain+"&year="+year+"&vps="+dom+"&price="+price; */
	if(domain)location.href="/index.php?type=default&m=cart&a=addcart&domain="+domain+"&year="+year+"&vps="+dom+"&price="+price;
	}
</script>
<style>
.error {color:#F00;}
</style>
<div class="home_main">
    <div class="headborder"></div>
    <!--Big. box-->
   <form method="post" action="" id="myForm">
    <div class="homedominbox">
         <div class="littlebox">
             <h3>在这里选择您需要的：</h3>
             <div class="btn-searchname">
                 <p class="www">www.</p>
                 <input type="text"  class="smallboxsearch" id="domain" name="domain">
                 <input type="submit" value="" class="smallboxbtn">
                 <div class="clear"></div>
             </div>
             <div class="clear"></div>


             <div class="schoosebox">{{html_checkboxes name="domains[]" options=$doaminlist checked="com"}}</div>
         </div>
         <img src="/images/bigimgzhuce.jpg">
         <div class="clear"></div>
    </div>
    </form>
    <!--Big box end -->
    <!--product-->
   <div id="sdomain"></div>
    <div class="productlist">
    
         <div class="wrapbox">
            <div class="home_miphone home_mitwo">
                <div class="phoneleft">
                    <h2>M3型虚拟主机</h2>
                    <p>2.5G独享<br>20G 月流量<br><em>¥ 680/年</em></p>
                    <a class="home_btn_buy" target="_blank" href="/vps/host-1.html">查看详情</a>
                </div>
              <!--   <a href=""><img class="phoneright" src="/uploads" /></a>-->
            </div>
         </div>

         <div class="wrapbox">
            <div class="home_miphone home_mithree">
                <div class="phoneleft">
                    <h2>G5型虚拟主机</h2>
                    <p>10.5G 独享<br>不限 月流量<br><em>¥ 980/年</em></p>
                    <a class="home_btn_buy" target="_blank" href="/vps/host-2.html">查看详情</a>
                </div>
              <!--   <a href=""><img class="phoneright" src="/uploads" /></a>-->
            </div>
         </div>

<!--    
         <div class="wrapbox">
             <div class="contectsmallbox">
                  <h2>热销推荐</h2>
                  <dl>
                      <dd><img src="/images/listimg1.jpg"></dd>
                      <dt><h4>双线普及型</h4><span>288</span>&nbsp;&nbsp;元 / 年</dt>
                  </dl>
                  <div class="clear"></div>
                  <ul class="productarameter">
                    <li><a href="">200MB 虚拟主机空间</a></li>
                    <li><a href="">高速、稳定、方便</a></li>
                    <li><a href="">即买即用方便快捷</a></li>
                  </ul>
                  <div class="s-details"><input type="button" class="details-btn" name="dataill" value="" /></div>
             </div>
         </div>

         <div class="wrapbox">
             <div class="contectsmallbox">
                  <h2>热销推荐</h2>
                  <dl>
                      <dd><img src="/images/listimg2.jpg"></dd>
                      <dt><h4>双线普及型</h4><span>288</span>&nbsp;&nbsp;元 / 年</dt>
                  </dl>
                  <div class="clear"></div>
                  <ul class="productarameter">
                    <li><a href="">200MB 虚拟主机空间</a></li>
                    <li><a href="">高速、稳定、方便</a></li>
                    <li><a href="">即买即用方便快捷</a></li>
                  </ul>
                  <div class="s-details"><input type="button" class="details-btn" name="dataill" value="" /></div>
             </div>
         </div>

 -->



        <div class="home_miten">
            <div style="background:url(/images/thingss.png) no-repeat 120px 20px;" class="home_miten_link">
				<a href=""><ul>
					<li class="item1"><em></em> </li>
					<li class="item2">原价：¥520</li>
					<li class="item3">
						<dl>
							<dt>10月倾情回馈</dt>
							<dd>.com国际 ／ .cn国内域名</dd>
						</dl>
					</li>
				</ul>
				<span class="home_miten_icon"></span></a>
			</div>
			<ul class="home_mitengo cfl">

				<li style="width:190px;"><a href="" class="item">700元现金券领取</a></li>
				<li style="width:190px;"><a href="" class="item">发布会199元现金券领取</a></li>

			</ul>
		</div>
    </div>
    <!--右边结束 -->
</div>






{{include file=global/footer.tpl}}
