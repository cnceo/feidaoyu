{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/editor/tiny_mce.js"></script>
<script type="text/javascript" src="js/editor/editor_simple.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		name: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    name: {
    		    	required: "请填写名称"
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
						url:  "?m={{'parameter'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    textname_val = $("#{{$smarty.get.textname}}", window.parent.document).val();
							    if(msg.status == "true")
								    {
										   $("#{{$smarty.get.keyname}}", window.parent.document).append("<option value='"+msg.id+"'>"+$("#name").val()+"</option");
										   if(textname_val)
										   {
										   		textname_val = textname_val + ","+msg.id;
										   }
										   else
										   {
										   		textname_val = msg.id;
										   }
										   $("#{{$smarty.get.textname}}", window.parent.document).val(textname_val);
										   self.parent.tb_remove();  
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
			            <tbody><tr>
			              <td><span class="required">*</span> 名称:</td>
			              <td><input value="{{$log.name}}" size="100" name="name" id="name">
			                </td>
			            </tr>
			          <!--  <tr>
			            <td>分类:</td>
			            <td><select name="pid">
                                {{html_options options=$catelist selected=$log.pid}}
                              </select></td>
			           </tr>-->
			            <tr>
			              <td>描述</td>
			              <td><textarea rows="5" cols="40" name="content">{{$log.content}}</textarea></td>
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