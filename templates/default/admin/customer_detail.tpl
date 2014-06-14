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
    <div class="htabs" id="tabs"><a class="selected">基本资料</a>
    <a href="?m={{'customer'|encrypt}}&a=buys&uid={{$log.id}}">购买/赠品</a>
   <!-- <a href="?m={{'customer'|encrypt}}&a=points&uid={{$log.id}}">积分记录</a>
    <a href="?m={{'customer'|encrypt}}&a=comment&uid={{$log.id}}">评论列表</a>--></div>
      <table class="form">
        <tbody>
         <tr>
          <td width="100px" style="right">真实姓名:</td>
          <td>{{$log.truename}}   ({{$log.status}})
          </td>
        </tr>
         <tr>
          <td>用户名:</td>
          <td>{{$log.username}}
          </td>
        </tr>
         <tr>
          <td>昵称:</td>
          <td>{{$log.nickname}}
          </td>
        </tr>
         <tr>
          <td>会员等级</td>
          <td>{{$log.customer_group_id}}
	  </td>
        </tr>
         <tr>
          <td>性别</td>
          <td>{{if $log.gender=="1"}}男{{else}}女{{/if}}</td>
        </tr>
	<tr>
          <td>手机号码</td>
          <td>{{$log.mobile}}</td>
        </tr>
	<tr>
	<tr>
          <td>电话号码</td>
          <td>{{$log.telphone}}</td>
        </tr>
	<tr>
          <td>电子邮件</td>
          <td>{{$log.email}}</td>
        </tr>
	<tr>
          <td>出生年月日</td>
          <td>{{$log.year}}-{{$log.month}}-{{$log.day}}
	  </td>
        </tr>
	<tr>
          <td>联系住址</td>
          <td>{{$log.province}}  {{$log.city}} {{$log.county}}<br/>
			  {{$log.address}}</td>
        </tr>
	<tr>
          <td>邮政编码</td>
          <td>{{$log.postcode}}</td>
        </tr>
			          </tbody></table>
		      </div>
 <div style="clear:both"></div>
  </div>
  
</div>
</div></div>
{{include file=admin/footer.tpl}}