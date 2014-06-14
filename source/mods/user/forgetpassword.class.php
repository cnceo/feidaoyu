<?php

 	class forgetpassword extends Controller
 	{
 		public function defshow()
 		{
 			$this->_globals();
 			$this->tplname = "forgetpassword";
 			$this->result["sites"]["pagetitle"] = "忘记密码";
 		}

 		/**
 		 * 发送邮箱验证
 		 */
 		public function sendemail()
 		{
 			$this->_globals();
			include(_APP_PATH."libs/mail/class.phpmailer.php");
			$email = $_POST["email"];
			$mail = new PHPMailer();
			$link = "http://$_SERVER[SERVER_NAME]/user/login.html&a=repwd&email=".md5($email);
			$url = "<a href='$link' target='_blank'/>$link</a>";
			$body = "尊敬的".$email.":<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您在飞刀鱼（".$_SERVER["SERVER_NAME"]."）找回密码，故系统自动为您发送了这封邮件。您可以点击以下链接进行找回密码：<br/>&nbsp;&nbsp;&nbsp;&nbsp;";
			$body .= $url."<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如果此处链接不能点击，请您复制以上地址，在浏览器里手动打开即可完成验证！<br>";
			$body .= "祝您工作学习愉快！<p align='right'>飞刀鱼".date("Y-m-d")."<br>
				          <a herf='http://www.feidaoyu.com' target='_blank'><img src='http://www.feidaoyu.com/images/fdylogo.gif'><a/></p>";
			$orgname = iconv( "utf-8", "gb2312", "飞刀鱼" );
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->CharSet = "GB2312";
			$mail->Host       = $this->result["sites"]["smtphost"]; // sets the SMTP servertu
			$mail->Port       = $this->result["sites"]["smtpport"];                    // set the SMTP port for the GMAIL server
			$mail->Username   = $this->result["sites"]["smtpuser"]; // SMTP account username
			$mail->Password   = $this->result["sites"]["smtppasswd"];        // SMTP account password
			$mail->SetFrom($this->result["sites"]["sendemail"],$orgname);
			$mail->AddReplyTo($email,"$orgname");
			$mail->Subject = iconv( "utf-8", "gb2312", "飞刀鱼会员找回密码" );
			$body = iconv( "utf-8", "gb2312", $body );
			$mail->MsgHTML($body);
			$address = "no-replay@feidaoyu.com";
			$mail->AddAddress($email, "");
			$mail->IsHTML(true); // 是否以HTML形式发送，如果不是，请删除此行
			if($mail->Send())
			{
				$msg["status"] = "true";
				$msg["message"] = "已经发送找回密码邮件,请查看邮箱验证";
			}
			else
			{
				$msg["status"] = "false";
				$msg["message"] = "发送邮件失败,请重试";
			}
 			echo json_encode($msg);
 			die();
 		}

 		//检查邮件用户名
 		public function check()
 		{
 			$this->_globals();
 			if($_GET["email"])$msg = $this->mCustomer->checkField("email",$_GET["email"]);
 			if($msg)echo "1";
 			die();
 		}

 		public function savepost()
 		{
 			$this->_globals();
 			$password = md5($_POST["password"]);
 			$sql="UPDATE ".get_table("customers")." SET password = '$password' WHERE id= '".$_POST["id"]."'";
 			$rs = $this->mDb->execute($sql);
 			if($rs)
 			{
 				$msg["status"] = "true";
 				$msg["message"] = "密码重设成功，请重新登录";

 			}else
 			{
 				$msg["status"] = "false";
 				$msg["message"] = "密码重设失败，请稍后重试";
 			}
 			echo json_encode($msg);
 			die();
 		}

 	    private function _globals()
 		{
 			$this->loadModel(array("Customer"));
 		}
 	}
?>