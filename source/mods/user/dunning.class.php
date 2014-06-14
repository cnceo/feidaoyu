<?php
 	class dunning extends Controller
 	{
 		protected $tpl;

 		public function defshow()
 		{
 			$this->_globals();
 			//include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->check_dunning("vps_log", date('Y-m-d',time()+3600*24*30),"1");
 			$this->check_dunning("vps_log", date('Y-m-d',time()+3600*24*15),"2");
 			$this->check_dunning("vps_log", date('Y-m-d',time()+3600*24*1),"3");
 			$this->check_dunning("sb_domain_log", date('Y-m-d',time()+3600*24*30),"1");
 			$this->check_dunning("sb_domain_log", date('Y-m-d',time()+3600*24*15),"2");
 			$this->check_dunning("sb_domain_log", date('Y-m-d',time()+3600*24*1),"3");
 		}

/*  		private function _globals()
 		{

 		} */

 		private function  check_dunning($bdname,$time,$status)
 		{
 			$sql="select * from ".get_table($bdname)." where etime >=now() and etime <='".$time."' and emailstatus<>".$status;
 			$rs = $this->mDb->getall($sql);
 			foreach ($rs as $key=>$value)
 			{
 				$r = $this->getRow("customers",$value["uid"]);
 				$rs[$key]["email"] = $r["email"];
 				if($value["emailstatus"]==$status-1)
 				{
	 				if($this->to_email($rs[$key]["email"],$status,$bdname))
	 				{
	 					$this->Update($bdname,$value["id"]," emailstatus =".$status);
	 				}
 				}
 			}
 		}

 		private function  to_email($email,$status,$bdname)
 		{
 			$time_str="";
 			if($status=="1")
 			{
 				$time_str="30";
 			}
 			else if($status=="2")
 			{
 				$time_str="15";
 			}else if($status=="3")
 			{
 				$time_str="1";
 			}
 			$type="";
 			if($bdname=="vps_log")
 			{
 				$type="虚拟主机";
 			}
 			else if($bdname=="sb_domain_log")
 			{
 				$type="域名";
 			}
 			include(_APP_PATH."libs/mail/class.phpmailer.php");
 			$mail = new PHPMailer();
 			//$link = "http://$_SERVER[SERVER_NAME]/user/register.html&a=checkemail&uid=".md5($uid)."&email=".md5($email);
 			//$url = "<a href='$link'/>$link</a>";

//  			$body = "尊敬的用户:<br/>&nbsp;&nbsp;&nbsp;&nbsp;您在飞刀鱼（$_SERVER[SERVER_NAME]）".$type."，还有".$time_str."天到期。您可以点击以下链接进行续费：<br/>\r\n";
//  			//$body .= "&nbsp;&nbsp;&nbsp;&nbsp;".$url."<br/>&nbsp;&nbsp;&nbsp;&nbsp;如果此处链接不能点击，请您复制以上地址，在浏览器里手动打开即可完成验证！\r\n";
//  			$body .= "祝您工作学习愉快！<p align='right'>飞刀鱼".date("Y-m-d")."<br>
// 				          <a herf='http://www.feidaoyu.com' target='_blank'><img src='http://www.feidaoyu.com/images/fdylogo.gif'><a/></p>";
 			$body = "尊敬的用户".$email.":<br>
 			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您在飞刀鱼（$_SERVER[SERVER_NAME]）".$type."，还有".$time_str."天到期。";//"您可以点击以下链接进行续费：<br/>&nbsp;&nbsp;&nbsp;&nbsp;";
 			$body .= "祝您工作学习愉快！<p align='right'>飞刀鱼".date("Y-m-d")."<br><a herf='http://www.feidaoyu.com' target='_blank'><img src='http://www.feidaoyu.com/images/fdylogo.gif'><a/></p>";
 			$mail->IsSMTP(); // telling the class to use SMTP
 			$orgname = iconv( "utf-8", "gb2312", "飞刀鱼" );
 			$mail->SMTPAuth   = true;                  // enable SMTP authentication
 			$mail->CharSet = "GB2312";
 			$mail->Host       = "smtp.exmail.qq.com"; // sets the SMTP servertu
 			$mail->Port       = "25";                    // set the SMTP port for the GMAIL server
 			$mail->Username   = "support@sittc.com.cn"; // SMTP account username
 			$mail->Password   = "seabig8080";        // SMTP account password
 			$mail->SetFrom("support@sittc.com.cn","$orgname");
 			$mail->AddReplyTo($email,"$orgname");
 			$mail->Subject = iconv( "utf-8", "gb2312", "续费邮件通知" );
 			$mail->AddAddress($email, "");
 			$body = iconv( "utf-8", "gb2312", $body );
 			$mail->MsgHTML($body);
 			if($mail->Send())
 			{
 				return true;
 			}else
 			{
 				return false;
 			}
 		}
 	}
?>