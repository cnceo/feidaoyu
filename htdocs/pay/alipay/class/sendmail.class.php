<?php
function sendmail($orderid,$email,$total) {

	include("../../../source/libs/mail/class.phpmailer.php");
	$mail = new PHPMailer();
	$link = "http://$_SERVER[SERVER_NAME]/user/order.html";
	$url = "<a href='$link'/>$link</a>";
	$body = "尊敬的".$email."用户:<br/>&nbsp;&nbsp;&nbsp;&nbsp;您在飞刀鱼（$_SERVER[SERVER_NAME]）的".$orderid." 订单付款成功，金额为".$total."，故系统自动为您发送了这封邮件。<br/>\r\n";
	$body .= "&nbsp;&nbsp;&nbsp;&nbsp;查看更多详情请点击:".$url."<br/>&nbsp;&nbsp;&nbsp;&nbsp;如果此处链接不能点击，请您复制以上地址，在浏览器里手动打开即可！\r\n";
	$body .= "<br/><p align='right'>飞刀鱼" . date("Y-m-d")
			. "<br/><a herf='http://www.feidaoyu.com' target='_blank'><img src='http://www.feidaoyu.com/images/fdylogo.gif'><a/></p>";
	$mail->IsSMTP(); // telling the class to use SMTP
	$orgname = iconv("utf-8", "gb2312", "飞刀鱼");
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->CharSet = "GB2312";
	$mail->Host = "smtp.exmail.qq.com"; // sets the SMTP servertu
	$mail->Port = "25"; // set the SMTP port for the GMAIL server
	$mail->Username = "support@feidaoyu.com"; // SMTP account username
	$mail->Password = "seabig8080"; // SMTP account password
	$mail->SetFrom("support@feidaoyu.com", "$orgname");
	$mail->AddReplyTo($email, "$orgname");
	$mail->Subject = iconv("utf-8", "gb2312", $orderid."付款成功通知");
	$mail->AddAddress($email, "");
	$mail->AddBCC("vince@seabig.cn","");
	$body = iconv("utf-8", "gb2312", $body);
	$mail->MsgHTML($body);
	$mail->Send();
}
?>