{{include file=admin/header.tpl}}
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('./images/payment.png');">{{$sites.title}}</h1>
  </div>
  <div class="content">
    <div class="htabs" id="tabs"><a href="?m={{'customer'|encrypt}}&a=detail&uid={{$smarty.get.uid}}" >基本资料</a>
    <a href="?m={{'customer'|encrypt}}&a=buys&uid={{$smarty.get.uid}}">购买情况</a>
    <a class="selected">积分明细</a>
    <a href="?m={{'customer'|encrypt}}&a=comment&uid={{$smarty.get.uid}}">评论列表</a></div>
       <table class="list">
        <thead>
          <tr>
			<td class="left">积分日期</td>
			<td class="left">来源</td>
			<td class="left">积分数</td>
          </tr>
        </thead>
        <tbody>
         </form>
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
            <td class="center">{{$logs[data].createtime}}</td>
            <td class="left">{{$logs[data].title}}</td>
            <td class="left">{{$logs[data].point}}</td>
          </tr>
           {{sectionelse}}
          <tr>
            <td colspan="7" class="center">No results!</td>
          </tr>
        {{/section}}
                            </tbody>
      </table>
  <div class="buttons">
        {{include file=admin/pages.tpl}} 
      <div style="clear:both"></div>
      </div>
  </div>
  
</div>
</div></div>
{{include file=admin/footer.tpl}}