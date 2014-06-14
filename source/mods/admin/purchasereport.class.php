<?php
 	class purchasereport extends Controller 
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
 				$this->result["logs"] = $this->mProd->getTopSaleList();
	 			$this->tplname = 'purchasereport';
	 			$this->mLog->adminLog("查看销售报表列表");
 			
 		}
 		

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["statuslist"] = $this->mOrd->getStatusList();
			$this->result["timeslist"] = $this->mOrd->getTimeList();
 			$this->result["sites"]["order"] = "selected";
 			$this->result["sites"]["title"] = "销售报表";
 			$this->result["sites"]["url"] = encrypt("order");
 		}
 	}
?>