{{include file=admin/header.tpl}}
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>

<script type="text/javascript">
$(document).ready(function(){
$('.date1').datepicker({dateFormat: 'yy-mm-dd'});
  $("#myForm").validate({
    	rules: {

    	      },
    	 messages: {
    	      }
   	 });
});

$.validator.setDefaults({
	 submitHandler: function() {
	 	      var data = $("#myForm").formToArray();
				$.ajax({
				type: "POST",
				url:  "?m={{'order'|encrypt}}&a=savePost_domain",
				data: data,
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							alert("处理成功");
							window.location= '?m={{'order'|encrypt}}&a=domain';
						 }
						 else
						{
							alert(msg.message);
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
    <h1 style="background-image: url('./images/payment.png');">{{$sites.title}}详情</h1>
  </div>
  <div class="content">

      <div id="tab_general" style="display: block;">
			          <table class="form">
			            <tbody>
			            <tr>
			              <td> 订单编号:</td>
			              <td>{{$order_id}}</td>
			            </tr>
			            <tr>
			              <td> 邮箱:</td>
			              <td>{{$email}}</td>
			            </tr>
			            <tr>
			              <td> 创建时间:</td>
			              <td>{{$log.addtime}}</td>
			            </tr>
			            <tr>
			            <td>域名:</td>
			            <td>
			            {{$log.domain}}
			            </td>
			            </tr>
			             <form id="myForm" name="myForm" action="" method="post">
			             <tr>
			            <td>有效期:</td>
			            <td>
			            <input type="text" name="year" id="year" value="{{$log.year}}">年
			            </td>
			            </tr>

			              <tr>
			            <td>时间:</td>
			            <td>
			            起始日<input type="text" name="stime" class="date1" value="{{$log.stime}}">-到期日<input type="text" name="etime" class="date1" value="{{$log.etime}}">
			            </td>
			            </tr>

	            <input type="hidden" name="id" id="id" value="{{$log.id}}">
			<tr>
			<td>处理状态</td>
			<td><select id="status" name="status">
                                {{html_options options=$domainstatus selected=$log.status}}
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