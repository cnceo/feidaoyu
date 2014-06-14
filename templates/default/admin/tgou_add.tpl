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
	    		product: {
	    			required: true
	    		},
	    		quantity: {
	    			digits: true
	    		},
	    		priority: {
	    			digits: true
	    		},
	    		price: {
	    			number: true
	    		},
	    		point: {
	    			number: true
	    		}
    	      },
    	 messages: {
    		    product: {
    		    	required: "请选择产品"
	    		},
	    		quantity: {
	    			digits: "请输入合法的数量"
	    		},
	    		priority: {
	    			digits: "请输入合法的整数"
	    		},
	    		price: {
	    			number: "请输入合法的价格"
	    		},
	    		point: {
	    			number: "请输入合法的数字"
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
						url:  "?m={{'tgou'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m={{'tgou'|encrypt}}';    
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
			              <td>产品名称:</td>
			              <td><input type="text" name="product" value="{{$log.cprodname}}" id="product" size="50"/>
			              <input type="hidden" name="pid" value="{{$log.pid}}" id="pid"/>
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
			              <td> 数量:</td>
			              <td><input value="{{$log.quantity}}" size="10" name="quantity" id="quantity">
			                </td>
			            </tr>
			            <tr>
			              <td> 已售出:</td>
			              <td><input value="{{$log.sold_quantity}}" size="10" name="sold_quantity" id="sold_quantity">
			                </td>
			            </tr>
			            <tr>
			              <td> 购买人数量:</td>
			              <td><input value="{{$log.buyusers}}" size="10" name="buyusers" id="buyusers">
			                </td>
			            </tr>
			            <tr>
			              <td> 单价:</td>
			              <td><input value="{{$log.price|string_format:"%.2f"}}" size="10" name="price" id="price">
			                </td>
			            </tr>
			             <tr>
			              <td> 积分:</td>
			              <td><input value="{{$log.point}}" size="10" name="point" id="point">
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
        </tbody></table>
      
      </div>
    </form>
     <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="$('#myForm').submit();" class="button"><span>保存</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
     <div style="clear:both"></div>
  </div>
  
</div>

</div></div>
{{include file=admin/footer.tpl}}