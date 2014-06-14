{{include file=admin/header.tpl}}
<script type="text/javascript">
function Save()
{
	$.ajax({
		type: "POST",
		url:  "?m={{'database'|encrypt}}&a=save",
		data: "type=build",
		success:function() {
			alert("操作成功");
			location.href= "?m={{'database'|encrypt}}";
		}
	}); 	
}

function Revert()
{
	if(confirm("警告：该项操作可能造成灾难性后果，请慎重操作!!!"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'database'|encrypt}}&a=save",
				data: "type=revert&dataid="+$("#datalist").val(),
				success:function() {
					alert("操作成功");
					location.href= "?m={{'database'|encrypt}}";
				}
			});
		}
}
</script>
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('./images/payment.png');">{{$sites.title}}</h1>
    <div class="buttons">
    <a onclick="CancelBack();" class="button"><span>返回</span></a>
    
    
    </div>

  </div>
  <div class="content">
    <div class="htabs" id="tabs"><a tab="#tab_general" class="selected">备份</a><a tab="#tab_data">恢复</a></div>
      <div id="tab_general" style="display: block;">
			   <table class="list">
        <thead>
          <tr>
            <td class="center">文件名称</td>
            <td class="center">时间</td>
            <td class="center">操作</td>
          </tr>
        </thead>
        <tbody>
        
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
	            <td class="left">{{$logs[data].filename}}</td>
	            <td class="center">{{$logs[data].addtime}}</td>
	            <td class="center"><a href="?m={{'database'|encrypt}}&a=download&file={{$logs[data].filename}}">下载</a></td>
	        </tr>
           {{sectionelse}}
          <tr>
            <td colspan="7" class="center">No results!</td>
          </tr>
        {{/section}}
         <tr>
            <td colspan="7" class="right"> <a onclick="Save();" class="button"><span>立即备份</span></a></td>
          </tr>
                            </tbody>
      </table> 
      </div>   
      <div id="tab_data" style="display: none;">
        <table class="form">
		        <tbody>
		         <tr>
		          <td width="100">请选择:</td>
		          <td>
		          {{html_options options=$datalist name="datalist" id="datalist"}}<a onclick="Revert();" class="button"><span>恢复</span></a> <br><span class="required">*</span> 恢复数据库前请先备份数据库
		            </td>
		        </tr>
		     </tbody>
	    </table>
      </div>
    </form>
     <div class="buttons"><a onclick="CancelBack();" class="button"><span>返回</span></a></div>
     <div style="clear:both"></div>
  </div>
  
</div>
<script type="text/javascript"><!--
$.tabs('#tabs a'); 
$.tabs('#languages a'); 
//--></script>
</div></div>
{{include file=admin/footer.tpl}}