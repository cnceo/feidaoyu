{{include file=admin/header.tpl}}
<script type="text/javascript">
$(document).ready(function(){
  $('.date').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('./images/payment.png');">{{$sites.title}}</h1>
  </div>
  <div class="content">
    <div class="htabs" id="tabs"><a href="?m={{'message'|encrypt}}">发信</a>
    <a href="?m={{'message'|encrypt}}&a=mass" class="selected">群发</a>
    <a href="?m={{'message'|encrypt}}&a=logs">记录</a>
    <a  href="?m={{'message'|encrypt}}&a=templet">模板</a>
    <a  href="?m={{'message'|encrypt}}&a=setting">设置</a>
    </div>
    <div class="htabs" id="languages">
                    <a href="?m={{'message'|encrypt}}&a=mass" class="selected"> 站内</a>
                    <a href="?m={{'message'|encrypt}}&a=massup" tab="#language2">上传</a>
		          </div>
     <form id="myForm" name="myForm" action="" method="post">
       <table class="form">
          <tbody>
			          <tr>
			              <td> 会员等级:</td>
			              <td><select name="customer_group_id">
						       <option value="">所有</option>   
						      {{html_options options=$cglist selected=$log.customer_group_id}}
						      </select>
			                </td>
			            </tr>
			             <tr>
			              <td> 注册时间:</td>
			              <td><input type="text" value="{{$smarty.get.stime}}" id="stime" class="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;结束时间&nbsp;&nbsp;<input type="text" value="{{$smarty.get.etime}}" id="etime" class="date">
			                </td>
			            </tr>
			           <tr>
			              <td>最后活跃时间:</td>
			              <td><input type="text" value="{{$smarty.get.stime}}" id="livetime" class="date">
			                </td>
			            </tr>
			            <tr>
			              <td>消费金额:</td>
			              <td> >= <input type="text" value="" id="livetime" size="10">
			                </td>
			            </tr>
			            <tr>
			              <td>积分:</td>
			              <td> >= <input type="text" value="" id="livetime"  size="10">
			                </td>
			            </tr>
			            <tr>
			              <td> 模板:</td>
			              <td><select name="tplid">
						       <option value="">请选择</option>   
						      {{html_options options=$tpllist}}
						      </select>
			                </td>
			            </tr>
        </tbody></table>
         </form>
        
  </div>
  
</div>
 <div class="buttons"><a onclick="ResetData('myForm');" class="button"><span>重置</span></a><a onclick="Save();" class="button"><span>生成发送队列</span></a><a onclick="CancelBack();" class="button"><span>放弃</span></a></div>
		      </div>
 <div style="clear:both"></div>
</div></div>
{{include file=admin/footer.tpl}}