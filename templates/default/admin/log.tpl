{{include file=admin/header.tpl}}
<script type="text/javascript">
$(document).ready(function(){
  $('.date').datepicker({dateFormat: 'yy-mm-dd'});
});
function go()
{
	location.href = "?m={{'log'|encrypt}}&uname="+$("#uname").val()+"&stime="+$("#stime").val()+"&etime="+$("#etime").val();
}
</script>
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">    
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/keyword.png) no-repeat; overflow:hidden; width:160px">日志列表</h1>
  </div>   
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td class="center">帐户</td>
            <td class="center">记录</td>
            <td class="center">时间</td>
          </tr>
        </thead>
        <tbody>
         <tr class="filter">
            <td class="center"><input type="text" value="{{$smarty.get.uname}}" id="uname"></td>
            <td class="center">开始时间&nbsp;&nbsp;<input type="text" value="{{$smarty.get.stime}}" id="stime" class="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;结束时间&nbsp;&nbsp;<input type="text" value="{{$smarty.get.etime}}" id="etime" class="date"></td>
            <td class="center"><a onclick="go();" class="button"><span>搜索</span></a></td>
          </tr>
         </form>
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
            <td class="left">{{$logs[data].uname}}</td>
            <td class="left">{{$logs[data].content}}</td>
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

  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}