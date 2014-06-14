<?php

 	class order extends Controller
 	{
 		public function defshow()
 		{
			$this->_globals();
			include(_APP_PATH."libs/adodb/adodb-pager2.inc.php");
			$r = $this->mBasic->getList("orderprodlist",array("uid = '".$_SESSION["login_user"]["id"]."'"," payflag != 2 "));
			$payflag = $this->mOrder->getPayflagList();
            foreach ($r["logs"] as $key=>$val)
            {
            	$r["logs"][$key]["payflagname"] = $payflag[$val["payflag"]];
            	$r["logs"][$key]["infolist"] = $this->mDb->getall("SELECT * FROM ".get_table("orderprod")." p ,".get_table("orderprodlist")." o ,".get_table("products")." pr WHERE p.oid=o.id AND p.pid = pr.id AND p.oid = '".$val["id"]."'");
            	$r["logs"][$key]["infos"] = $this->mDb->getall("SELECT * FROM ".get_table("orderprod")." p ,".get_table("orderprodlist")." o  WHERE p.oid=o.id  AND p.oid = '".$val["id"]."'");

            }
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
			$this->result["sites"]["pagetitle"] = "订单中心";
		    $this->tplname = 'orderlist';
 		}
/**
 * 预订/保存订单
 */
 		public function book()
 		{
 		    $this->_globals();
 			$_POST["order_id"] = strtoupper("f".date("Ymd").random(4));
 			$_POST["uid"] = $_SESSION["login_user"]["id"];
 			unset($_POST["year"]);
 			$rs = $this->mBasic->savePost("orderprodlist");
 			$oid = $this->mDb->Insert_ID();
 			$order_id = $_POST["order_id"];
 			if($rs)
 			{
 				unset($_POST);
 				$shopcart = $_SESSION["shopcart"];
 				foreach($shopcart as $val){
 					$_POST["oid"] = $oid;
 					$_POST["pid"] = $val["id"];
 					$_POST["year"] = $val["year"];
 					$_POST["price"] = $val["tprice"];
 					$_POST["domain"] = $val["domain"];
 					$this->mBasic->savePost("orderprod");
 					if($val["ptype"] == "vps")
 					{
 						 unset($_POST["price"]);
 						$_POST["uid"] = $_SESSION["login_user"]["id"];
 						$this->mBasic->savePost("vps_log");
 						unset($_POST["uid"]);
 					}else{
 						unset($_POST["price"]);
 						unset($_POST["pid"]);
 						$_POST["uid"] = $_SESSION["login_user"]["id"];
 						$this->mBasic->savePost("domain_log");
 						unset($_POST["uid"]);
 					}

 				}
 				$email = $this->mCustomer->getEmailById($_SESSION["login_user"]["id"]);
 				include(_APP_PATH."libs/mail/class.phpmailer.php");
 				$mail = new PHPMailer();
 				$body = "尊敬的用户".$email.":<br>
 				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您在飞刀鱼（$_SERVER[SERVER_NAME]）有待支付的订单，订单号为".$order_id."，为确保你正常使用产品，请尽快支付，谢谢。<br/>&nbsp;&nbsp;&nbsp;&nbsp;";
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
 				$mail->Subject = iconv( "utf-8", "gb2312", "飞刀鱼订单中心提醒" );
 				$body = iconv( "utf-8", "gb2312", $body );
 				$mail->MsgHTML($body);
 				$address = "no-replay@feidaoyu.com";
 				$mail->AddAddress($email, "");
 				$mail->IsHTML(true); // 是否以HTML形式发送，如果不是，请删除此行
 				if($mail->Send())
 				{
 					$msg["status"] = "true";
 					$msg["message"] = "预订成功";
 					$msg["order_id"] = $order_id;
 					$smail = new PHPMailer();
 					$orgname = iconv( "utf-8", "gb2312", "飞刀鱼" );
 					$smail->SMTPAuth   = true;                  // enable SMTP authentication
 					$smail->CharSet = "GB2312";
 					$smail->Host       = $this->result["sites"]["smtphost"]; // sets the SMTP servertu
 				    $smail->Port       = $this->result["sites"]["smtpport"];                    // set the SMTP port for the GMAIL server
 				    $smail->Username   = $this->result["sites"]["smtpuser"]; // SMTP account username
 				    $smail->Password   = $this->result["sites"]["smtppasswd"];        // SMTP account password
 					$smail->SetFrom($this->result["sites"]["sendemail"],"$orgname");
 					$smail->Subject = iconv( "utf-8", "gb2312", "飞刀鱼订单中心:".$email);
 					$smail->AddAddress("vince@seabig.cn", "");
 					$sbody = "邮箱：".$email."<br>
				                                 订单号：".$order_id."<br>";
 					foreach ($_SESSION["shopcart"] as $key=>$val)
 					{

 						if($val["domain"])$sbody .= "域名：".$val["domain"]."<br>";
				        if($val["id"]){
				        	$cprodname = $this->mBasic->getName("products",$val["id"],"cprodname");
				        	$sbody .= "主机：".$cprodname."<br>";
				        }
 					}
 					$sbody = iconv( "utf-8", "gb2312", $sbody);
 					$smail->MsgHTML($sbody);
 					$smail->Send();
 					unset($_SESSION["shopcart"]);
 				}else{
 					$msg["status"] = "false";
 					$msg["message"] = "邮件发送失败";
 				}
 			}else {
 				$msg["status"] = "false";
 				$msg["message"] = "保存错误，请重试";
 			}
 		    echo json_encode($msg);
 		    die();
 		}
/**
 * 确认订单
 */
 		public function confirm_order()
 		{
 			$this->_globals();
 			$r["logs"]= $_SESSION["shopcart"];
 			foreach ($r["logs"] as $key=>$val)
 			{
 				$totalprice += $val["tprice"];
 				$r["logs"][$key]["classname"] = $this->mBasic->getName("categorys",$val["class_id"],"ename");
 			}
 			$this->result["totalprice"] = $totalprice;
 			$this->result["shopcart"] = $r["logs"];
 			$this->result["sites"]["pagetitle"] = "确认订单--".$this->result["sites"]["sitename"];
 			$this->tplname = 'confirmorder';
 		}
/**
 * 订单详情
 */
 		public function orderinfo()
 		{
 			$this->_globals();
 			$r = $this->mOrder->getOrderinfo($_GET["order_id"]);
            $rs = $this->mBasic->getNavList("orderprod"," oid = '".$r["id"]."'",100);
            $payflag = $this->mOrder->getPayflagList();
            foreach ($rs as $key=>$val)
            {
            	$rs[$key] = $this->getRow("products", $val["pid"]);
            	$rs[$key]["hprice"] = $val["price"];
            	$rs[$key]["vyear"] = $val["year"];
            	$rs[$key]["domain"] = $val["domain"];
            }
            $this->result["log"] = $r;
			$this->result["logs"] = $rs;
 			$this->result["sites"]["pagetitle"] = "订单中心--".$this->result["sites"]["sitename"];
 			$this->tplname = 'orderinfo';
 		}

 		private function _globals()
 		{
 			$this->checkUserLogin();
 			$this->loadModel(array("Basic","Customer","Order"));
 			$this->result["yearlist"] = array(
 					1 => "1年",
 					3 => "3年",
 					5 => "5年"
 			);
 			$this->result["sites"]["home"] = 'on';
 		}
 	}
?>