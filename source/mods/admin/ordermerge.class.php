<?php
 	class ordermerge extends Controller 
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
				$this->result["orderlist"] = $this->mOrd->getOrderListByflag("0","t");
	 			$this->tplname = 'ordermerge';
	 			$this->mLog->adminLog("订单查找");
 			
 		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["order"] = "selected";
 			$this->result["sites"]["title"] = "订单";
 			$this->result["sites"]["url"] = encrypt("order");
 		}
 	}
?>