<?php

 	class vps extends Controller
 	{
 		public function defshow()
 		{
			$this->_globals();
			include(_APP_PATH."libs/adodb/adodb-pager2.inc.php");
			$r = $this->mBasic->getList("vps_log",array(" uid = '".$_SESSION["login_user"]["id"]."'"," status != 0"));
            foreach ($r["logs"] as $key=>$val)
            {
            	$r["logs"][$key]["cprodname"] = $this->mBasic->getName("products",$val["pid"],"cprodname");
            	$r["logs"][$key]["order_id"] = $this->mBasic->getName("orderprodlist",$val["oid"],"order_id");
            	$r["logs"][$key]["sdomain"] = $this->mBasic->cateList("domain",null," uid = '".$_SESSION["login_user"]["id"]."' AND hostid = '".$val["id"]."'");
            	$r["logs"][$key]["mid"] = md5($val["id"]);
            }
           // print_r($r["logs"]);
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
			$this->result["sites"]["pagetitle"] = "主机管理";
		    $this->tplname = 'vps';
 		}

 		public function open()
 		{
 			$this->_globals();
             $this->result["doamin"] = random(5);
 			$this->tplname = 'openvps';
	     }

          /**
           * 检查域名存在
           */
	     public function check()
	     {
	     	$this->_globals();
	     	if($_GET["domain"] == "www" || $_GET["domain"] == "db"){
	     		echo "0";
	     	}else{
	     		$msg = $this->mBasic->checkField("vps_log","domain",$_GET["domain"].".feidaoyu.com");
	     	   if($msg==""){
	     	   	echo "1";
	     	   }else{
	     	   	echo "0";
	     	   }
	     	}
	     	die();
	     }


	     public  function binding()
	     {
	     	$this->_globals();
	     	if($_POST["domain"]=="")
	     	{
	     		$msg["status"] = "false1";
	     		$msg["message"] = "请填写域名";
	     		echo json_encode($msg);
	     		die();
	     	}else{
	     		$sql = "SELECT * FROM sb_domain WHERE domain='".$_POST["domain"]."'";
	     		$r = $this->mDb->getone($sql);
	     		if($r)
	     		{
	     			$msg["status"] = "false2";
	     			$msg["message"] = "该域名已经绑定";
	     			echo json_encode($msg);
	     			die();
	     		}else
	     		{
	     	$sql = "SELECT *  FROM ".get_table("vps_log")." WHERE md5(id)= '".$_POST["host"]."'";
	     	$log = $this->mDb->getrow($sql);
	     	unset($_POST["host"]);
	     	$_POST["hostid"] = $log["id"];
	     	$_POST["uid"] = $_SESSION["login_user"]["id"];
	        $rs = $this->mBasic->savePost("domain");
             if($rs)
             {
             	$root = "/data/wwwroot/vhost/";
                system("ln -s ".$root.$log["domain"]."/  ".$root.$_POST["domain"]);
                $msg["status"] = "true";
             }else{
             	$msg["status"] = "false";
             }
	     		}
	     	}
             echo json_encode($msg);
             die();
	     }

	     public  function cancel()
	     {
	     	$this->_globals();
	     	$sql = "SELECT *  FROM ".get_table("domain")." WHERE id= '".$_POST["host"]."'";
	     	$log = $this->mDb->getrow($sql);
            $root = "/data/wwwroot/vhost/";
            system("rm -f ".$root.$log["domain"]);
	     	if($this->Del("domain",$_POST["host"])==false)
	     	{
	     		$msg["status"] = "false";
	     	}else{
	     		$msg["status"] = "true";
	     	}
	     	echo json_encode($msg);
	     	die();
	     }

	     public function checkdomain()
	     {
	     	$this->_globals();
	     		$msg = $this->mBasic->checkField("sb_domain","domain",$_GET["domains"]);
	     		if($msg==""){
	     			echo "1";
	     		}else{
	     			echo "0";
	     		}
	     	die();
	     }

	     /**
	      * 链接api创建ftp
	      */
	     public function building()
	     {
	     	$this->_globals();
	     	$this->checkUserLogin();
	     	$rs = $this->getRow("vps_log", $_POST["id"]);
	     	$url = "http://www.feidaoyu.com/api/vps.php";
	     	$data = array("domain" =>trim($_POST["domain"]),
	     			"year"=>$rs["year"],
	     			 "vpsid"=>$_POST["id"]);
	     	$post_data = array ("data" => serialize($data));
	     	$ch = curl_init();
	     	curl_setopt($ch, CURLOPT_URL, $url);
	     	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	     	curl_setopt($ch, CURLOPT_POST, 1);
	     	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	     	$output = curl_exec($ch);
	     	curl_close($ch);
	     	$output = unserialize($output);
	     	if($output)
	     	{
	     		$this->Update("vps_log", $_POST["id"], " stime = '".$output["start"]."',etime = '".$output["end"]."',domain = '".$output["domain"]."',status = '2',ftpuser = '".$output["user"]."',ftppwd = '".$output["password"]."',dbhost = '".$output["dbhost"]."',dbname = '".$output["dbname"]."',dbuser = '".$output["dbuser"]."',dbpasswd = '".$output["dbpasswd"]."',phpmyadmin = '".$output["phpmyadmin"]."'");
	     		$email = $this->mCustomer->getEmailById($rs["uid"]);
	     		$info = $this->mDb->getrow("SELECT * FROM ".get_table("orderprod")." p ,".get_table("orderprodlist")." o ,".get_table("products")." pr WHERE p.oid=o.id AND p.pid = pr.id AND p.oid = '".$rs["oid"]."'");
	     		$this->sendmail($email,$output["domain"],$info["order_id"],$output["start"],$output["end"],$info["cprodname"],$output["user"],$output["password"],$output["dbhost"],$output["dbname"],$output["dbuser"],$output["dbpasswd"],$output["phpmyadmin"]);
	     		$msg["status"] = "true";
	     		$msg["message"] = "开通成功";
	     	}else{
	     		$msg["status"] = "false";
	     		$msg["message"] = "开通失败";
	     	}
	     	echo json_encode($msg);
 		    die();
	      }

	      /**
	       * 发送邮件通知ftp开通
	       */
         public function sendmail($email,$domain,$order_id,$stime,$etime,$cprodname,$ftpuser,$pwd,$dbhost,$dbname,$dbuser,$dbpasswd,$phpmyadmin,$type='open')
         {
         	include(_APP_PATH."libs/mail/class.phpmailer.php");
         	$mail = new PHPMailer();
         	if($type=='open'){
         		$body = "尊敬的用户".$email.":<br>
         		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 您在飞刀鱼（$_SERVER[SERVER_NAME]）有新开通了主机，订单号为".$order_id."<br>产品名称".$cprodname."<br>临时绑定的域名为".$domain."<br>FTP地址:".$domain."<br>数据库地址:".$domain."<br>数据库访问地址:".$phpmyadmin."<br>数据库名称:".$dbname."<br>数据库用户名:".$dbuser."<br>数据库密码:".$dbpasswd."<br>主机的开始日期：".$stime."<br>到期日：".$etime."<br>ftp账户：".$ftpuser."<br>密码：".$pwd."<br>
         			请妥善保管号你的密码，谢谢。<br>";
         		$mail->Subject = iconv( "utf-8", "gb2312", "飞刀鱼主机开通通知" );
         	}
         	else {
         		$body = "尊敬的用户".$email.",您在飞刀鱼（$_SERVER[SERVER_NAME]）修改了主机密码，主机账号".$ftpuser."，新密码为".$pwd.",请妥善保管号你的密码，谢谢。<br/>\r\n";
         		$mail->Subject = iconv( "utf-8", "gb2312", "飞刀鱼主机修改密码通知" );
         	}
          $body .= "祝您工作学习愉快！<p align='right'>飞刀鱼".date("Y-m-d")."<br>
				          <a herf='http://www.feidaoyu.com' target='_blank'><img src='http://www.feidaoyu.com/images/fdylogo.gif'><a/></p>";
            $orgname = iconv( "utf-8", "gb2312", "飞刀鱼" );
         	$mail->IsSMTP();
         	$mail->SMTPAuth   = true;                  // enable SMTP authentication
         	$mail->Host       = $this->result["sites"]["smtphost"]; // sets the SMTP servertu
         	$mail->Port       = $this->result["sites"]["smtpport"];                    // set the SMTP port for the GMAIL server
         	$mail->Username   = $this->result["sites"]["smtpuser"]; // SMTP account username
         	$mail->Password   = $this->result["sites"]["smtppasswd"];        // SMTP account password
         	$mail->SetFrom($this->result["sites"]["sendemail"],$orgname);
         	$mail->AddReplyTo($email,"$orgname");
/*          	if($type=='open')
         	{
         		$mail->Subject    = "飞刀鱼主机开通通知";
         	}else{
         		$mail->Subject    = "飞刀鱼主机修改密码通知";
         	} */
         	$body = iconv( "utf-8", "gb2312", $body );
         	$mail->MsgHTML($body);
         	$address = "no-replay@feidaoyu.com";
         	$mail->AddAddress($email, "");
         	$mail->IsHTML(true); // 是否以HTML形式发送，如果不是，请删除此行
         	$mail->Send();
         }

         /**
          * 修改主机密码
          */
         public function updatevpspwd()
         {
         	$this->_globals();
         	$this->result["log"] = $this->getRow("vps_log", $_GET["vpsid"]);
         	$this->result["sites"]["pagetitle"] = "主机修改密码--".$this->result["sites"]["sitename"];
         	$this->tplname = 'updatevpspwd';
	      }
          /**
           * 保存修改主机密码
           */
	      public function updatepwd()
	      {
	      	$this->_globals();
	      	$sql = "UPDATE ftpuser SET passwd = '".$_POST["passwd"]."' WHERE vpsid='".$_POST["vpsid"]."'";
	 		$rs = $this->mDb->execute($sql);
	      	if($rs)
	      	{
	      		$this->Update("vps_log", $_POST["vpsid"], " ftppwd='".$_POST["passwd"]."'");
	      		$email = $this->mCustomer->getEmailById($_POST["uid"]);
	      		$this->sendmail($email, '', '', '', '', '', $_POST["ftpuser"], $_POST["passwd"],'update');
		      	$msg["status"] = "true";
		      	$msg["message"] = "修改成功";
	      	}else {
	      		$msg["status"] = "false";
	      		$msg["message"] = "修改失败";
	      	}
	      	echo json_encode($msg);
	      	die();
	      }

 		private function _globals()
 		{
 			$this->checkUserLogin();
 			$this->loadModel(array("Basic","Customer"));
 			$this->result["sites"]["home"] = 'on';
 		}
 	}
?>