<?php
 	class ordersearch extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPur->adminCheck("PW_ORDER","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
	 			$this->tplname = 'ordersearch';
	 			$this->mLog->adminLog("订单查找");
 			
 		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["statuslist"] = $this->mOrd->getStatusList();
 			$this->result["payflaglist"] = $this->mOrd->getPayflagList();
 			$this->result["provincelist"] = $this->mOrd->getCityDorpList(0,"t");
 			//$this->result["unitlist"] = $this->mOrd->getUnitList();
 			//$this->result["brandlist"] = $this->mBrand->getDropList("t");
 			$this->result["sites"]["order"] = "selected";
 			$this->result["sites"]["title"] = "订单";
 			$this->result["sites"]["url"] = encrypt("order");
 		}
 		
 		public function citylist()
 		{
 			$rs = $this->mOrd->getCityDorpList($_GET["pid"]);
 			$str = "<option value=\"\">请选择城市</option>";
 			foreach ($rs as $val)
 			{
 				$str .="<option value=\"".$val["id"]."\">".$val["name"]."</option>";
 			}
 			echo $str;
 			die();
 		}
 		public function countylist()
 		{
 			$rs = $this->mOrd->getCityDorpList($_GET["pid"]);
 			$str = "<option value=\"\">请选择区县</option>";
 			foreach ($rs as $val)
 			{
 				$str .="<option value=\"".$val["id"]."\">".$val["name"]."</option>";
 			}
 			echo $str;
 			die();
 		}
 	}
?>