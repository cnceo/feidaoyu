<?php

 	class domain extends Controller
 	{
 		public function defshow()
 		{
			$this->_globals();
			include(_APP_PATH."libs/adodb/adodb-pager2.inc.php");
			$r = $this->mBasic->getList("domain_log",array(" uid = '".$_SESSION["login_user"]["id"]."'"," status in(1,2,3)"));
            foreach ($r["logs"] as $key=>$val)
            {
            	$r["logs"][$key]["order_id"] = $this->mBasic->getName("orderprodlist",$val["oid"],"order_id");
            }
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
			$this->result["sites"]["pagetitle"] = "域名管理";
		    $this->tplname = 'domain';
 		}

 		public function opendomain()
 		{
 			$this->_globals();
            $this->result["log"] = $this->getRow("domain_log",$_GET["did"]);
 			$rs = $this->mBasic->cateList("vps_log",null," uid = '".$_SESSION["login_user"]["id"]."' AND status = 2");
 			foreach ($rs as $key=>$val)
 			{
 				$rs[$key]["prodname"] = $this->mBasic->getName("products",$val["pid"],"cprodname");
 				$rs[$key]["oid"] = $this->mBasic->getName("orderprodlist",$val["oid"],"order_id");
 				$vpslist[$val["id"]] = $rs[$key]["prodname"].'-'.$rs[$key]["oid"];
 			}
 			$r = $this->mBasic->cateList("domain",null," uid = '".$_SESSION["login_user"]["id"]."' AND did = '".$this->result["log"]["id"]."'");
 			foreach ($r as $k=>$val1)
 			{
 			    $rs = $this->mBasic->getRow("vps_log",$val1["hostid"]);
 				$r[$k]["host"] = $this->mBasic->getName("products",$rs["pid"],"cprodname");
 				$r[$k]["order"] = $this->mBasic->getName("orderprodlist",$rs["oid"],"order_id");

 			}

 			$this->result["domainlist"] = $r;
 			$this->result["vpslist"] = $vpslist;
 			$this->tplname = 'opendomain';
 		}

 		public function savedomain()
 		{
 			$this->_globals();
 			if($_POST["wdomain"])
 			{
 			  $_POST["domain"] = $_POST["wdomain"].'.'.$_POST["domain"];
 			}
 			$sql = "SELECT * FROM sb_domain WHERE domain='".$_POST["domain"]."'";
 			$r = $this->mDb->getone($sql);
 			if($r)
 			{
 			$msg["status"] = "false2";
 			$msg["message"] = "该域名已经绑定";
 			echo json_encode($msg);
 			die();
 			}else{
 			$sql = "SELECT *  FROM ".get_table("vps_log")." WHERE id= '".$_POST["opendomain"]."'";
 			$log = $this->mDb->getrow($sql);
 			$hid = $_POST["hid"];
 			$_POST["did"] = $_POST["hid"];
 			unset($_POST["opendomain"]);
 			unset($_POST["hid"]);
 			$_POST["hostid"] = $log["id"];
 			$_POST["uid"] = $_SESSION["login_user"]["id"];
 			unset($_POST["wdomain"]);
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
 			echo json_encode($msg);
 			die();
 		}

 		public  function canceldomain()
 		{
 			$this->_globals();
 			$root = "/data/wwwroot/vhost/";
 			system("rm -f ".$root.$_POST["host"]);
 			$sql = "DELETE FROM ".get_table("domain")." WHERE domain='".$_POST["host"]."'";
	  		$rs = $this->mDb->execute($sql);
 			if($rs==false)
 			{
 				$msg["status"] = "false";
 			}else{
 				$msg["status"] = "true";
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