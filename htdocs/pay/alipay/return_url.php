 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="虚拟主机,主机,域名,域名注册,域名申请,cn域名注册,cn个人域名注册,vps,vps主机,免费虚拟主机转入,成都域名申请,月付主机空间,成都域名注册,成都主机,成都虚拟主机注册,双线主机,主机试用,linux主机,PHP主机空间,ASP主机空间,ASP.NET主机,wap主机,网站主机空间,网页主机空间,服务器租用,vps主机租用,vps服务器,免费域名解析,域名交易,域名停放,个人域名注册">
<meta name="keywords" content="虚拟主机,域名注册,域名注册,VPS主机租用,企业邮箱服务.虚拟主机|域名注册中心.提供免费虚拟主机转入,热门网站程序官方认证专用虚拟主机,专业Linux虚拟主机,双线虚拟主机">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="refresh" content="1;url=/user/order.html">
<title>飞刀鱼主机，全球最低价-飞刀鱼feidaoyu.com</title>
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/js/static.js"></script>
<script type="text/javascript" src="/js/jquery/thickbox/thickbox.js"></script>
<link  rel="stylesheet" type="text/css" href="/js/jquery/thickbox/thickbox.css" />
</head>
<?php
/*
	*功能：付完款后跳转的页面（页面跳转同步通知页面）
	*版本：3.1
	*日期：2010-10-29
	'说明：
	'以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
	'该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

*/
///////////页面功能说明///////////////
//该页面可在本机电脑测试
//该页面称作“页面跳转同步通知页面”，是由支付宝服务器同步调用，可当作是支付完成后的提示信息页，如“您的某某某订单，多少金额已支付成功”。
//可放入HTML等美化页面的代码和订单交易完成后的数据库更新程序代码
//该页面可以使用PHP开发工具调试，也可以使用写文本函数log_result进行调试，该函数已被默认关闭，见alipay_notify.php中的函数return_verify
//TRADE_FINISHED(表示交易已经成功结束，为普通即时到帐的交易状态成功标识);
//TRADE_SUCCESS(表示交易已经成功结束，为高级即时到帐的交易状态成功标识);
///////////////////////////////////

require_once("class/alipay_notify.php");
require_once("alipay_config.php");
require_once("class/sendmail.class.php");

//构造通知函数信息
$alipay = new alipay_notify($partner,$key,$sign_type,$_input_charset,$transport);
//计算得出通知验证结果
$verify_result = $alipay->return_verify();

if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码

	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
    $dingdan           = $_GET['out_trade_no'];    //获取订单号
    $total_fee         = $_GET['total_fee'];	    //获取总价格

    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序


			//如果付款成功修改订单状态和付款状态
			require_once("../../../source/libs/adodb/adodb.inc.php");
			$db = NewADOConnection('mysql');
			//$db->debug=1;
				$db->Connect("localhost", "devuser","2:WeheWVUn,Kby3Y", "ftpdb");
			$db->query("SET CHARACTER SET utf8");
			$row = $db->getrow("SELECT * FROM sb_orderprodlist WHERE order_id = '".$_GET['out_trade_no']."' ");
			if(0==$row["status"]||1==$row["status"]||2==$row["status"]){$db->execute("UPDATE sb_orderprodlist SET status='3' WHERE order_id = '".$_GET['out_trade_no']."' ");}//定单状态改为预定成功
			if(1==$row["payflag"]){$db->execute("UPDATE sb_orderprodlist SET payflag='2' WHERE order_id = '".$_GET['out_trade_no']."' ");}//付款状态改为已付款
			$db->execute("UPDATE sb_vps_log SET status='1' WHERE oid = '".$row["id"]."' ");//更改主机状态
			$db->execute("UPDATE sb_domain_log SET status='1' WHERE oid = '".$row["id"]."' ");//更改域名状态
			$useremail = $db->getrow("SELECT * FROM sb_customers WHERE id = '".$row["uid"]."' ");
			sendmail($row["order_id"], $useremail["email"],$total_fee);
			//状态改变，电子票，是否需要发票需处理，如果发票，需要把订单状态改为status='4'（票已送出）
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的return_verify函数，比对sign和mysign的值是否相等，或者检查$veryfy_result有没有返回true
  //  echo "fail";
}

?>


<body>
    <div class="mod_kong id_mod_myorder mod_kong1">
        <table align="center" width="350" cellpadding="5" cellspacing="0">
            <tr>
                <td align="center" class="font_title" colspan="2">通知返回</td>
            </tr>
            <tr>
                <td class="font_content" align="right">支付宝交易号：</td>
                <td class="font_content" align="left"><?php echo $_GET['trade_no']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">订单号：</td>
                <td class="font_content" align="left"><?php echo $_GET['out_trade_no']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">付款总金额：</td>
                <td class="font_content" align="left"><?php echo $_GET['total_fee']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">商品标题：</td>
                <td class="font_content" align="left"><?php echo $_GET['subject']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">商品描述：</td>
                <td class="font_content" align="left"><?php echo $_GET['body']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">买家账号：</td>
                <td class="font_content" align="left"><?php echo $_GET['buyer_email']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">交易状态：</td>
                <td class="font_content" align="left"><?php echo $_GET['trade_status']; ?></td>
            </tr>
            <tr><td><input type="image" class="btn_a" src="/images/successful.png" onclick="location.href='/user/order.html'" /></td></tr>
        </table>
 </div>
</body>
</html>
