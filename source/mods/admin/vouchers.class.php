<?php
 	class vouchers extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPur->adminCheck("PW_TRIA","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mOrd->getVoucherTypeList();
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["send_type_name"] = $this->result["sendtype"][$r["logs"][$key]["send_type"]];
				}
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'vouchertypes';
	 			$this->mLog->adminLog("查看优惠券类型列表");
 			
 		}
 		
 		public function viewlist()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["log"] = $this->mOrd->getVoucherTypeRow($_GET["id"]);
 			$this->result["log"]["send_type_name"] = $this->result["sendtype"][$this->result["log"]["send_type"]];
 			if($this->mPur->adminCheck("PW_TRIA","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$r = $this->mOrd->getVoucherList($_GET["id"]);
			foreach ($r["logs"] as $key=>$val)
			{
				$r["logs"][$key]["send_type_name"] = $this->result["sendtype"][$r["logs"][$key]["send_type"]];
			}
				$this->result["logs"] = $r["logs"];
				$this->result["pages"] = $r["pages"];
 			$this->tplname = 'vouchers';
 			$this->mLog->adminLog("查看优惠券列表");
 		}
 		
 		public function del()
		{
			if($this->mPur->adminCheck("PW_TRIA","4")==false)
		 	{
		 		die("Permission denied");
		 	}
				if($this->mOrd->voucherDel($_POST["types"].$_POST["id"]) == false)
			 {
				$this->mLog->adminLog("删除优惠券类型失败"); 
			 	echo "error";
			 }
			 else
			 {
				$this->mLog->adminLog("删除优惠券类型成功"); 
			 	echo "succeed";
			 }
			die();
		}
 		
 		public function savePost()
		{
			$this->pageinfo();
			$rs = $this->mOrd->saveVoucherTypePost();
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/编辑优惠券类型成功"); 
			}
			else
			{
				$msg["status"] = "false";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/编辑优惠券类型失败"); 
			}
			echo json_encode($msg);
			die();
		}
 			
 		public function add()
 		{
			if($this->mPur->adminCheck("PW_TRIA","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPur->adminCheck("PW_TRIA","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			if($_GET["id"])$this->result["log"] = $this->mOrd->getVoucherTypeRow($_GET["id"]);
			$this->tplname = 'vouchers_add';
			$this->mLog->adminLog("添加/编辑优惠券类型"); 
 		}
 		
 		public function send()
 		{
			if($this->mPur->adminCheck("PW_TRIA","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPur->adminCheck("PW_TRIA","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($_POST)
			{
				print_r($_POST);
				die();
				$this->mOrd->sendVoucher(1,$_POST["id"]);
				sysMsg("操作成功","location.href='?m=".encrypt("vouchers")."';");
			}
			if($_GET["keyword"])
			{
				$this->result["userlist"] = $this->mClient->dropList($_GET["keyword"],"t");
			}
			$this->pageinfo();
			$this->result["cglist"] = $this->mClient->getGroupDropList("t");
			if($_GET["id"])$this->result["log"] = $this->mOrd->getVoucherTypeRow($_GET["id"]);
			$this->tplname = 'vouchers_send';
			$this->mLog->adminLog("派送优惠券"); 
 		}
 		
 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["sales"] = "selected";
 			$this->result["sites"]["title"] = "优惠券类型";
 			$this->result["sites"]["url"] = encrypt("vouchers");
 			$this->result["sendtype"] = array("0"=>"按用户发放","1"=>"按商品发放","2"=>"按订单金额发放","3"=>"线下发放");
 		}
 	}
?>