<?php
 	class dbadmin extends Controller 
 	{
 		protected $tpl;
 		protected $bk;
 		public function defshow()
 		{
 			$this->_globals();
 			if($this->mPurview->adminCheck("PW_DATABS","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->result["logs"] = $this->mDBAdmin->getList();
			$this->result["datalist"] = $this->mDBAdmin->getList("s");
	 		$this->tplname = "database";
 		}

 		public function save()
		 {
		 	
 			$this->_globals();
		 	if($_POST["type"]=="build")
		 	{
		 		$filename = $this->mDBAdmin->build();
		 		$this->mLog->adminLog("备份数据库:$filename"); 
		 	}
		 	else
		 	{
		 		
		 		$this->mDBAdmin->revert();
		 		$this->mLog->adminLog("还原数据库"); 
		 	}
		 	die();
		 }
		 
		public function download()
		{
			$this->_globals();
			$this->mDBAdmin->getfile($_GET["file"]);
			die();
		}
 		
 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","DBAdmin"));
 			$this->result["sites"]["system"] = "selected";
 			$this->result["sites"]["title"] = "数据库备份/恢复";
 			$this->result["sites"]["url"] = encrypt("database");
			$this->mDBAdmin->mPath = _FILE_PATH."/database_backup";
 		}
 	}
?>