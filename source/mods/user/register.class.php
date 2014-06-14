<?php
    /**
     * 用户注册
     *
     */
 	class register extends Controller
 	{
 		public function defshow()
 		{
 			$this->_globals();
 			$this->tplname = "register";
 			$this->result["sites"]["pagetitle"] = "注册会员";
 		}

 		/**
 		 * 发送邮箱验证
 		 */
 		public function savePost()
 		{
 			$this->_globals();
 			$_POST["mdemail"] = md5($_POST["email"]);
 			if($_POST["email"])
 			{
 				include(_APP_PATH."libs/mail/class.phpmailer.php");
 				$email = $_POST["email"];
 				$uid= $this->mDb->Insert_ID();
 			    $mail = new PHPMailer();
 			    $link = "http://$_SERVER[SERVER_NAME]/user/register.html&a=checkemail&uid=".md5($uid)."&email=".md5($email);
 			    $url = "<a href='$link' target='_blank'/>$link</a>";
 			    $body = "尊敬的".$_POST["email"].":<br>
 			    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 您在飞刀鱼（$_SERVER[SERVER_NAME]）注册了账号，故系统自动为您发送了这封邮件。您可以点击以下链接进行邮箱验证：<br/>&nbsp;&nbsp;&nbsp;&nbsp;";
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
 			    $mail->Subject = iconv( "utf-8", "gb2312", "飞刀鱼会员注册验证" );
 			    $body = iconv( "utf-8", "gb2312", $body );
 			    $mail->MsgHTML($body);
 			    $address = "no-replay@feidaoyu.com";
 			    $mail->AddAddress($email, "");
 			    $mail->IsHTML(true); // 是否以HTML形式发送，如果不是，请删除此行
 				if($mail->Send()){
 					unset($_POST["ok"]);
 					$_POST["username"] = strtolower($_POST["username"]);
 					$rs = $this->mCustomer->savePost();
 					$msg["status"] = "true";
 					$msg["message"] = "注册成功,请查看邮箱验证";
 				}else{
 					$msg["status"] = "false";
 					$msg["message"] = "注册失败,请重新注册";
 				}
 			}
 			else
 			{
 				$msg["status"] = "false";
 				$msg["message"] = "保存错误，请联系管理员";

 			}
 			echo json_encode($msg);
 			die();
 		}

        //检查邮件用户名
 		public function check()
 		{
 			$this->_globals();
 			if($_GET["email"])$msg = $this->mCustomer->checkField("email",$_GET["email"]);
 			if($msg=="")echo "1";
 			die();
 		}

 		//邮箱验证
 		public function checkemail()
 		{
 			header('Content-Type:text/html; charset=utf-8');
 			$this->_globals();
 			if($_GET["email"])
 			{
 				$email = $_GET["email"];
 				$sql = "UPDATE ".get_table('customers')." SET status = 1 WHERE mdemail = '$email'";
 				$rs = $this->mDb->execute($sql);
 				if($rs)
 				{
 					echo "<script>alert('您的邮箱已成功验证');location.href='/user/login.html';</script>";
 				}else{
 					echo "<script>alert('您的邮箱验证失败');</script>";
 				}
 			}
 		}




 	    private function _globals()
 		{
 			$this->loadModel(array("Customer","Category","Article","Site"));
 		}
 	}
?>