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
			              <td><span class="required">*</span> 文章标题:</td>
			              <td><input value="{{$log.title}}" size="100" name="title" id="title">
			                </td>
			            </tr>
			             <tr>
			              <td><span class="required">*</span> SEO标题:</td>
			              <td><input value="{{$log.filename}}" size="100" name="filename" id="filename">
			                </td>
			            </tr>
			            <tr>
              <td><span class="required">*</span> 文章分类:</td>
              <td><select name="class_id" id="class_id"><option value="">请选择...</option>{{$catelist}}</select> <a onclick="#" class="button"><span>添加分类</span></a>
                </td>
            </tr>
			            <tr>
			              <td>Meta Tag Keywords:</td>
			              <td><textarea rows="3" cols="40" name="meta_keywords">{{$log.meta_keywords}}</textarea></td>
			            </tr>
			            <tr>
			              <td>Meta Tag Description:</td>
			              <td><textarea rows="3" cols="40" name="meta_description">{{$log.meta_description}}</textarea></td>
			            </tr>
			            <tr>
			              <td> 作者:</td>
			              <td><input value="{{$log.source}}" size="100" name="source" id="source">
			                </td>
			            </tr>
			            <tr>
			              <td> 来源:</td>
			              <td><input value="{{$log.author}}" size="100" name="author" id="author">
			                </td>
			            </tr>
			            <tr>
			              <td>描述:</td>
			              <td><textarea name="description" rows="3" cols="40">{{$log.description}}</textarea></td>
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
            <td><select name="status">
                                {{html_options options=$statuslist selected=$log.status}}
                              </select></td>
          </tr>
           <tr>
            <td>语言:</td>
            <td><select name="lang">
                                {{html_options options=$langlist selected=$log.lang}}
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