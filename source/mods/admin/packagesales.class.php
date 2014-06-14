<?php
 	class packagesales extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPur->adminCheck("PW_PRAG","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mProd->getProdutctPackagesList();
				foreach ($r["logs"] as $key=>$val)
				{
					if($val["customer_group_id"])
					{
						$r["logs"][$key]["customer_group"] = $this->mClient->getGroupName($val["customer_group_id"]);
					}
					else
					{
						$r["logs"][$key]["customer_group"] = "所有客户";
					}
				}
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'packagesales';
	 			$this->mLog->adminLog("查看打包销售列表");
 			
 		}
 		
 		public function del()
		{
			if($this->mPur->adminCheck("PW_PRAG","4")==false)
		 	{
		 		die("Permission denied");
		 	}
				if($this->mProd->DelPackagesSales($_POST["id"]) == false)
			 {
				$this->mLog->adminLog("删除打包销售失败"); 
			 	echo "error";
			 }
			 else
			 {
				$this->mLog->adminLog("删除打包销售成功"); 
			 	echo "succeed";
			 }
			die();
		}
 		
 		public function savePost()
		{
			$this->pageinfo();
			$rs = $this->mProd->savePackagesSales();
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/编辑打包销售成功"); 
			}
			else
			{
				$msg["status"] = "false";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/编辑打包销售失败");
			}
			echo json_encode($msg);
			die();
		}
 			
 		public function add()
 		{
			if($this->mPur->adminCheck("PW_PRAG","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPur->adminCheck("PW_PRAG","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			if($_GET["id"])$this->result["log"] = $this->mProd->getPackagesSale($_GET["id"]);
			$this->result["logs"] = $this->mProd->getPackagesSaleList($_GET["id"]);
			$this->result["grouplist"] = $this->mClient->getGroupDropList("t");
			$this->tplname = 'packagesale_add';
			$this->mLog->adminLog("添加/编辑打包销售");
 		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["sales"] = "selected";
 			$this->result["sites"]["title"] = "打包销售";
 			$this->result["sites"]["url"] = encrypt("packagesales");
 		}
 	}
?>