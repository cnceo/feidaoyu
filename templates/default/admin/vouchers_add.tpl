{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/jquery/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   $('.date1').datepicker({dateFormat: 'yy-mm-dd'});
  $("#myForm").validate({
    	rules: {
	    		cvouchername: {
	    			required: true
	    		},
	    		money: {
	    			required: true,
	    			min: 0
	    		},
	    		orderamount: {
	    			required: true,
	    			min: 0
	    		},
	    		use_start_date: {
	    			required: true,
	    			date:true
	    		},
	    		use_end_date: {
	    			required: true,
	    			date:true
	    		}
    	      },
    	 messages: {
    		    cvouchername: {
    		    	required: "请填写优惠券名称"
	    		},
	    		money: {
	    			required: "请输入金额",
	    			digits: "请输入合法的金额"
	    		},
	    		orderamount: {
	    			required: "请输入>0的订单金额",
	    			min: "请输入>0的订单金额"
	    		},
	    		use_start_date: {
	    			required: "请选择使用开始时间",
	    			date:"必须输入正确格式的日期"
	    		},
	    		use_end_date: {
	    			required: "请选择使用结束时间",
	    			date:"必须输入正确格式的日期"
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
						url:  "?m={{'vouchers'|encrypt}}&a=savePost",
						data: data,
						dataType: 'json', 
						success: function(msg){
							    
							    if(msg.status == "true")
								    {
										   window.location= '?m={{'vouchers'|encrypt}}';    
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
		
		function showunit(get_value)
		{
			if(get_value == 2) 
			  {
			  	$("#1").show();
			  }else
			  {
			  	$("#1").hide();
			  }
			  if(get_value>0)
			  {
			  	$("#2").show();
			  	$("#3").show();
			  }
			  else
			  {
			  	$("#2").hide();
			  	$("#3").hide();
			  }
		}
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
			              <td>优惠券名称(CN):</td>
			              <td><input type="text" name="cvouchername" value="{{$log.cvouchername}}"  size="50"/>
			                </td>
			            </tr>
			            <tr>
			              <td>优惠券名称(EN):</td>
			              <td><input type="text" name="evouchername" value="{{$log.evouchername}}"  size="50"/>
			                </td>
			            </tr>
			            <tr>
			              <td>优惠券名称(JP):</td>
			              <td><input type="text" name="jvouchername" value="{{$log.jvouchername}}"  size="50"/>
			                </td>
			            </tr>
			            <tr>
			              <td> 金额:</td>
			              <td><input value="{{$log.money|string_format:"%.2f"}}" size="10" name="money" id="money">	可以抵销的金额
			                </td>
			            </tr>
			            <tr>
			              <td> 最小订单金额:</td>
			              <td><input value="{{$log.orderamount|string_format:"%.2f"}}" size="10" name="orderamount" id="orderamount">	只有商品总金额达到这个数的订单才能使用这种红包
			                </td>
			            </tr>
			            <tr>
			              <td> 发放方式:</td>
			              <td>
							{{foreach from=$sendtype item=item key=key}}
							<input name="send_type" value="{{$key}}" {{if $key==$log.send_type}}checked{{/if}} onclick="showunit({{$key}})" type="radio">{{$item}}
							{{/foreach}}
			                </td>
			            </tr>
			            <tr id="1" {{if $log.send_type!="2"}}style="display: none;"{{/if}}>
			              <td> 订单下限:</td>
			              <td><input value="{{$log.minorderamount|string_format:"%.2f"}}" size="10" name="minorderamount" id="minorderamount">	只要订单金额达到该数值，就会发放红包给用户</td>
			            </tr>
			              <tr  id="2" {{if $log.send_type=="0"}}style="display: none;"{{/if}}>
			              <td> 发放开始时间:</td>
			              <td><input type="text" id="send_start_date" name="send_start_date" value="{{$log.send_start_date}}" class="date1" /></td>
			            </tr>
			             <tr  id="3" {{if $log.send_type=="0"}}style="display: none;"{{/if}}>
			              <td> 发放结束时间:</td>
			              <td><input type="text" id="send_end_date" name="send_end_date" value="{{$log.send_end_date}}" class="date1" />
</td>
			            </tr>
			             <tr>
			              <td> 使用开始时间:</td>
			              <td><input type="text" id="use_start_date" name="use_start_date" value="{{$log.use_start_date}}" class="date1" /></td>
			            </tr>
			             <tr>
			              <td> 使用结束时间:</td>
			              <td><input type="text" id="use_end_date" name="use_end_date" value="{{$log.use_end_date}}" class="date1" />
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