{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/editor/tiny_mce.js"></script>
<script type="text/javascript" src="js/editor/editor_full.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		title: {
	    			required: true
	    		},
	    		content: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    title: {
    		    	required: "请填写标题"
	    		},
	    		content: {
    		    	required: "请填写内容"
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
			 	tinyMCE.triggerSave(false, false);
			 	var data = $("#myForm").formToArray();
						$.ajax({
						type: "POST",
						url:  "?m={{'success'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json',
						success: function(msg){

							    if(msg.status == "true")
								    {
										   window.location= '?m={{'success'|encrypt}}';
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
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
      <div id="tab_general" style="display: block;">
			          <table class="form">
			            <tbody><tr>
			              <td><span class="required">*</span> 标题:</td>
			              <td><input value="{{$log.title}}" size="50" name="title" id="title">
			                </td>
			            </tr>
			            <tr>
			              <td>内容:</td>
			              <td><textarea name="content" rows="8" cols="50">{{$log.content}}</textarea></td>
			            </tr>
          <tr>
            <td>主题图片:</td>
            <td valign="top">
              <img onclick="dotb('{{$langs.upload}}', '?m={{'upload'|encrypt}}&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="image" id="preview" alt="" src="{{if $log.picpath}}{{$smarty.const.IMG_HOST}}{{$log.picpath}}.100x100.jpg{{else}}./images/no_image-100x100.jpg{{/if}}" title="点击上传图片">
              <input type="hidden" id="picpath" value="{{$log.picpath}}" name="picpath">
              </td>
          </tr>
           <tr>
            <td>状态:</td>
            <td><select name="status">
                                {{html_options options=$statuslist selected=$log.status}}
                              </select></td>
          </tr>
        </tbody></table>

      </div>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>

</div>

</div></div>
{{include file=admin/footer.tpl}}