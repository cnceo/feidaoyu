<?php
/*	ini_set('error_reporting', E_ALL); //打开所有的错误级别
	ini_set('display_errors', 1); //显示错误*/

 	class order extends Controller
 	{
 		protected $tpl;

 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPurview->adminCheck("PW_CONTS","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				if($_GET["order_id"])$where[] = " order_id = '".$_GET["order_id"]."'";
				if($_GET["payflag"])$where[] = " payflag = '".$_GET["payflag"]."'";
				if($_GET["price"])$where[] = " totprice = '".$_GET["price"]."'";
				if($_GET["email"])
				{
					$r = $this->mCustomer->getUserByEmail($_GET["email"]);
					$where[] = " uid = '".$r["id"]."'";
				}
				$r = $this->mBasic->getList("orderprodlist",$where);
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["payflagname"] = $this->result["payflaglist"][$val["payflag"]];
					$r["logs"][$key]["email"] = $this->mCustomer->getEmailById($val["uid"]);
					$r["logs"][$key]["infolist"] = $this->mDb->getall("SELECT * FROM ".get_table("orderprod")." p ,".get_table("orderprodlist")." o ,".get_table("products")." pr WHERE p.oid=o.id AND p.pid = pr.id AND p.oid = '".$val["id"]."'");
            	    $r["logs"][$key]["infos"] = $this->mDb->getall("SELECT * FROM ".get_table("orderprod")." p ,".get_table("orderprodlist")." o  WHERE p.oid=o.id  AND p.oid = '".$val["id"]."'");
				}
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'order';
	 			$this->mLog->adminLog("查看订单列表");

 		}

 		public function detail()
 		{
 			$this->_globals();
 			$this->result["log"] = $this->getRow("orderprodlist", $_GET["orderno"]);
 				$rs = $this->mDb->getall("SELECT domain FROM ".get_table("domain_log")." WHERE oid='".$_GET["orderno"]."'");
				$r  = $this->mDb->getall("SELECT * FROM ".get_table("orderprod")." p ,".get_table("orderprodlist")." o ,".get_table("products")." pr WHERE p.oid=o.id AND p.pid = pr.id AND p.oid = '".$_GET["orderno"]."'");
 			$this->result["logdomain"] = $rs;
 			$this->result["logvps"] = $r;
 			$this->tplname = 'order_detail';
 		}

 		public function domain()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			if($_GET["order_id"])$where[] = " order_id = '".$_GET["order_id"]."'";
 			if($_GET["status"]||$_GET["status"]=='0')$where[] = " status = '".$_GET["status"]."'";
 			if($_GET["email"])
 			{
 				$r = $this->mCustomer->getUserByEmail($_GET["email"]);
 				$where[] = " uid = '".$r["id"]."'";
 			}
 			if($_GET["domain"])$where[] = " domain LIKE '%".str_replace(" ","%",$_GET["domain"])."%'";
 			$r = $this->mBasic->getlist("domain_log",$where);
            foreach ($r["logs"] as $key=>$val)
            {
            	$r["logs"][$key]["email"] = $this->mBasic->getName("customers",$val["uid"],"email");
            	$r["logs"][$key]["order_id"] = $this->mBasic->getName("orderprodlist",$val["oid"],"order_id");
            }
 			$this->result["logs"] = $r["logs"];
 			$this->result["pages"] = $r["pages"];
 			$this->tplname = 'order_domain';
 			$this->mLog->adminLog("查看域名列表");
 		}

 		public function domain_detail()
 		{
 			$this->_globals();
 			$this->result["log"] = $this->getRow("domain_log",$_GET["id"]);
 			$this->result["email"] = $this->mBasic->getName("customers",$this->result["log"]["uid"],"email");
 			$this->result["order_id"] = $this->mBasic->getName("orderprodlist",$this->result["log"]["oid"],"order_id");
 			$this->tplname = 'domain_detail';
 			$this->mLog->adminLog("查看域名详情");
 		}

 		public function savePost()
 			{
 				$this->_globals();
 				$rs = $this->mBasic->savePost("orderprodlist");
 				if($rs)
 				{
                    if($_POST["payflag"]=='2')
                    {
                    	$this->mDb->execute("UPDATE ".get_table("domain_log")." SET status = 1 WHERE oid='".$_POST["id"]."'");
                    	$this->mDb->execute("UPDATE ".get_table("vps_log")." SET status = 1 WHERE oid='".$_POST["id"]."'");
                    }
 					else{
 						$this->mDb->execute("UPDATE ".get_table("domain_log")." SET status = 0 WHERE oid='".$_POST["id"]."'");
 						$this->mDb->execute("UPDATE ".get_table("vps_log")." SET status = 0 WHERE oid='".$_POST["id"]."'");
 					}
 					$msg["status"] = "true";
 					$this->mLog->adminLog("修改订单状态成功");
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("修改订单状态失败");
 				}
 				echo json_encode($msg);
 				die();
 			}

 			public function savePost_domain()
 			{
 				$this->_globals();
 				$rs = $this->mBasic->savePost("domain_log");
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("修改域名状态成功");
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("修改域名状态失败");
 				}
 				echo json_encode($msg);
 				die();
 			}

 			public function vps()
 			{
 				$this->_globals();
 				include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 				if($_GET["order_id"])$where[] = " order_id = '".$_GET["order_id"]."'";
 				if($_GET["status"]||$_GET["status"]=='0')$where[] = " status = '".$_GET["status"]."'";
 				if($_GET["email"])
 				{
 					$r = $this->mCustomer->getUserByEmail($_GET["email"]);
 					$where[] = " uid = '".$r["id"]."'";
 				}
 				if($_GET["host"])
 				{
 					$pid =  $this->mDb->getall("SELECT * FROM ".get_table("products")." WHERE cprodname LIKE '%".str_replace(" ","%",$_GET["host"])."%' ");
 					foreach($pid as $val)
 					{
 						$id .= ",".$val["id"];
 					}
 					$pid= explode(",",$id);
 					$pid = array_filter($pid);
 					$pid= implode(",",$pid);
                    $where[]  = " pid in ($pid)";
 				}
 				$r = $this->mBasic->getlist("vps_log",$where);
 				foreach ($r["logs"] as $key=>$val)
 				{
 					$r["logs"][$key]["cprodname"] = $this->mBasic->getName("products",$val["pid"],"cprodname");
 					$r["logs"][$key]["email"] = $this->mBasic->getName("customers",$val["uid"],"email");
 					$r["logs"][$key]["order_id"] = $this->mBasic->getName("orderprodlist",$val["oid"],"order_id");
 				}
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
 				$this->tplname = 'order_vps';
 				$this->mLog->adminLog("查看主机列表");
 			}

 			public function vps_detail()
 			{
 				$this->_globals();
 				$this->result["log"] = $this->getRow("vps_log",$_GET["id"]);
 				$this->result["email"] = $this->mBasic->getName("customers",$this->result["log"]["uid"],"email");
 				$this->result["order_id"] = $this->mBasic->getName("orderprodlist",$this->result["log"]["oid"],"order_id");
 				$this->result["cprodname"] = $this->mBasic->getName("products",$this->result["log"]["pid"],"cprodname");
 				$this->tplname = 'vps_detail';
 				$this->mLog->adminLog("查看主机详情");
 			}

 			public function savePost_vps()
 			{
 				$this->_globals();
 				$rs = $this->mBasic->savePost("vps_log");
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("修改主机状态成功");
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("修改主机状态失败");
 				}
 				echo json_encode($msg);
 				die();
 			}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","Customer","Order"));
 			$this->result["sites"]["customer"] = "selected";
 			$this->result["sites"]["title"] = "订单";
 			$this->result["sites"]["url"] = encrypt("order");
 			$this->result["payflaglist"] = $this->mOrder->getPayflagList();
 			$this->result["domainstatus"] = array(
 					0=>"未付款",
 					1=>"已付款",
 					2=>"已注册",
 					3=>"注册失败"
 					);
 			$this->result["vpsstatus"] = array(
 					0=>"未付款",
 					1=>"已付款",
 					2=>"已开通"
 			);
 		}
 	}
?>