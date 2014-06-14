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
    <a class="selected">购买/赠品</a>
   <!-- <a href="?m={{'customer'|encrypt}}&a=points&uid={{$smarty.get.uid}}">积分记录</a>
    <a href="?m={{'customer'|encrypt}}&a=comment&uid={{$smarty.get.uid}}">评论列表</a>--></div>
       <table class="list">
        <thead>
          <tr>
          <td class="left">订单编号</td>
            <td class="left">联系人/手机</td>
             <td class="right">数量/金额</td>
            <td class="center">收货地址/电话</td>
            <td class="center">状态</td>
             <td class="center">创建时间</td>
          </tr>
        </thead>
        <tbody>
         </form>
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
            <td class="left"><a href="?m={{'order'|encrypt}}&a=detail&orderno={{$logs[data].orderno}}" target="_blank">{{$logs[data].orderno}}</a></td>
            <td class="left">{{$logs[data].contact}}<br> {{$logs[data].mobile}} </td>
            <td class="left">{{$logs[data].quantity}}<br>￥{{$logs[data].price_total}}</td>
            <td class="left">{{$logs[data].province}} {{$logs[data].city}} {{$logs[data].county}} {{$logs[data].address}} <br> {{$logs[data].telphone}}</td>
            <td class="center">{{$logs[data].status}}</td>
            <td class="center">{{$logs[data].createtime}}</td>
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