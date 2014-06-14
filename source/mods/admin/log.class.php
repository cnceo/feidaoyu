<?php
 	class log extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPurview->adminCheck("PW_LOGS","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mLog->getList();
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'log';
	 			$this->mLog->adminLog("查看系统日志列表");
 			
 		}
 		
 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview"));
 			$this->result["sites"]["system"] = "selected";
 			$this->result["sites"]["title"] = "系统日志";
 			$this->result["sites"]["url"] = encrypt("keyword");
 		}
 	}
?>