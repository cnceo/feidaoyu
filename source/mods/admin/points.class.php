<?php
 	class points extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPur->adminCheck("PW_PIONT","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mProd->getProdutctSaleList(5);
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
	 			$this->tplname = 'points';
	 			$this->mLog->adminLog("查看积分换购列表");
 			
 		}
 		
 		public function del()
		{
			if($this->mPur->adminCheck("PW_PIONT","4")==false)
		 	{
		 		die("Permission denied");
		 	}
				if($this->mProd->DelProductSales($_POST["id"]) == false)
			 {
				$this->mLog->adminLog("删除积分换购失败"); 
			 	echo "error";
			 }
			 else
			 {
				$this->mLog->adminLog("删除积分换购成功"); 
			 	echo "succeed";
			 }
			die();
		}
 		
 		public function savePost()
		{
			$this->pageinfo();
			$rs = $this->mProd->saveProductSales(5);
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/编辑积分换购成功"); 
			}
			else
			{
				$msg["status"] = "false";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/编辑积分换购失败");
			}
			echo json_encode($msg);
			die();
		}
 			
 		public function add()
 		{
			if($this->mPur->adminCheck("PW_PIONT","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPur->adminCheck("PW_PIONT","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			if($_GET["id"])$this->result["log"] = $this->mProd->getProductSaleRow($_GET["id"]);
			$this->result["grouplist"] = $this->mClient->getGroupDropList("t");
			$this->tplname = 'point_add';
			$this->mLog->adminLog("添加/编辑积分换购");
 		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["sales"] = "selected";
 			$this->result["sites"]["title"] = "积分换购";
 			$this->result["sites"]["url"] = encrypt("points");
 		}
 	}
?>