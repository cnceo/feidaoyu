{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/jquery/jquery.json-1.3.js"></script>
<script type="text/javascript" src="js/jquery/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.date').datetimepicker({dateFormat: 'yy-mm-dd'});
  $('.product').autocomplete("?m={{'product'|encrypt}}&a=listword",{
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
			$.ajax({
			type: "POST",
			url:  "?m={{'today'|encrypt}}&a=savePost",
			data: data,
			dataType: 'json', 
			success: function(msg){
				    
				    if(msg.status == "true")
					    {
							   window.location= '?m={{'today'|encrypt}}';    
					    }
					    else
					    {
					    	$(".warning").html(msg.message);
					    	$(".warning").css('display','block');
					    }	 
			   }
		}); 	
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
             <td class="left">产品名称:</td>
              <td class="left">客户群:</td>
              <td class="left">数量:</td>
              <td class="left">优先级:</td>

              <td class="left">单价:</td>
              <td class="left">开始时间:</td>
              <td class="left">结束时间:</td>
              <td></td>
            </tr>
          </thead>
          {{section name=data1 loop=$countdowns}}
          <tbody id="countdown_row{{$smarty.section.data1.index}}">
            <tr>
             <td class="left">
             <input type="text" name="product_countdown[{{$smarty.section.data1.index}}][product]" value="{{$countdowns[data1].cprodname}}" class="product"/>{{if $logs[data].status=='0'}}<span style="color:red;">下架</span>{{/if}}
             <input type="hidden" name="product_countdown[{{$smarty.section.data1.index}}][pid]" value="{{$countdowns[data1].pid}}" class="pid"/>
             </td>
              <td class="left"><select  name="product_countdown[{{$smarty.section.data1.index}}][customer_group_id]">
		          <option value="0">所有会员</option>
		          {{foreach from=$grouplist item=data}}<option value="{{$data.id}}" {{if $countdowns[data1].customer_group_id == $data.id}}selected{{/if}}>{{$data.cname}}</option>{{/foreach}}
		          </select></td>
              <td class="left"><input type="text" name="product_countdown[{{$smarty.section.data1.index}}][quantity]" value="{{$countdowns[data1].quantity}}" size="2" /></td>
              <td class="left"><input type="text" name="product_countdown[{{$smarty.section.data1.index}}][priority]" value="{{$countdowns[data1].priority}}" size="2" /></td>
              <td class="left"><input type="text" name="product_countdown[{{$smarty.section.data1.index}}][price]" value="{{$countdowns[data1].price|string_format:"%.2f"}}" /></td>
              <td class="left"><input type="text" name="product_countdown[{{$smarty.section.data1.index}}][date_start]" value="{{$countdowns[data1].date_start}}" class="date" /></td>
              <td class="left"><input type="text" name="product_countdown[{{$smarty.section.data1.index}}][date_end]" value="{{$countdowns[data1].date_end}}" class="date" /></td>
              <td class="left"><a onclick="$('#countdown_row{{$smarty.section.data1.index}}').remove();" class="button"><span>删除</span></a></td>
            </tr>
          </tbody>
          {{/section}}
           <tfoot>

            <tr>
              <td colspan="6"></td>
              <td class="left" colspan="2"><a onclick="addcountdown();" class="button"><span>添加</span></a></td>
            </tr>
          </tfoot>
        </table>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="savesubmit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>
  
</div>

<script type="text/javascript"><!--
var countdown_row = {{$smarty.section.data1.index|default:"0"}};

function addcountdown() {
	html  = '<tbody id="countdown_row' + countdown_row + '">';
	html += '<tr>'; 
	html += '<td class="left"><input type="text" name="product_countdown[' + countdown_row + '][product]" value="" class="product"/><input type="hidden" name="product_countdown[' + countdown_row + '][pid]" value="" class="pid"/></td>';	
    html += '<td class="left"><select name="product_countdown[' + countdown_row + '][customer_group_id]" style="margin-top: 3px;">';
    html += '<option value="0">所有会员</option>';
    {{foreach from=$grouplist item=data}}
        html += '<option value="{{$data.id}}">{{$data.cname}}</option>';
    {{/foreach}}
        html += '</select></td>';		
    html += '<td class="left"><input type="text" name="product_countdown[' + countdown_row + '][quantity]" value="" size="2" /></td>';
    html += '<td class="left"><input type="text" name="product_countdown[' + countdown_row + '][priority]" value="" size="2" /></td>';
	html += '<td class="left"><input type="text" name="product_countdown[' + countdown_row + '][price]" value="" class="price"/></td>';
    html += '<td class="left"><input type="text" name="product_countdown[' + countdown_row + '][date_start]" value="" class="date" /></td>';
	html += '<td class="left"><input type="text" name="product_countdown[' + countdown_row + '][date_end]" value="" class="date" /></td>';
	html += '<td class="left"><a onclick="$(\'#countdown_row' + countdown_row + '\').remove();" class="button"><span>删除</span></a></td>';
	html += '</tr>';	
    html += '</tbody>';
	
	$('#countdown tfoot').before(html);
		
	$('#countdown_row' + countdown_row + ' .date').datetimepicker({dateFormat: 'yy-mm-dd'});
	$('#countdown_row' + countdown_row + ' .product').autocomplete("?m={{'product'|encrypt}}&a=listword",{
						             delay:10,              
						            minChars:0,              
						            matchSubset:0,              
						            matchContains:1,              
						            cacheLength:10
						         });
      $('#countdown_row' + countdown_row + ' .product').result(function(event, data, formatted) {
        $('#'+$(this).parent().parent().parent('tbody').attr('id')+' .pid').val(data[1]);
        $('#'+$(this).parent().parent().parent('tbody').attr('id')+' .price').val(data[2]);
      });
	countdown_row++;
}
//-->
</script>

</div></div>
{{include file=admin/footer.tpl}}