{{include file=admin/header.tpl}}
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		csitename: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    csitename: {
    		    	required: "请填写网站中文名称"
	    		}
    	      },
    	 errorPlacement: function(error, element){       
        	$(".warning").css('display','block');
    	     }
   	 });
});
       
       $.validator.setDefaults({
			 submitHandler: function() {
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m={{'setting'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m={{'setting'|encrypt}}';    
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
    <h1 style="background-image: url('./images/payment.png');">修改{{$sites.title}}</h1>
    <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>

  </div>
  <div class="content">
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a><a tab="#tab_mail" class="">邮件</a><a tab="#tab_msg" class="">短信</a><a tab="#tab_points" class="">积分</a><a tab="#tab_client" class="">会员</a><a tab="#tab_filter" class="">过滤</a><a tab="#tab_data" class="">其他</a></div>
    <form id="myForm" name="myForm" action="" method="post">
      <div id="tab_general" style="display: block;">
        <div class="htabs" id="languages">
                    <a tab="#language1" class="selected"><img src="./images/flags/cn.png" title="中文" /> 中文</a>
                   <!-- <a tab="#language2"><img src="./images/flags/gb.png" title="英文" /> 英文</a>
                    <a tab="#language3"><img src="./images/flags/jp.png" title="日文" /> 日文</a>-->
		          </div>
                <div id="language1" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 网站名称:</td>
			              <td><input value="{{$log.csitename}}" size="100" name="csitename" id="csitename">
			                </td>
			            </tr>
			            <tr>
			              <td> 公司名称:</td>
			              <td><input value="{{$log.corgname}}" size="100" name="corgname" id="corgname">
			                </td>
			            </tr>
			              <tr>
			              <td> 联系地址:</td>
			              <td><input value="{{$log.caddress}}" size="100" name="caddress" id="caddress">
			                </td>
			            </tr>
			            <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="5" cols="40" name="cmeta_keywords">{{$log.cmeta_keywords}}</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="5" cols="40" name="cmeta_description">{{$log.cmeta_description}}</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>
		       <!-- <div id="language2" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			             <td><span class="required">*</span> 网站名称:</td>
			              <td><input value="{{$log.esitename}}" size="100" name="esitename" id="esitename">
			                </td>
			            </tr>
			            <tr>
			              <td> 公司名称:</td>
			              <td><input value="{{$log.eorgname}}" size="100" name="eorgname" id="eorgname">
			                </td>
			            </tr>
			              <tr>
			              <td> 联系地址:</td>
			              <td><input value="{{$log.eaddress}}" size="100" name="eaddress" id="eaddress">
			                </td>
			            </tr>
			            <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="5" cols="40" name="emeta_keywords">{{$log.emeta_keywords}}</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="5" cols="40" name="emeta_description">{{$log.emeta_description}}</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>
		        <div id="language3" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			               <td><span class="required">*</span> 网站名称:</td>
			              <td><input value="{{$log.jsitename}}" size="100" name="jsitename" id="jsitename">
			                </td>
			            </tr>
			            <tr>
			              <td> 公司名称:</td>
			              <td><input value="{{$log.jorgname}}" size="100" name="jorgname" id="jorgname">
			                </td>
			            </tr>
			              <tr>
			              <td> 联系地址:</td>
			              <td><input value="{{$log.jaddress}}" size="100" name="jaddress" id="jaddress">
			                </td>
			            </tr>
			            <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="5" cols="40" name="jmeta_keywords">{{$log.jmeta_keywords}}</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="5" cols="40" name="jmeta_description">{{$log.jmeta_description}}</textarea></td>
			            </tr>
			          </tbody></table>
		        </div>-->
		      </div>
      <div id="tab_mail" style="display: none;">
        <table class="form">
          <tbody>
			          <tr>
			              <td> 发件邮箱:</td>
			              <td><input value="{{$log.sendemail}}" size="100" name="sendemail" id="sendemail">
			                </td>
			            </tr>
			             <tr>
			              <td> 收件邮箱:</td>
			              <td><input value="{{$log.email}}" size="100" name="email" id="email">
			                </td>
			            </tr>
			           <tr>
			              <td>SMTP服务器:</td>
			              <td><input value="{{$log.smtphost}}" size="100" name="smtphost" id="smtphost">
			                </td>
			            </tr>
			             <tr>
			              <td> SMTP端口:</td>
			              <td><input value="{{$log.smtpport}}" size="20" name="smtpport" id="smtpport">
			                </td>
			            </tr>
			            <tr>
			              <td>SMTP帐户:</td>
			              <td><input value="{{$log.smtpuser}}" size="100" name="smtpuser" id="smtpuser">
			                </td>
			            </tr>
			             <tr>
			              <td>SMTP密码:</td>
			              <td><input value="{{$log.smtppasswd}}" size="100" name="smtppasswd" id="smtppasswd">
			                </td>
			            </tr>
        </tbody></table>
      </div>
      <div id="tab_msg" style="display: none;">
        <table class="form">
          <tbody>
			          <tr>
			              <td> API接口地址:</td>
			              <td><input value="{{$log.msgadd}}" size="100" name="msgadd" id="msgadd">
			                </td>
			            </tr>
			             <tr>
			              <td> 账户:</td>
			              <td><input value="{{$log.msguser}}" size="50" name="msguser" id="msguser">
			                </td>
			            </tr>
			           <tr>
			              <td>密码:</td>
			              <td><input value="{{$log.msgpwd}}" size="50" name="msgpwd" id="msgpwd">
			                </td>
			            </tr>
        </tbody></table>
      </div>
      <div id="tab_points" style="display: none;">
      <table class="form">
          <tbody>
			          <tr>
			              <td>注册积分:</td>
			              <td><input value="{{$log.reg_point}}" size="50" name="reg_point" id="reg_point">
			                </td>
			            </tr>
			            <tr>
			              <td>更新个人信息:</td>
			              <td><input value="{{$log.upc_point}}" size="50" name="upc_point" id="upc_point">
			                </td>
			            </tr>
			             <tr>
			              <td>产品评论积分:</td>
			              <td><input value="{{$log.prod_comment_point}}" size="50" name="prod_comment_point" id="prod_comment_point">
			                </td>
			            </tr>
			             <tr>
			              <td>服务评论积分:</td>
			              <td><input value="{{$log.serv_comment_point}}" size="50" name="serv_comment_point" id="serv_comment_point">
			                </td>
			            </tr>
			             <tr>
			              <td>服务评论积分:</td>
			              <td><input value="{{$log.serv_comment_point}}" size="50" name="serv_comment_point" id="serv_comment_point">
			                </td>
			            </tr>
        </tbody></table>
      </div>
       <div id="tab_client" style="display: none;">
      <table class="form">
          <tbody>
			          <tr>
			              <td>预留用户名:</td>
			              <td><textarea rows="5" cols="70" name="reguwords">{{$log.reguwords}}</textarea> 多个关键词用空格分开，例：百万宝贝|mpets
			                </td>
			            </tr>
        </tbody></table>
      </div>
      <div id="tab_filter" style="display: none;">
      <table class="form">
          <tbody>
			          <tr>
			              <td>关键词:</td>
			              <td><textarea rows="5" cols="70" name="badwords">{{$log.badwords}}</textarea> 多个关键词用空格分开，例：共产党|法轮功
			                </td>
			            </tr>
			             <tr>
			              <td>替换为:</td>
			              <td><input value="{{$log.replaceword}}" size="50" name="icp" id="icp">
			                </td>
			            </tr>
        </tbody></table>
      </div>
      <div id="tab_data" style="display: none;">
        <table class="form">
          <tbody>
			          <tr>
			              <td>网站网址:</td>
			              <td><input value="{{$log.http}}" size="100" name="http" id="http">
			                </td>
			            </tr>
			            <tr>
			              <td>商城网址:</td>
			              <td><input value="{{$log.shttp}}" size="100" name="shttp" id="shttp">
			                </td>
			            </tr>
			             <tr>
			              <td>ICP备案号:</td>
			              <td><input value="{{$log.icp}}" size="100" name="icp" id="icp">
			                </td>
			            </tr>
			             <tr>
			              <td>赠品计算:</td>
			              <td><input value="{{$log.orghttp}}" size="10" name="orghttp" id="orghttp">
			                </td>
			            </tr>
			             <tr>
			              <td>邮编:</td>
			              <td><input value="{{$log.postcode}}" size="20" name="postcode" id="postcode">
			                </td>
			            </tr>
                       <tr>
			              <td>电话:</td>
			              <td><input value="{{$log.telphone}}" size="100" name="telphone" id="telphone">
			                </td>
			            </tr>
			           <tr>
			              <td>传真:</td>
			              <td><input value="{{$log.fax}}" size="100" name="fax" id="fax">
			                </td>
			            </tr>
        </tbody></table>
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