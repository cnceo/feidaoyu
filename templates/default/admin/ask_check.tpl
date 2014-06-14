{{include file=admin/header.tpl}}
<script charset="utf-8" src="js/editor/kindeditor-min.js"></script>
<script charset="utf-8" src="js/editor/lang/zh_CN.js"></script>
<script charset="utf-8" src="js/editor/kindeditor-default.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myForm").validate({
    	rules: {
	    		title: {
	    			required: true
	    		},
	    		filename: {
	    			required: true
	    		},
	    		class_id: {
	    			required: true
	    		}
    	      },
    	 messages: {
    		    title: {
    		    	required: "请填写文章标题"
	    		},
	    		filename: {
    		    	required: "请填写SEO标题"
	    		},
	    		class_id: {
    		    	required: "请填写文章分类"
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
						url:  "?m={{'article'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json',
						success: function(msg){

							    if(msg.status == "true")
								    {
										   window.location= '?m={{'article'|encrypt}}';
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
			            <tbody>
			            <tr>
			              <td><span class="required">*</span> 问题标题:</td>
			              <td><input value="{{$log.title}}" size="100" name="title" id="title">
			                </td>
			            </tr>
			            <tr>
              <td><span class="required">*</span> 问题分类:</td>
              <td><select name="class_id" id="class_id"><option value="">请选择...</option>{{$catelist}}</select> <a onclick="#" class="button"><span>添加分类</span></a>
                </td>
            </tr>
			            <tr>
			              <td> 发布用户:</td>
			              <td>{{$log.uname}}
			                </td>
			            </tr>
			             <tr>
			              <td>内容:</td>
			              <td>
			              <div id="textarea2">
                          <a onclick="dotb('批量上传', '?m={{'upload'|encrypt}}&a=multiimg&t=tinymce&&input=content&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="button"><img src="js/jquery/swfupload/textarea.png" /></a>
                          <textarea name="content" style="width:100%; height:540px;" class="mceEditor">{{$log.content}}</textarea>
                          </div>
			              </td>
			            </tr>
          <tr>
            <td>主题图片:</td>
            <td valign="top">
              <img onclick="dotb('{{$langs.upload}}', '?m={{'upload'|encrypt}}&keepThis=true&TB_iframe=false&height=422&width=800');return false;" class="image" id="preview" alt="" src="{{if $log.picpath}}{{$smarty.const.IMG_HOST}}{{$log.picpath}}{{else}}./images/no_image-100x100.jpg{{/if}}" title="点击上传图片">
            <input type="hidden" id="picpath" value="{{$log.picpath}}" name="picpath">
              </td>
          </tr>
           <tr>
            <td>文章状态:</td>
            <td><select name="is_done">
                                {{html_options options=$statuslist selected=$log.is_done}}
                              </select></td>
          </tr>
           <tr>
            <td>推荐:</td>
            <td><select name="is_recommend">
                                {{html_options options=$recommendlist selected=$log.is_recommend}}
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