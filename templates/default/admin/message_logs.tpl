{{include file=admin/header.tpl}}
<script type="text/javascript">
$(document).ready(function(){
  $('.date').datepicker({dateFormat: 'yy-mm-dd'});
});
function go()
{
	location.href = "?m={{'message_logs'|encrypt}}&uname="+$("#uname").val()+"&stime="+$("#stime").val()+"&etime="+$("#etime").val();
}
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
    <a href="?m={{'message'|encrypt}}&a=mass">群发</a>
    <a href="?m={{'message'|encrypt}}&a=logs" class="selected">记录</a>
    <a href="?m={{'message'|encrypt}}&a=templet" >模板</a>
    <a  href="?m={{'message'|encrypt}}&a=setting">设置</a>
    </div>
     <table class="list">
        <thead>
          <tr>
            <td class="center">帐户</td>
            <td class="center">手机</td>
            <td class="center">短信内容</td>
            <td class="center">状态</td>
            <td class="center">时间</td>
          </tr>
        </thead>
        <tbody>
         <tr class="filter">
            <td class="center"><input type="text" value="{{$smarty.get.uname}}" id="uname"></td>
            <td class="center" colspan="3">开始时间&nbsp;&nbsp;<input type="text" value="{{$smarty.get.stime}}" id="stime" class="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;结束时间&nbsp;&nbsp;<input type="text" value="{{$smarty.get.etime}}" id="etime" class="date"></td>
            <td class="center"><a onclick="go();" class="button"><span>搜索</span></a></td>
          </tr>
         </form>
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
            <td class="left">{{$logs[data].uname}}</td>
            <td class="left">{{$logs[data].mobile}}</td>
            <td class="left">{{$logs[data].msgtext}}</td>
            <td class="left">{{$logs[data].msgresult}}</td>
            <td class="center" width="150">{{$logs[data].addtime}}</td>
          </tr>
           {{sectionelse}}
          <tr>
            <td colspan="7" class="center">No results!</td>
          </tr>
        {{/section}}
        
                            </tbody>
      </table>
      <div class="buttons">{{include file=admin/pages.tpl}} 
      <div style="clear:both"></div>
      </div>
 <div style="clear:both"></div>
  </div>
  
</div>
</div></div>
{{include file=admin/footer.tpl}}