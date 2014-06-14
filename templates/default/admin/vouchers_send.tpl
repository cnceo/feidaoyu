{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/editor/tiny_mce.js"></script>
<script type="text/javascript" src="js/editor/editor_simple.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   //添加
	$("#add_lock").click(function(){_move()});
	//去掉
	$("#remove_lock").click(function(){_move(1)});
});
       
       $.validator.setDefaults({
			 submitHandler: function() {
			 	tinyMCE.triggerSave(false, false);
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m={{'category'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m={{'category'|encrypt}}';    
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
function _move(flag){
   if(flag==1){
    s1 = "select1"; s2 = "select2";
   }else{
    s1 = "select2"; s2 = "select1";
   }
   if($("#"+s2+" option:selected").val()){
    object = $("#"+s2+" option:selected");
    $("#"+s1).append($("#"+s2+" option:selected"));
    $("#"+s2+" option:selected").remove();   
   }else{
    return false;
   }
   //传值
   var _val = "";
   $("#select2 option").each(function(){
    _val += this.value+",";
   });
   if(_val){
    _val = _val.substr(0,_val.length-1);
   }  
    $("#cids").val(_val);
}
 function searchuser()
 {
 	location.href="?m={{'vouchers'|encrypt}}&a=send&id={{$smarty.get.id}}&keyword="+$("#keyword").val();
 }
</script>

<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('./images/payment.png');">优惠券发放</h1>
    <div class="buttons"></div>
	<form id="myForm3" name="myForm" action="" method="post">
	<input type="hidden" name="sendtype"  value="custom">
	<input type="hidden" name="cids" id="cids" value="">
	</form>
  </div>
  <div class="content">
	<div class="htabs" id="tabs">
	 <a tab="#tab_useg" class="selected">会员等级</a>
                    <a tab="#tab_uname">自定义</a>
		          </div>
                <div id="tab_useg" style="display: block;">
                <form id="myForm" name="myForm" action="" method="post">
				<input type="hidden" name="id" id="id" value="{{$log.id}}">
			          <table class="form">
			            <tbody><tr>
			              <td align="right">会员等级</td>
			              <td><select name="customer_group_id">
			              <option value="">所有会员</option>
					      {{html_options options=$cglist selected=$log.customer_group_id}}
					      </select>  <a onclick="$('#myForm').submit();" class="button"><span>确定发送</span></a>
			                </td>
			            </tr>
			          </tbody></table>
			          </form>
		        </div>
                <div id="tab_uname" style="display: none;">
                <table class="form">
          <tbody>
          <tr>
            <td align="center" colspan="3">
            关键词<input type="text" name="keyword" id="keyword" value="{{$smarty.get.keyword}}"/><a onclick="searchuser();" class="button"><span>搜索</span></a>
			</td>
          </tr>
          <tr>
            <td align="right">
            <select id="select1" size="10" style="width:150px;">
			{{html_options options=$userlist}}
			</select> 
			</td>
            <td align="center"><input type="button" value=">>" id="add_lock"><br/>
				<input type="button" value="<<" id="remove_lock"></td>
            <td align="left">
            <select id="select2" size="10" style="width:150px;">
			</select>
            </td>
          </tr>
          <tr><td colspan="3"><a onclick="$('#myForm3').submit();" class="button"><span>确定发送</span></td></tr>
        </tbody></table>
                </div>
      </div>
    </form>
     <div style="clear:both"></div>
  </div>
  
</div>
<script type="text/javascript"><!--
$.tabs('#tabs a'); 
//--></script>
</div></div>
{{include file=admin/footer.tpl}}