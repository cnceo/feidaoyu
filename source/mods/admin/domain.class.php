<?php
	class domain extends Controller
 	{
 		protected $tpl;

 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
 			if($this->mPurview->adminCheck("PW_CONTS","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			} 
			$time = date("Y-m-d",time()+3600*24*30*12);  
			$where[] = " etime <= '".$time."' ";
			$where[] = " etime >=now()";
			$r = $this->mBasic->getList("domain_log",$where);
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
			$this->tplname = 'domain';
			$this->mLog->adminLog("查看域名到期列表");

 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","Customer","Order"));
 			$this->result["sites"]["customer"] = "selected";
 			$this->result["sites"]["title"] = "到期列表";
 			$this->result["sites"]["url"] = encrypt("domain");
 			
 		}
 	}
?>