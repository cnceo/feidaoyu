<?php
 	class demand extends Controller 
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
				$r = $this->mDemand->getList($_GET["cateid"]);
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["status"] = $this->result["statuslist"][$val["status"]];
				}
				//$this->result["catelist"] = $this->mCate->cateDropList($_GET["cateid"]);
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'demand';
	 			$this->mLog->adminLog("查看商品列表");
 			
 		}
 		
 		public function savePost()
		{
			$this->_globals();
			/*print_r($_POST);
			die();*/
			$rs = $this->mDemand->savePost();
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
			$this->result["catelist"] = $this->mCategory->getCateList(20,"t");
			//企业类型
			$this->result["companylist"] = $this->mBasic->getCateListByID("parameters",4076,"t"); 
			//活动类型
			$this->result["activitylist"] = $this->mBasic->getCateListByID("parameters",4089,"t"); 
			//活动人数
			$this->result["peoplelist"] = $this->mBasic->getCateListByID("parameters",4106,"t"); 
			//活动内容
			$this->result["aclist"] = $this->mBasic->getCateListByID("parameters",4117,"t"); 
			//策划服务
			$this->result["brewlist"] = $this->mBasic->getCateListByID("parameters",4125,"t");
			//制作服务
			$this->result["makelist"] = $this->mBasic->getCateListByID("parameters",4126,"t");
			//租赁服务
			$this->result["leaselist"] = $this->mBasic->getCateListByID("parameters",4127,"t");
			//人员服务
			$this->result["pslist"] = $this->mBasic->getCateListByID("parameters",4128,"t");
			//场地类型
			$this->result["placetype"] = $this->mBasic->getCateListByID("parameters",4153,"t");
			//场地布置
			$this->result["decoratedlist"] = $this->mBasic->getCateListByID("parameters",4167,"t");
			//活动配套
			$this->result["assortedlist"] = $this->mBasic->getCateListByID("parameters",4181,"t");	
			
			$this->result["meetinglist"] = $this->mBasic->getCateListByID("parameters",4188,"t");
			//会务配套
			$this->result["repastlist"] = $this->mBasic->getCateListByID("parameters",4197,"t");
			
			//餐饮类型
			$this->result["foodclasslist"] = $this->mBasic->getCateListByID("parameters",4197,"t");
			//餐饮形式
			$this->result["foodtypelist"] = $this->mBasic->getCateListByID("parameters",4197,"t");

			
			//需求分类 
			$this->result["dtype"] = $this->mCategory->getCateList(81,"t");
			$this->result["log"]['dtype']= 82;
			//省份
			$this->result["provincelist"] = $this->mBasic->getCateListByID("parameters",1,"t");  
			
 			//地铁城市
			$this->result["metrocitylist"] = $this->mBasic->getCateListByID("parameters",2,"t"); 
			
 			//商圈城市
			$this->result["bcitylist"] = $this->mBasic->getCateListByID("parameters",3,"t"); 
			
			if($_GET["id"])
			{
				$this->result["log"] = $this->getRow("demands",$_GET["id"]);
				$this->result["log"]["make"] = explode(",",$this->result["log"]["make"]);
				$this->result["log"]["lease"] = explode(",",$this->result["log"]["lease"]);
				$this->result["log"]["ps"] = explode(",",$this->result["log"]["ps"]);
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
				$this->result["traffics"] = $this->mDemand->getExpand($_GET["id"],"traffic");
				/*$this->result["images"] = $this->mDemand->getFilebyPid($_GET["id"]);*/
			}
			else
			{
				$this->result["log"]["status"] = 1;
			}
			$this->mLog->adminLog("添加编辑商品");
			$this->tplname = 'demand_add';
 		}
		
 		
 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","User","Demand","Category"));
 			$this->result["statuslist"] = $this->mDemand->getStatusList();
			$this->result["demandstatuslist"] = $this->mDemand->getDemandStatusList();
 			$this->result["starlist"] = $this->mDemand->getStarList();
 			$this->result["sbstarlist"] = $this->mDemand->getsbStarList();
 			$this->result["sites"]["demand"] = "selected";
 			$this->result["sites"]["title"] = "需求";
 			$this->result["sites"]["url"] = encrypt("product");
 		}
 	}
?>