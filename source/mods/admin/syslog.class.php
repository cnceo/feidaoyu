<?php
 	class syslog extends Controller 
 	{
 		public function show()
 		{
 			$this->checkLogin();
 			if($this->mPur->adminCheck("SYS_LOGS","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
 			include(_APP_PATH."libs/adodb/adodb-pager2.inc.php");
 			$t = $this->mLog->getList();
 			$this->result["logs"] = $t["logs"];
 			$this->result["pages"] = $t["pages"];
 			$this->result["sites"]["system"] = "active";
 			$this->result["login"] = $_SESSION["login_admin"];
 			$this->tplname = 'syslog';
 			$this->mLog->adminLog("查看系统日志"); 
 			$this->Display();
 		}
 		
 	}
?>