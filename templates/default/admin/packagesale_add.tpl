{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/jquery/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   $('#product').autocomplete("?m={{'product'|encrypt}}&a=listword",{
						             delay:10,              
						            minChars:0,              
						            matchSubset:0,              
						            matchContains:1,              
						            cacheLength:10,
						            autoFill:true
						         });
    $('#product').result(function(event, data, formatted) {
        $('#pid').val(data[1]);
        $('#price').val(data[2]);
        $('#quantity').val(data[3]);
      });
   $('.date1').datetimepicker({dateFormat: 'yy-mm-dd'});
  $("#myForm").validate({
    	rules: {
	    		title: {
	    			required: true
	    		},
	    		discount: {
	    			required: true,
	    			digits: true,
	    			minlength: 2,
	    			maxlength: 2
	    		},
	    		point: {
	    			number: true
	    		}
    	      },
    	 messages: {
    		    title: {
	    			required: "请输入名称"
	    		},
	    		discount: {
	    			required: "请输入折扣",
	    			digits: "请输入正确的折扣，例：70折",
	    			minlength: "请输入正确的折扣，例：70折",
	    			maxlength: "请输入正确的折扣，例：70折"
	    		},
	    		point: {
	    			number: true
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
						url:  "?m={{'packagesales'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m={{'packagesales'|encrypt}}';    
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
			              <td>名称:</td>
			              <td><input type="text" name="title" value="{{$log.title}}" id="title" size="50"/>
			                </td>
			            </tr>
			            <tr>
			              <td> 客户群:</td>
			              <td><select  name="customer_group_id">
		          <option value="0">所有会员</option>
		          {{html_options options=$grouplist selected=$log.customer_group_id}}
		          </select>
			                </td>
			            </tr>
			            <tr>
			              <td> 优先级:</td>
			              <td><input value="{{$log.priority}}" size="10" name="priority" id="priority">
			                </td>
			            </tr>
			            <tr>
			              <td> 折扣:</td>
			              <td><input value="{{$log.discount}}" size="10" name="discount" id="discount">
			                </td>
			            </tr>
			             <tr>
			              <td> 积分:</td>
			              <td><input value="{{$log.point|default:"-1"}}" size="10" name="point" id="point">  购买该组合商品时赠送消费积分数,-1表示按商品价格赠送
			                </td>
			            </tr>
			            
			             <tr>
			              <td> 开始时间:</td>
			              <td><input type="text" name="date_start" value="{{$log.date_start}}" class="date1" /></td>
			            </tr>
			             <tr>
			              <td> 结束时间:</td>
			              <td><input type="text" name="date_end" value="{{$log.date_end}}" class="date1" />
			              </td>
			            </tr>
			            <tr>
			            <td colspan="2">
			             <table id="package" class="list">
					          <thead>
					            <tr>
					             <td class="left">产品名称</td>
					              <td class="left">数量</td>
					              <td width="80" class="center">操作</td>
					            </tr>
					          </thead>
					          {{section name=data1 loop=$logs}}
					          <tbody id="package_row{{$smarty.section.data1.index}}">
					            <tr>
					             <td class="left">
					             <input type="text" name="product_package[{{$smarty.section.data1.index}}][product]" value="{{$logs[data1].cprodname}}" class="product"/>
					             <input type="hidden" name="product_package[{{$smarty.section.data1.index}}][pid]" value="{{$logs[data1].pid}}" class="pid"/>
					             </td>
					              <td class="left"><input type="text" name="product_package[{{$smarty.section.data1.index}}][quantity]" value="{{$logs[data1].quantity}}" size="2" /></td>
					              <td class="center"><a onclick="$('#package_row{{$smarty.section.data1.index}}').remove();" class="button"><span>删除</span></a></td>
					            </tr>
					          </tbody>
					          {{/section}}
					           <tfoot>
					
					            <tr>
					              <td colspan="2"></td>
					              <td class="left" colspan="2"><a onclick="addpackage();" class="button"><span>添加</span></a></td>
					            </tr>
					          </tfoot>
					        </table>
			            </td>
			            </tr>
        </tbody></table>
      
      </div>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>
  
</div>
<script type="text/javascript"><!--
var package_row = {{$smarty.section.data1.index|default:"0"}};
function addpackage() {
	html  = '<tbody id="package_row' + package_row + '">';
	html += '<tr>'; 
	html += '<td class="left"><input type="text" name="product_package[' + package_row + '][product]" value="" class="product" size="80"/><input type="hidden" name="product_package[' + package_row + '][pid]" value="" class="pid"/></td>';	
    html += '<td class="left"><input type="text" name="product_package[' + package_row + '][quantity]" value="1" size="2" /></td>';
	html += '<td class="left"><a onclick="$(\'#package_row' + package_row + '\').remove();" class="button"><span>删除</span></a></td>';
	html += '</tr>';	
    html += '</tbody>';
	
	$('#package tfoot').before(html);
	$('#package_row' + package_row + ' .product').autocomplete("?m={{'product'|encrypt}}&a=listword",{
						             delay:10,              
						            minChars:0,              
						            matchSubset:0,              
						            matchContains:1,              
						            cacheLength:10
						         });
    $('#package_row' + package_row + ' .product').result(function(event, data, formatted) {
        $('#'+$(this).parent().parent().parent('tbody').attr('id')+' .pid').val(data[1]);
        $('#'+$(this).parent().parent().parent('tbody').attr('id')+' .price').val(data[2]);
      });
	package_row++;
}
//-->
</script>
</div></div>
{{include file=admin/footer.tpl}}