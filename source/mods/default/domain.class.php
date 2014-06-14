<?php
 	class domain extends Controller
 	{
 		public function defshow()
 		{
			$this->_globals();
			$this->result["sites"]["pagetitle"] = "域名注册，全球最低价";

		     $this->tplname = 'domain';

 		}

 		public function selectdomain()
 		{
 			header('Content-Type:text/html; charset=gbk');
 			$this->_globals();
 			$otime = date("YmdHis");
 			$pwd="123456";
 			$_POST["domain"] = strtolower($_POST["domain"]);
            foreach($_POST["domains"] as $key=>$val)
            {
            	$domain[$key] = trim($_POST["domain"]).'.'.$val["0"];
            	$chksum = md5(calvin.$domain[$key].$otime.md5($pwd));
            	$url = "http://api.4y.cn/api/regapi.asp?act=check&username=calvin&otime=$otime&chksum=$chksum&domainname=$domain[$key]";
   /*          	$data = array("act" =>"check",
            			"username"=>"calvin",
            			"otime"=>$otime,
            			"chksum"=>md5(calvin&$domain&$otime&md5(123456)),
            			"domainname"=>$domain); */
            	$ch = curl_init();
            	curl_setopt($ch, CURLOPT_URL, $url);
            	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            	curl_setopt($ch,CURLOPT_GET,1);
            //	curl_setopt($ch, CURLOPT_POST, 1);
            //	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            	$output = curl_exec($ch);
            	curl_close($ch);
            	$output = explode("\n",$output);
            	if(strpos($output["1"],'N'))
            	{
            		$status = '0';
            	}else{
            		$status = '1';
            	}
            	$sdomain[$key]["domain"] = $domain[$key];
            	$sdomain[$key]["status"] = $status;
            	$sdomain[$key]["price"] = $this->result["doaminprice"][$val["0"]];
            }
            $_SESSION["domain"] = $sdomain;
            if($sdomain)
            {
            	$msg["status"] = "true";
            	//$msg["sdomain"] = $sdomain;
            }
            echo json_encode($msg);
 			die();

 		}

 		public function domains()
 		{
 			$this->_globals();
            $this->result["domains"] = $_SESSION["domain"];
            foreach($this->result["domains"] as $key=>$val)
            {
            	 $this->result["domains"][$key]["statusname"] = $this->result["selectstatus"][$val["status"]];
            }
 			$this->tplname = 'domains';
 		}

 		private function _globals()
 		{
 			$this->loadModel(array());
 			$this->result["sites"]["domain"] = 'on';
 			$this->result["selectstatus"] = array(0 => "已经注册",
 					              1 => "可以注册");
 			$this->result["doaminlist"] = array(
 					com => ".com",
 					net => ".net",
 					org => ".org",
 					mobi => ".mobi",
 					bz => ".bz",
 					la => ".la",
 					dotws => ".ws",
 					tv => ".tv",
 					biz => ".biz",
 					dominfo => ".info",
 					info => ".uk",
 					name => ".name",
 					eu => ".eu",
 					in => ".in",
 					cd => ".cd",
 					ph => ".ph",
 					tw => ".tw",
 					us => ".us",
 					hk => ".hk",
 					sh => ".sh",
 					ac => ".ac",
 					io => ".io",
 					cc => ".cc",
 					biz => ".biz",
 					ca => ".ca"
 					);
 			$this->result["doaminprice"] = array(
 					com => "69",
 					net => "69",
 					org => "139",
 					mobi => "180",
 					bz => "250",
 					la => "440",
 					dotws => "85",
 					tv => "500",
 					biz => "240",
 					dominfo => "80",
 					info => "85",
 					name => "65",
 					eu => "95",
 					in => "130",
 					cd => "380",
 					ph => "400",
 					tw => "266",
 					us => "85",
 					hk => "360",
 					sh => "380",
 					ac => "380",
 					io => "380",
 					cc => "400",
 					biz => "220",
 					ca => "140"
 			);
 		}
 	}
?>