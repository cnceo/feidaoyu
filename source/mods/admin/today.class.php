<?php
 	class today extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
			if($this->mPur->adminCheck("PW_CDOWN","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			$this->result["countdowns"] = $this->mProd->getCountDownSales();
			$this->result["grouplist"] = $this->mClient->getGroupDropList();
			
			$this->tplname = 'today';
 		}
 		

 		public function savePost()
 			{
 				$this->pageinfo();
 				$this->mProd->updateCountDownSales();
 				$msg["status"] = "true";
 				echo json_encode($msg);
 				die();
 			}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["sales"] = "selected";
 			$this->result["sites"]["title"] = "限时抢购";
 			$this->result["sites"]["url"] = encrypt("category");
 		}
 	}
?>