<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<SCRIPT LANGUAGE="JavaScript">
function printpage_zzjs() {
if (window.print) {
agree = confirm('页面将被自动打印. \n\n现在就打印吗?');
if (agree) window.print();
   }
}
</script>
</head>
<body bgcolor="#fef4d9" OnLoad="printpage_zzjs()">
<style>

body{font: 12px Verdana, Helvetica, sans-serif;line-height: 18px;color: #4C4C4C;font-size: 12px; }
* { padding: 0; margin: 0; border: 0; }
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,
form,fieldset,input,textarea,p,blockquote,th,td {padding: 0;margin: 0;}
table {border-collapse: collapse;}
fieldset,img {border: 0;}
address,caption,cite,code,dfn,em,strong,th,var {font-weight: normal;font-style: normal;}
li,ol,ul {list-style: none;}
caption,th {text-align: left;}
h1,h2,h3,h4,h5,h6 {font-size: 100%;}
abbr,acronym { border: 0;}




.container{ width:800px; margin:0 auto;}
.table{ width:100%; border-top:#CCC solid 1px; border-left:#DDDDDD solid 1px; margin-top:10px}
.table tr td{ height:30px; line-height:30px; width:80%; border-bottom:#DDDDDD solid 1px; border-right:#DDDDDD solid 1px}
.table tr th{ width:100%; text-align:center; font-size:14px; font-weight:bold; border-bottom:#DDDDDD solid 1px; border-right:#DDDDDD solid 1px; height:35px; line-height:35px; }
.table tr td.c{ width:200px; text-align:right; padding-right:5px; background:#FAFAFA}
.table tr td.b{ padding-left:5px}
.table tr td.mc{ width:70%; border:0px}
.table tr td.mc2{ width:30%; padding-left:12px}
.table tr td.e{ width:160px;  background:#FAFAFA}
.table_a tr td.b{ width:86.2%;}
.right{ text-align:right; padding-right:5px}
.table_a tr th.f,.table_a tr td.f{ width:100px; text-align:center;}
.table_a tr th.name,.table_a tr td.name{ width:50%; padding-left:5px}
.table_a tr th{ background:#FAFAFA}
.table_a tr th.mc3{ text-align:right}
.table_a tr th.mc3 span{ font-size:12px; font-weight:normal; padding:0 5px}
.table_a tr th.mc3 span.bold{ font-weight:bold}
div.table{ padding:20px;  border:#DDDDDD solid 1px; width:95%}

.mc_a{ font-size:14px; padding-top:50px}

</style>
<div class="container">
  <table class="table" border="0">
      <tr>
        <th colspan="2" style="background:#FAFAFA">这是您在百万宝贝商城购物的订单 #{{$log.orderno}}</th>
      </tr>

       <tr>
          <td class="mc">
          

                  <table border="0">
                
                      <tr>
                        <td class="c">订单日期：</td>
                        <td class="b">{{$log.createtime}}</td>
                      </tr>
                      <tr>
                        <td class="c">订单编号：</td>
                        <td class="b">{{$log.orderno}}</td>
                      </tr>
                      <tr>
                        <td class="c">订单状态：</td>
                         <td class="b">{{$log.status_name}}</td>
                      </tr>
                      <tr>
                        <td class="c">支付方式：</td>
                         <td class="b">{{$log.paytype_name}}</td>
                      </tr>
                      <tr>
                        <td class="c">递送方式：</td>
                         <td class="b">{{$log.shiptype_name}}</td>
                      </tr>
                      <tr>
                        <td class="c">百万宝贝专送：</td>
                         <td class="b">专业、贴心的一站式服务</td>
                      </tr>
                      <tr>
                        <td class="c">送货日期：</td>
                         <td class="b">{{$log.transit_time}}</td>
                      </tr>
                
                  </table>
          
          </td>
          <td class="mc2">
             <ul>
                <li>百万宝贝
                服务热线: 400-720-1612</li>
                <li>传真: 21-3405-3760 * 8888</li>
                <li>E-mail: sales@m-pets.com</li>
          
          </td>
       </tr>
  </table>
  
    <table class="table table_a" border="0">
    
          <tr>
            <td class="e right">会员号：</td>
            <td class="b">{{$logu.username}}</td>
          </tr>
          <tr>
            <td class="e right">姓名：</td>
            <td class="b">{{$logu.truename}}</td>
          </tr>
          <tr>
            <td class="e right">联系电话：</td>
             <td class="b">{{$logu.mobile}} {{$logu.telephone}}</td>
          </tr>
    
    </table>
  
      <table class="table table_a" border="0">
    
          <tr>
            <td class="e right">姓名：</td>
            <td class="b">{{$log.contact}}</td>
          </tr>
           <tr>
            <td class="e right">电话：</td>
            <td class="b">{{$log.telphone}} {{$log.mobile}}</td>
          </tr>
          <tr>
            <td class="e right">地址：</td>
            <td class="b">{{$log.province}} {{$log.city}} {{$log.county}} {{$log.address}}    {{$log.postcode}}</td>
          </tr>
          <tr>
            <td class="e right">行政区：</td>
             <td class="b">{{$log.province}} {{$log.city}} {{$log.county}} </td>
          </tr>
          <tr>
            <td class="e right">最佳递送时间：</td>
             <td class="b">下午4点（每日上午10点至晚间6点)</td>
          </tr>
    
    </table>
  


    <table class="table table_a" border="0">
    
          <tr>
            <th class="f">SKU</th>
            <th class="name">商品详单</th>
            <th class="f">发货仓</th>
            <th class="f">单价</th>
            <th class="f">数量</th>
            <th class="f">总计</th>
          </tr>
           {{foreach from=$logs item=data}}
                <tr>
               <td  class="f">{{$data.sku}}</td>
               <td  class="name"><a href="/cn/product/{{$data.pid}}.html" target="_blank">{{$data.cprodname}}</a></td>
               <td class="f">上海仓</td>
               <td class="f">￥{{$data.price|string_format:"%.2f"}}</td>
               <td class="f">{{$data.buys}}</td>
               <td class="f">￥{{$data.subtotal_amount|string_format:"%.2f"}}</td>
               </tr>
         {{/foreach}}
          <tr>
          <th class="mc3 right" height="145" colspan="6" class="f">
          
           <span> 小计:RMB{{$log.price_total|string_format:"%.2f"}}</span> 
            <span>折扣减免: RMB{{$log.order_deduction|string_format:"%.2f"}}</span>   
            <span>递送费:  RMB{{$log.shipcost|string_format:"%.2f"}}</span>   
           <span class="bold"> 共计:RMB{{$log.order_total|string_format:"%.2f"}}</span> 
          
          </th>
          </tr>
    </table>

<h3 class="mc_a">顾客留言</h3>
  <div class="table">{{$log.content}}</div>

<div style="text-align:center; padding:10px 0">感谢您的惠顾!欢迎再次光临百万宝贝网上商城</div>
</div>





</body>
</html>
