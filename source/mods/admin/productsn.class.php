<?php
 	class productsn extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPur->adminCheck("PW_PRODS","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mProd->getListSN($_GET["cateid"]);
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["status"] = $this->result["statuslist"][$val["flag"]];
					$r["logs"][$key]["passwd"] = substr($val["passwd"],0,-2)."**";
				}
				$this->result["catelist"] = $this->mCate->cateDropList($_GET["cateid"]);
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'productsn';
	 			$this->mLog->adminLog("查看商品序号列表");
 			
 		}
 		
 		public function del()
 			{
 				if($this->mPur->adminCheck("PW_PRODS","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mProd->snDel($_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除商品序号失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除商品序号成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function savePost()
 			{
 				$this->pageinfo();
/* 				print_r($_POST);
 				die();*/
 				$rs = $this->mProd->savePost();
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("添加/修改商品序号成功");
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("添加/修改商品序号失败");
 				}
 				echo json_encode($msg);
 				die();
 			}
 		public function batch()
 			{
 				$this->pageinfo();
 				$rs = $this->mProd->Batch();
		 		$this->mLog->adminLog("批量移动/删除商品序号");
 				/*if($rs)
 				{
 					$msg["status"] = "true";
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					
 				}
 				echo json_encode($msg);*/
 				die();
 			}
 			
 		public function add()
 		{
			if($this->mPur->adminCheck("PW_PRODS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPur->adminCheck("PW_PRODS","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			if($_GET["id"])
			{
				$this->result["log"] = $this->mProd->getRow($_GET["id"]);
				$this->result["images"] = $this->mProd->getFilebyPid($_GET["id"]);
				$this->result["specials"] = $this->mProd->getProductSales("special",$_GET["id"]);
				$this->result["discounts"] = $this->mProd->getProductSales("discount",$_GET["id"]);
				$parameters = $this->mProd->getParameter($_GET["id"]);
				if($parameters)
				{
					foreach ($parameters as $val)
					{
						$ps[$val["ptype"].$val["pkey"].$val["pval"]]= $val;						
					}
					foreach ($this->langs["colors"] as $key=>$val)
					{
						$parakey = "color".$val["color"].$val["name"];
						if($ps[$parakey])
						{
							$this->langs["colors"][$key]["parakey"] = 1;
						}
					}
					foreach ($this->langs["sizes"] as $key=>$val)
					{
						$parakey = "size".$val["size"].$val["name"];
						if($ps[$parakey])
						{
							$this->langs["sizes"][$key]["parakey"] = 1;
						}
					}
				}
			}
			else
			{
				$this->result["log"]["is_alone_sale"] = 1;
			}
			$this->result["catelist"] = $this->mCate->cateDropList($this->result["log"]["class_id"]);
			$this->result["grouplist"] = $this->mClient->getGroupDropList("t");
			$this->mLog->adminLog("添加编辑商品序号");
			$this->tplname = 'productsn_add';
 		}
 		
 		public function listword()
 		{
 			$this->checkLogin();
 			$rs = $this->mProd->getProductByKeyword();
 			//echo json_encode($rs);
 			echo $rs;
 		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["statuslist"] = $this->mProd->getStatus2List();
 			$this->result["unitlist"] = $this->mProd->getUnitList();
 			$this->result["brandlist"] = $this->mBrand->getDropList("t");
 			$this->result["sites"]["catalog"] = "selected";
 			$this->result["sites"]["title"] = "商品序号";
 			$this->result["sites"]["url"] = encrypt("product");
 		}
 	}
?>