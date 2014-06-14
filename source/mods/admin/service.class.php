<?php
 	class service extends Controller 
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
				$r = $this->mService->getList($_GET["cateid"]);
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["status"] = $this->result["statuslist"][$val["status"]];
				}
				//$this->result["catelist"] = $this->mCate->cateDropList($_GET["cateid"]);
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'service';
	 			$this->mLog->adminLog("查看商品列表");
 			
 		}
 		
 		public function savePost()
		{
			$this->_globals();
			/*print_r($_POST);
			die();*/
			$rs = $this->mService->savePost();
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
			$this->result["catelist"] = $this->mCategory->getCateList(21,"t");
			
			
			//省份
			$this->result["provincelist"] = $this->mBasic->getCateListByID("parameters",1,"t");  
			
 			//地铁城市
			$this->result["metrocitylist"] = $this->mBasic->getCateListByID("parameters",2,"t"); 
			
 			//商圈城市
			$this->result["bcitylist"] = $this->mBasic->getCateListByID("parameters",3,"t"); 
 			
 			
			
			if($_GET["id"])
			{
				$this->result["log"] = $this->getRow("services",$_GET["id"]);
				//小类
			    if($this->result["log"]["cateid"])$this->result["smallcatelist"] = $this->mCategory->getCateList($this->result["log"]["cateid"],"t");
				//省份 
				if($this->result["log"]["province"])$this->result["citylist"] = $this->mBasic->getCateListByID("parameters",$this->result["log"]["province"],"t");
	 			if($this->result["log"]["city"])$this->result["countylist"] = $this->mBasic->getCateListByID("parameters",$this->result["log"]["city"],"t");
	 			
	 			//地铁城市
				if($this->result["log"]["metrocity"])$this->result["linelist"] = $this->mBasic->getCateListByID("parameters",$this->result["log"]["metrocity"],"t");
	 			if($this->result["log"]["line"])$this->result["stationlist"] = $this->mBasic->getCateListByID("parameters",$this->result["log"]["line"],"t");
	 			
	 			//商圈城市
				if($this->result["log"]["bcity"])$this->result["districtlist"] = $this->mBasic->getCateListByID("parameters",$this->result["log"]["bcity"],"t");
	 			//
				$this->result["images"] = $this->mService->getFilebyPid($_GET["id"]);
			}
			else
			{
				$this->result["log"]["is_alone_sale"] = 1;
			}
			//$this->result["catelist"] = $this->mCate->cateDropList($this->result["log"]["class_id"]);
			//$this->result["grouplist"] = $this->mClient->getGroupDropList("t");
			$this->mLog->adminLog("添加编辑商品");
			$this->tplname = 'service_add';
 		}
 		
 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","User","Service","Category"));
 			$this->result["statuslist"] = $this->mService->getStatusList();
 			$this->result["starlist"] = $this->mService->getStarList();
 			$this->result["sbstarlist"] = $this->mService->getsbStarList();
 			$this->result["sites"]["service"] = "selected";
 			$this->result["sites"]["title"] = "服务";
 			$this->result["sites"]["url"] = encrypt("product");
 		}
 	}
?>