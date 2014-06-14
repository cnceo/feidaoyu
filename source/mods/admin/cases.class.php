<?php
 	class cases extends Controller 
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
				$r = $this->mCases->getList($_GET["cateid"]);
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["status"] = $this->result["statuslist"][$val["status"]];
				}
				//$this->result["catelist"] = $this->mCate->cateDropList($_GET["cateid"]);
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'cases';
	 			$this->mLog->adminLog("查看商品列表");
 			
 		}
 		
 		public function savePost()
		{
			$this->_globals();
			/*print_r($_POST);
			die();*/
			$rs = $this->mCases->savePost();
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/修改商品成功");
			}
			else
			{
				$msg["status"] = "true";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/修改商品失败");
			}
			echo json_encode($msg);
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
			
			//大类
			$this->result["catelist"] = $this->mBasic->getCateListByID(4210,"t");
			
 			//商圈城市
			$this->result["bcitylist"] = $this->mBasic->getCateListByID("parameters",3,"t"); 
			
			$this->result["catelist"] = $this->mBasic->getCateListByID("parameters",4210,"t");
			 
			
			if($_GET["id"])
			{
				$this->result["log"] = $this->getRow("cases",$_GET["id"]);
				//小类
			    if($this->result["log"]["cateid"])$this->result["smallcatelist"] = $this->mCategory->getCateList($this->result["log"]["cateid"],"t");
	 			//商圈城市
				if($this->result["log"]["bcity"])$this->result["districtlist"] = $this->mBasic->getCateListByID("parameters",$this->result["log"]["bcity"],"t");
				$this->result["images"] = $this->mCases->getFilebyPid($_GET["id"]);
			}
			else
			{
				$this->result["log"]["status"] = 1;
			}
			$this->mLog->adminLog("添加编辑商品");
			$this->tplname = 'cases_add';
 		}
 		
 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","User","Cases","Category"));
 			$this->result["statuslist"] = $this->mCases->getStatusList();
 			$this->result["starlist"] = $this->mCases->getStarList();
 			$this->result["sbstarlist"] = $this->mCases->getsbStarList();
 			$this->result["sites"]["case"] = "selected";
 			$this->result["sites"]["title"] = "案例";
 			$this->result["sites"]["url"] = encrypt("product");
 		}
 	}
?>