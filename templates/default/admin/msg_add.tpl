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

	function Back()
	{
		
			history.go(-1);
		
	}	
</script>
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('./images/payment.png');">{{if $log.id==""}}添加{{else}}修改{{/if}}{{$sites.title}}</h1>
    <div class="buttons">

    <a onclick="Back();" class="button"><span>返回</span></a></div>

  </div>
  <div class="content">
    <form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
      <div id="tab_general" style="display: block;">
	<table class="form">
		<tbody>
				<tr>
			         <td><span class="required"></span> 留言人:</td>
			          <td> {{$log.name}}    </td>
			     </tr>
			      <tr>
			           <td>留言内容:</td>
			           <td>{{$log.content}}</td>
			       </tr>
          		<tr>
            		<td>电话:</td>
            		<td>{{$log.tel}}</td>
          		</tr>
          		<tr>
            		<td>邮箱:</td>
            		<td>{{$log.email}}</td>
          		</tr>
           		<tr>
            		<td>状态:</td>
            		<td>{{$log.type}}</td>
          		</tr>
          		
          		
        </tbody>
      </table>

      </div>
    </form>
     <div class="buttons">
     <a onclick="Back();" class="button"><span>返回</span></a></div>
     <div style="clear:both"></div>
  </div>

</div>

</div></div>
{{include file=admin/footer.tpl}}