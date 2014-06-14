{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/jquery/jquery.json-1.3.js"></script>
<script type="text/javascript" src="js/jquery/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.product').autocomplete("?m={{'parameter'|encrypt}}&a=listword",{
						             delay:10,              
						            minChars:0,              
						            matchSubset:0,              
						            matchContains:1,              
						            cacheLength:10,
						            autoFill:true
						         });
});
   function savesubmit()
	{
		var data = $("#myForm").formToArray();
		if(confirm("确认进行合并吗？,本次操作为不可逆操作!"))
		{	
			$.ajax({
				type: "POST",
				url:  "?m={{'parameter'|encrypt}}&a=saveMerge",
				data: data,
				dataType: 'json', 
				success: function(msg){
					    
					    if(msg.status == "true")
						    {
								   window.location= '?m={{'parameter'|encrypt}}';    
						    }
						    else
						    {
						    	$(".warning").html(msg.message);
						    	$(".warning").css('display','block');
						    }	 
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
    <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="savesubmit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>

  </div>
  <div class="content">
                      
		  <form id="myForm" name="myForm" action="" method="post">	          
        <table id="countdown" class="list">
          <thead>
            <tr>
             <td class="left">参数合并</td>
              <td></td>
            </tr>
          </thead>
          {{section name=data1 loop=$countdowns}}
          <tbody id="param_row{{$smarty.section.data1.index}}">
            <tr>
             <td class="left">
             参数名称:<input type="text" name="product_vals[{{$smarty.section.data1.index}}][name]" value="{{$countdowns[data1].name}}" class="product"/>{{if $logs[data].status=='0'}}<span style="color:red;">下架</span>{{/if}}
             <input type="hidden" name="product_vals[{{$smarty.section.data1.index}}][id]" value="{{$countdowns[data1].id}}" class="pid"/>
             </td>
              <td class="left"><a onclick="$('#param_row{{$smarty.section.data1.index}}').remove();" class="button"><span>删除</span></a></td>
            </tr>
          </tbody>
          {{/section}}
           <tfoot>

            <tr>
              <td></td>
              <td class="left"><a onclick="addcountdown();" class="button"><span>添加</span></a></td>
            </tr>
            <tr>
              <td colspan="2">合并成:<input type="text" name="name" value=""/></td>
            </tr>
          </tfoot>
        </table>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="savesubmit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>
  
</div>

<script type="text/javascript"><!--
var param_row = {{$smarty.section.data1.index|default:"0"}};

function addcountdown() {
	html  = '<tbody id="param_row' + param_row + '">';
	html += '<tr>'; 
	html += '<td class="left">参数名称:<input type="text" name="product_vals[' + param_row + '][name]" value="" class="product"/><input type="hidden" name="product_vals[' + param_row + '][id]" value="" class="pid"/></td>';	
	html += '<td class="left"><a onclick="$(\'#param_row' + param_row + '\').remove();" class="button"><span>删除</span></a></td>';
	html += '</tr>';	
    html += '</tbody>';
	
	$('#countdown tfoot').before(html);
		
	$('#param_row' + param_row + ' .date').datetimepicker({dateFormat: 'yy-mm-dd'});
	$('#param_row' + param_row + ' .product').autocomplete("?m={{'product'|encrypt}}&a=listword",{
						             delay:10,              
						            minChars:0,              
						            matchSubset:0,              
						            matchContains:1,              
						            cacheLength:10
						         });
      $('#param_row' + param_row + ' .product').result(function(event, data, formatted) {
        $('#'+$(this).parent().parent().parent('tbody').attr('id')+' .pid').val(data[1]);
        $('#'+$(this).parent().parent().parent('tbody').attr('id')+' .price').val(data[2]);
      });
	param_row++;
}
//-->
</script>

</div></div>
{{include file=admin/footer.tpl}}