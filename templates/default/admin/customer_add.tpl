{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/editor/tiny_mce.js"></script>
<script type="text/javascript" src="js/editor/editor_simple.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		username: {
	    			required: true,
	    			minlength: 4,
	    			remote:"?m={{'customer'|encrypt}}&a=check&id={{$log.id}}" 
	    		},
	    		email: {
	    			required: true,
	    			email:true,
	    			remote:"?m={{'customer'|encrypt}}&a=check&id={{$log.id}}" 
	    		},
	    		mobile: {
	    			required: true,
	    			phone:true,
	    			remote:"?m={{'customer'|encrypt}}&a=check&id={{$log.id}}" 
	    		}
    	      },
    	 messages: {
    		    username: {
    		    	required: "请填写用户名",
    		    	minlength: "昵称最短不能少于4个字符",
    	 	    	remote:"该用户名已经被占用"
	    		},
	    		email: {
	    			required: "请填写email",
	    			phone:"请输入正确的email",
	    			remote:"该email已经被占用" 
	    		},
	    		mobile: {
	    			required: "请填写手机号码",
	    			phone:"请输入正确的手机号码",
	    			remote:"该手机号码已经被占用" 
	    		}
    	      },
		showErrors:function(errorMap,errorList){ 
			        $(".warning").css('display','block');
			        $(".warning").html("带*为必填项，共有 " + this.numberOfInvalids() + " 错误，请仔细检查！"); 
			        this.defaultShowErrors(); 
			   }	
   	 });
   	  $("#province").change(function(){
   	  	jQuery("#city").load("?m={{'customer'|encrypt}}&a=citylist&pid="+jQuery("#province").val());
   	  	jQuery("#county").html("<option value=\"\">请选择区县</option>");
        });
	  $("#city").change(function(){
   	  	jQuery("#county").load("?m={{'customer'|encrypt}}&a=&a=countylist&pid="+jQuery("#city").val());
        });
});
       
       $.validator.setDefaults({
			 submitHandler: function() {
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m={{'customer'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m={{'customer'|encrypt}}';    
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
</script>
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('./images/payment.png');">{{if $log.id==""}}添加{{else}}修改{{/if}}{{$sites.title}}</h1>
    <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>

  </div>
  <div class="content">
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a></div>
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
      <div id="tab_general" style="display: block;">
			          <table class="form">
			            <tbody>
			             <tr>
			              <td>真实姓名:</td>
			              <td><input value="{{$log.truename}}" size="80" name="truename" id="truename">
			                </td>
			            </tr>
			             <tr>
          <td>会员等级</td>
          <td><select name="customer_group_id">
		       <option value="">请选择</option>   
		      {{html_options options=$cglist selected=$log.customer_group_id}}
		      </select>
	  </td>
        </tr>
         <tr>
          <td>性别</td>
          <td><input type="radio" name="gender" id="gender" value="0" checked/>女
                  <input type="radio" name="gender" id="gender" value="1" {{if $log.gender=="1"}}checked{{/if}} />男
	  </td>
        </tr>
			            <tr>
			              <td><span class="required">*</span> 用户名:</td>
			              <td>
			              <input value="{{$log.truename}}" size="80" name="username" id="username" {{if $log.username}}disabled{{/if}}>
			                </td>
			            </tr>
			             <tr>
			              <td>昵称:</td>
			              <td><input value="{{$log.nickname}}" size="80" name="nickname" id="nickname" {{if $log.nickname}}disabled{{/if}}>
			                </td>
			            </tr>
			            <tr>
			              <td>密码:</td>
			              <td><input value="" size="80" name="password" id="password">
			                </td>
			            </tr>
	<tr>
          <td><span class="required">*</span> 手机号码</td>
          <td><input type="text" name="mobile" id="mobile" size="80" value="{{$log.mobile}}"/></td>
        </tr>
	<tr>
	<tr>
          <td>电话号码</td>
          <td><input type="text" name="telphone" id="telphone" size="80" value="{{$log.telphone}}"/></td>
        </tr>
	<tr>
          <td><span class="required">*</span> 电子邮件</td>
          <td><input type="text" name="email" id="email" size="80" value="{{$log.email}}"/></td>
        </tr>
	<tr>
          <td>出生年月日</td>
          <td><input type="text" size="8"  id="year" name="year" value="{{$log.year}}">
                   年
                      <select name="month" id="month" class="information_width">
                          <option value="">请选择</option>
                          {{html_options options=$monthlist selected=$log.month}}
                        </select>月
                        <select name="day" id="day" class="information_width">
                          <option value="">请选择</option>
                          {{html_options options=$daylist selected=$log.day}}
                        </select>日
	  </td>
        </tr>
	<tr>
          <td>联系住址</td>
          <td><select id="province" name="province" class="region" >
				     <option value="">请选择省份</option>
				     {{html_options options=$provincelist selected=$log.province}}
				     </select>
				     <select id="city" name="city" class="region" >
				      <option value="">请选择城市</option>
				     {{html_options options=$citylist selected=$log.city}}
				     </select>
				     <select id="county" name="county" class="region" >
				      <option value="">请选择区县</option>
				      {{html_options options=$countylist selected=$log.county}}
				     </select> <br/><input type="text" name="address" id="address" size="80" value="{{$log.address}}" /></td>
        </tr>
	<tr>
          <td>邮政编码</td>
          <td><input type="text" name="postcode" id="postcode" size="12" value="{{$log.postcode}}" /></td>
        </tr>
        
        <tr>
            <td>状态:</td>
            <td><select name="status">
                                {{html_options options=$statuslist selected=$log.status}}
                              </select></td>
          </tr>
			          </tbody></table>
		      </div>
      <div id="tab_data" style="display: none;">
        
      </div>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>
  
</div>
<script type="text/javascript"><!--
$.tabs('#tabs a'); 
$.tabs('#languages a'); 
//--></script>
</div></div>
{{include file=admin/footer.tpl}}