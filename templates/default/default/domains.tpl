<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
$.validator.setDefaults({
	 submitHandler: function() {
	 	var data = $("#myForm1").formToArray();
				$.ajax({
				type: "POST",
				url:  "/cart.html&a=addcarts",
				data: data,
				dataType: 'json',
 				success: function(msg){
					    if(msg.status == "true")
						    {
								  parent.location = "/cart.html";
						    }
				   }
			});
	}
});

$(document).ready(function(){

	   $("#myForm1").validate({
 	rules: {
 	      },
 	 messages: {
 	      }
	 });

});
</script>
 <form method="post" action="" id="myForm1" name="myForm1">
<div class="domainquery_main">
     <div class="domainquery_title"><img src="/images/domainquery011.gif"></div>

     <div class="check_domain">

<!-- <div class="sigin_01">
    <div class="check_domain"></div>
    <div class="check_domain2"></div>
    <div class="check_domain3">
        <div id="ad_0" style="width:650px;float:left;height:26px;">
            <div class="domainquery_main_lcontent">
                <div class="domainquery_main_lcontent_l"><img src="/images/domainquery_ico02.gif"></div>
                <div class="domainquery_main_lcontent_l2"><span class="fonta">duchuang.com</span><span class="link_red">(已被注册)</span></div>
                <div class="domainquery_main_lcontent_r2"><a class="linkblue_query" href="">详细</a> <a class="linkblue_query" href="">前往</a> </div>
            </div>
        </div>
    </div>
</div> -->


<div class="domainquery_main_lcontent"></div>


          <div class="ad_3">
           {{foreach from=$domains item=data}}
              <div class="domainquery_main_lcontent">
                  <div class="domainquery_main_lcontent_l">
                       {{if $data.status=='1'}}<input type="checkbox" checked="checked" value="{{$data.domain}}" name="sdomain[]">{{else}}<img src="/images/domainquery_ico02.gif">{{/if}}
                  </div>
                  <div class="domainquery_main_lcontent_l2">
                      <span class="fonta">{{$data.domain}}</span>
                      <span class="colgreen">({{$data.statusname}})</span>
                  </div>
                  <div class="domainquery_main_lcontent_r2">
                      {{if $data.status=='1'}}<a class="linkblue_query" href="javascript:void(0)" onclick="addcart('{{$data.domain}}','domains','{{$data.price}}')">加入购物车</a>{{else}}<a href="http://www.{{$data.domain}}" target="_blank">前往</a>{{/if}}
                      {{if $data.status=='1'}} <input type="hidden" name="price[]" value="{{$data.price}}"><input type="hidden" name="year[]" value="1">{{/if}}
                  </div>
                  <div class="domainquery_main_lcontent_r1"></div>
                  <div class="domainquery_main_lcontent_r2">
                      <span style="color:#999999;">庆祝CN域名开放个人注册  <font color="Red">域名节特惠</font></span>&nbsp;￥<font color="Red">{{$data.price}}元/首年</font>
                  </div>
              </div>
              {{/foreach}}
          </div>
          <div class="clear"></div>
     </div>
  <div class="domainquery_main2_top2">
      <div class="domainquery_main2_top2a">
         <input type="checkbox" onclick="$('input[name*=\'sdomain\']').attr('checked', this.checked);" />全选
      </div>
      <div class="domainquery_main2_top2a">
          <input type="image" value="提交" src="/images/domainquery_but04.gif" />
      </div>
      <div style="padding-left:10px;" class="domainquery_main2_top2a">
          <a href=""><img src="/images/domainquery_but02.gif"></a>
      </div>
  </div>
  <div class="clear"></div>
</div>
</form>







