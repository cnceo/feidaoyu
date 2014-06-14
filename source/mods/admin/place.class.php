<?php
 	class place extends Controller 
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
				$r = $this->mPlace->getList($_GET["cateid"]);
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["status"] = $this->result["statuslist"][$val["status"]];
				}
				//$this->result["catelist"] = $this->mCate->cateDropList($_GET["cateid"]);
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'place';
	 			$this->mLog->adminLog("查看场地列表");
 			
 		}
 		
 		public function savePost()
		{
			$this->_globals();
			/*print_r($_POST);
			die();*/
			$rs = $this->mPlace->savePost();
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/修改场地成功");
			}
			else
			{
				$msg["status"] = "true";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/修改场地失败");
			}
			echo json_encode($msg);
			die();
		}
		
		public function savemeet()
		{
			$this->_globals();
			/*print_r($_POST);
			die();*/
			$rs = $this->mBasic->savePost("place_meetroom");
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/修改场地成功");
			}
			else
			{
				$msg["status"] = "true";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/修改场地失败");
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
			$this->result["catelist"] = $this->mCategory->getCateList(17,"t");
			//取得交通位置点
			$this->result["mappointlist"] = $this->mPlace->getMapPointList();
			
			//省份
			$this->result["provincelist"] = $this->mBasic->getCateListByID("parameters",1,"t");  
			
 			//地铁城市
			$this->result["metrocitylist"] = $this->mBasic->getCateListByID("parameters",2,"t"); 
			
 			//商圈城市
			$this->result["bcitylist"] = $this->mBasic->getCateListByID("parameters",3,"t"); 
 			
 			
			
			if($_GET["id"])
			{
				$this->result["log"] = $this->getRow("places",$_GET["id"]);
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
				$this->result["traffics"] = $this->mPlace->getExpand($_GET["id"],"traffic");
				$this->result["images"] = $this->mPlace->getFilebyPid($_GET["id"]);
				///获取场地会所
				$this->result["meetroom"] = $this->mPlace->getMeetroom($_GET["id"]);
				
				/*
				$this->result["specials"] = $this->mPlace->getPlaceuctSales("special",$_GET["id"]);
				$this->result["discounts"] = $this->mPlace->getPlaceuctSales("discount",$_GET["id"]);
				$parameters = $this->mPlace->getParameter($_GET["id"]);
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
				}*/
			}
			else
			{
				$this->result["log"]["status"] = 1;
			}
			//$this->result["catelist"] = $this->mCate->cateDropList($this->result["log"]["class_id"]);
			//$this->result["grouplist"] = $this->mClient->getGroupDropList("t");
			$this->mLog->adminLog("添加编辑场地");
			$this->tplname = 'place_add';
 		}
 		
 		public function meetroomadd()
 		{
 			$this->_globals();
 			$this->result["header_small"] = 1;
 			$this->result["shapelist"] = $this->mBasic->getCateListByID("parameters",4214,"t");
 			$this->tplname = 'meetroom_add';
 		}
 		
 		public function meetroom()
 		{
 			$this->_globals();
 			$this->result["meetroom"] = $this->mPlace->getMeetroom($_GET["id"]);
 			$this->tplname = 'meetroom';
 		}
 		
 		public function delete()
		{
			$this->_globals();
			if($this->mPurview->adminCheck("PW_PRODS","4")==false)
		 	{
		 		die("Permission denied");
		 	}
			if($this->Del("places",$_POST["id"]) == false)
			 {
				$this->mLog->adminLog("删除内容失败"); 
			 	echo "error";
			 }
			 else
			 {
				$this->mLog->adminLog("删除内容成功"); 
			 	echo "succeed";
			 }
			die();
		}
 		
 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","User","Place","Category"));
 			/*;
 			$this->result["unitlist"] = $this->mPlace->getUnitList();
 			$this->result["brandlist"] = $this->mBrand->getDropList("t");*/
 			$this->result["statuslist"] = $this->mPlace->getStatusList();
 			$this->result["starlist"] = $this->mPlace->getStarList();
 			$this->result["sbstarlist"] = $this->mPlace->getsbStarList();
 			$this->result["sites"]["place"] = "selected";
 			$this->result["sites"]["title"] = "场地";
 			$this->result["sites"]["url"] = encrypt("product");
 		}
 	}
?>