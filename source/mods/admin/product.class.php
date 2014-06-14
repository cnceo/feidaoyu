<?php
 	class product extends Controller
 	{
 		protected $tpl;

 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPurview->adminCheck("PW_PRODS","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mProduct->getList($_GET["cateid"]);
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["brand_name"] = $this->mBasic->getName("brands",$val["brand_id"],"cname");
					$r["logs"][$key]["status_name"] = $this->result["statuslist"][$val["status"]];
				}
				$this->result["catelist"] = $this->mCategory->cateDropList($_GET["cateid"]);
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'product';
	 			$this->mLog->adminLog("查看商品列表");

 		}

 		public function auto()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
 			if($this->mPurview->adminCheck("PW_PRODA","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$r = $this->mProduct->getList();
			foreach ($r["logs"] as $key=>$val)
			{
				$r["logs"][$key]["status"] = $this->result["statuslist"][$val["status"]];
			}
			$this->result["catelist"] = $this->mCategory->cateDropList();
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
 			$this->tplname = 'product_auto';
 			$this->mLog->adminLog("商品自动上下架");

 		}

 		public function autodo()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
 			if($this->mPurview->adminCheck("PW_PRODA","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->mProduct->autoDo();
			die();

 		}

 		public function delete()
		{
			$this->_globals();
			$msg["status"] = "false";
			if($this->mPurview->adminCheck("PW_USERS","4")==false)
		 	{
		 		$msg["message"] = "Permission denied";
		 	}
		 	else
		 	{
				if($this->Del("products",$_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除产品失败");
				 	$msg["message"] = "删除产品失败";
				 }
				 else
				 {
					$this->mLog->adminLog("删除产品成功");
					$msg["status"] = "true";
				 	$msg["message"] = "删除产品成功";
				 }
		 	}
			 echo json_encode($msg);
			die();
		}

 		public function savePost()
 			{
 				$this->_globals();
 				$_POST["cdescription"] =  str_replace("'","’",$_POST["cdescription"]);
 				if($_POST["ptype"])$_POST["ptype"] = implode(",",$_POST["ptype"]);
 				$rs = $this->mProduct->savePost();
 				//$rs = $this->mBasic->savePost("products");
 				if($_POST["id"])
 				{
 					$log = "修改".$_POST["cprodname"];
 				}
 				else
 				{
 					$log = "添加".$_POST["cprodname"];
 				}

 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("$log商品成功");
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("$log商品失败");
 				}
 				echo json_encode($msg);
 				die();
 			}
 		public function batch()
 		{
 			$this->_globals();
 			$rs = $this->mProduct->Batch();
	 		$this->mLog->adminLog("批量移动/删除商品");
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

 			$this->_globals();
 			if($this->mPurview->adminCheck("PW_PRODS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_PRODS","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($_GET["id"])
			{
				$this->result["log"] = $this->mProduct->getRow($_GET["id"]);
				if($this->result["log"]["ptype"]) $this->result["log"]["ptype"] = explode(",",$this->result["log"]["ptype"]);
				$this->result["images"] = $this->mProduct->getFilebyPid($_GET["id"]);
				$this->result["specials"] = $this->mProduct->getProductSales("special",$_GET["id"]);
				$this->result["discounts"] = $this->mProduct->getProductSales("discount",$_GET["id"]);
				$cate =  $this->mProduct->getRow($this->result["log"]["class_id"]);
				//$this->result["valslists"] = $this->mProduct->getParameter2($_GET["id"]);
				//$this->result["valslists"] = $this->mProduct->getProductParameter($_GET["id"],$this->result["log"]["class_id"]);
				//$parameters = $this->mProduct->getParameter2($_GET["id"]);
				/*if($parameters)
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
				}*/
			}
			else
			{
				$this->result["log"]["is_alone_sale"] = 1;
				$this->result["log"]["class_id"] = $_GET["cateid"];
			}
			$this->result["valslists"] = $this->mProduct->getProductParameter($_GET["id"],$this->result["log"]["class_id"]);
			$this->result["placelist"] = $this->mBasic->cateList("places","t");
			$this->result["catelist"] = $this->mCategory->cateDropList($this->result["log"]["class_id"]);
			$this->result["grouplist"] = $this->mCustomer->getGroupDropList("t");
			$this->mLog->adminLog("添加编辑商品");

			$this->tplname = 'product_add';
 		}

 		public function listword()
 		{
 			$this->_globals();
 			$this->checkLogin();
 			$rs = $this->mProduct->getProductByKeyword();
 			//echo json_encode($rs);
 			echo $rs;
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","User","Product","Category","Customer","Brand"));
 			$this->result["statuslist"] = $this->mProduct->getStatusList();
 			$this->result["unitlist"] = $this->mProduct->getUnitList();
 			/* $this->result["brandlist"] = $this->mBrand->getDropList("t"); */
 			$this->result["typelist"] = $this->mProduct->getTypeList();
 			$this->result["sites"]["catalog"] = "selected";
 			$this->result["sites"]["title"] = "商品";
 			$this->result["sites"]["url"] = encrypt("product");
 		}
 	}
?>