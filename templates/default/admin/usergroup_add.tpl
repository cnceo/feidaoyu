{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/editor/tiny_mce.js"></script>
<script type="text/javascript" src="js/editor/editor_simple.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		catename: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    catename: {
    		    	required: "请填写名称"
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
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m={{'usergroup'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m={{'usergroup'|encrypt}}';    
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
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">通用</a><a tab="#tab_data" class="">权限</a></div>
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
      <div id="tab_general" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 名称:</td>
			              <td><input value="{{$log.catename}}" size="100" name="catename" id="catename">
			                </td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea rows="5" cols="40" name="content">{{$log.content}}</textarea></td>
			            </tr>
			          </tbody></table>
		      </div>
      <div id="tab_data" style="display: none;">
         <table class="list">
          <thead>
            <tr>
             <td class="left" colspan="2">商品</td>
            </tr>
          </thead>
          <tbody>
            <tr><td class="right" width="120">商品列表</td><td class="left">{{html_checkboxes name="rules[PW_PRODS]" options=$pw.checkboxes checked=$pw.PW_PRODS}}</td></tr>
            <tr><td class="right">商品分类</td><td class="left">{{html_checkboxes name="rules[PW_PRODC]" options=$pw.checkboxes checked=$pw.PW_PRODC}}</td></tr>
           
            <tr><td class="right">商品品牌</td><td class="left">{{html_checkboxes name="rules[PW_BRANT]" options=$pw.checkboxes checked=$pw.PW_BRANT}}</td></tr>
            <tr><td class="right">评论管理</td><td class="left">{{html_checkboxes name="rules[PW_COMMIT]" options=$pw.checkboxes checked=$pw.PW_COMMIT}}</td></tr>
            <tr><td class="right">商品自动上下架</td><td class="left">{{html_radios name="rules[PW_PRODA]" options=$pw.radios checked=$pw.PW_PRODA}}</td></tr>
            <tr><td class="right">批量导入</td><td class="left">{{html_radios name="rules[PW_PRODU]" options=$pw.radios checked=$pw.PW_PRODU}}</td></tr>
            <tr><td class="right">图片导入</td><td class="left">{{html_radios name="rules[PW_PRODI]" options=$pw.radios checked=$pw.PW_PRODI}}</td></tr>
          </tbody>
          <thead>
            <tr>
             <td class="left" colspan="2">订单</td>
            </tr>
          </thead>
          <tbody>
           <tr><td class="right">订单列表</td><td class="left">{{html_checkboxes name="rules[PW_ORDER]" options=$pw.checkboxes checked=$pw.PW_ORDER}}</td></tr>
           <tr><td class="right">订单查询</td><td class="left">{{html_radios name="rules[PW_ORDERS]" options=$pw.radios checked=$pw.PW_ORDERS}}</td></tr>
           <tr><td class="right">合并订单</td><td class="left">{{html_radios name="rules[PW_ORDERA]" options=$pw.radios checked=$pw.PW_ORDERA}}</td></tr>
           <tr><td class="right">订单打印</td><td class="left">{{html_radios name="rules[PW_ORDERP]" options=$pw.radios checked=$pw.PW_ORDERP}}</td></tr>
           <tr><td class="right">发货单列表</td><td class="left">{{html_radios name="rules[PW_ORDERF]" options=$pw.radios checked=$pw.PW_ORDERF}}</td></tr>
           <tr><td class="right">退货单列表</td><td class="left">{{html_radios name="rules[PW_ORDERT]" options=$pw.radios checked=$pw.PW_ORDERT}}</td></tr>
           <tr><td class="right">快递管理</td><td class="left">{{html_checkboxes name="rules[PW_EXPR]" options=$pw.checkboxes checked=$pw.PW_EXPR}}</td></tr>
           <tr><td class="right">支付管理</td><td class="left">{{html_checkboxes name="rules[PW_PAYS]" options=$pw.checkboxes checked=$pw.PW_PAYS}}</td></tr>
          </tbody>
          <thead>
            <tr>
             <td class="left" colspan="2">客户</td>
            </tr>
          </thead>
          <tbody>
           <tr><td class="right">会员列表</td><td class="left">{{html_checkboxes name="rules[PW_CLIENTS]" options=$pw.checkboxes checked=$pw.PW_CLIENTS}}</td></tr>
           <tr><td class="right">会员等级</td><td class="left">{{html_checkboxes name="rules[PW_CLIENTG]" options=$pw.checkboxes checked=$pw.PW_CLIENTG}}</td></tr>
          </tbody>
          <thead>
            <tr>
             <td class="left" colspan="2">促销</td>
            </tr>
          </thead>
          <tbody>
           <tr><td class="right">限时抢购</td><td class="left">{{html_radios name="rules[PW_CDOWN]" options=$pw.radios checked=$pw.PW_CDOWN}}</td></tr>
           <tr><td class="right">团购活动</td><td class="left">{{html_checkboxes name="rules[PW_TGOU]" options=$pw.checkboxes checked=$pw.PW_TGOU}}</td></tr>
           <tr><td class="right">积分换购</td><td class="left">{{html_checkboxes name="rules[PW_PIONT]" options=$pw.checkboxes checked=$pw.PW_PIONT}}</td></tr>
           <tr><td class="right">免费试用</td><td class="left">{{html_checkboxes name="rules[PW_TRIA]" options=$pw.checkboxes checked=$pw.PW_TRIA}}</td></tr>
           <tr><td class="right">打包销售</td><td class="left">{{html_checkboxes name="rules[PW_PRAG]" options=$pw.checkboxes checked=$pw.PW_PRAG}}</td></tr>
           <tr><td class="right">短信</td><td class="left">{{html_checkboxes name="rules[PW_MSG]" options=$pw.checkboxes checked=$pw.PW_MSG}}</td></tr>
           <tr><td class="right">DM</td><td class="left">{{html_checkboxes name="rules[PW_DM]" options=$pw.checkboxes checked=$pw.PW_DM}}</td></tr>
          </tbody>
          <thead>
            <tr>
             <td class="left" colspan="2">统计</td>
            </tr>
          </thead>
          <tbody>
           <tr><td class="right">销售</td><td class="left">{{html_radios name="rules[PW_OPENC]" options=$pw.radios checked=$pw.PW_OPENC}}</td></tr>
          </tbody>
          <thead>
            <tr>
             <td class="left" colspan="2">内容</td>
            </tr>
          </thead>
          <tbody>
           <tr><td class="right">内容列表</td><td class="left">{{html_checkboxes name="rules[PW_CONTS]" options=$pw.checkboxes checked=$pw.PW_CONTS}}</td></tr>
           <tr><td class="right">内容分类</td><td class="left">{{html_checkboxes name="rules[PW_CONTC]" options=$pw.checkboxes checked=$pw.PW_CONTC}}</td></tr>
           <tr><td class="right">博文管理</td><td class="left">{{html_checkboxes name="rules[PW_BLOG]" options=$pw.checkboxes checked=$pw.PW_BLOG}}</td></tr>
           <tr><td class="right">搜索关键词</td><td class="left">{{html_checkboxes name="rules[PW_KEYWD]" options=$pw.checkboxes checked=$pw.PW_KEYWD}}</td></tr>
           <tr><td class="right">广告列表</td><td class="left">{{html_checkboxes name="rules[PW_ADS]" options=$pw.checkboxes checked=$pw.PW_ADS}}</td></tr>
           <tr><td class="right">广告位置</td><td class="left">{{html_checkboxes name="rules[PW_ADT]" options=$pw.checkboxes checked=$pw.PW_ADT}}</td></tr>
          </tbody>
          <thead>
            <tr>
             <td class="left" colspan="2">系统</td>
            </tr>
          </thead>
          <tbody>
           <tr><td class="right">系统设置</td><td class="left">{{html_radios name="rules[PW_SETUP]" options=$pw.radios checked=$pw.PW_SETUP}}</td></tr>
           <tr><td class="right">用户列表</td><td class="left">{{html_checkboxes name="rules[PW_USERS]" options=$pw.checkboxes checked=$pw.PW_USERS}}</td></tr>
           <tr><td class="right">用户组</td><td class="left">{{html_checkboxes name="rules[PW_USERG]" options=$pw.checkboxes checked=$pw.PW_USERG}}</td></tr>
           <tr><td class="right">部门</td><td class="left">{{html_checkboxes name="rules[PW_DEPT]" options=$pw.checkboxes checked=$pw.PW_DEPT}}</td></tr>
           <tr><td class="right">系统日志</td><td class="left">{{html_radios name="rules[PW_LOGS]" options=$pw.radios checked=$pw.PW_LOGS}}</td></tr>
           <tr><td class="right">数据库</td><td class="left">{{html_radios name="rules[PW_DATABS]" options=$pw.radios checked=$pw.PW_DATABS}}</td></tr>
          </tbody>
        </table>
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