<?php
 	class filemgr extends Controller 
 	{
 		protected $fgr;
 		public function show()
 		{
 			$this->checkLogin();
 			//$this->mDb->debug = true;
 			include(_APP_PATH."libs/File.class.php");
 			$this->fgr = new files();
 			$this->fgr->mDb = $this->mDb;
 			if($this->mAction=="upload")
 			{
 				$this->fgr->upLoad("admin",$_SESSION["login_admin"]["id"]);
				die();
 			}

 			include(_APP_PATH."libs/adodb/adodb-pager2.inc.php");
			$this->result["catelist"] = $this->fgr->upFilecate();
			$this->result["log"]["filetype"] = $_GET["filetype"];
			$this->result["log"]["fileinput"] = $_GET["fileinput"];
			$this->result["log"]["classid"] = $_GET["classid"];
			$t = $this->fgr->getList($_SESSION["login_admin"]["id"],$_GET["classid"],"admin");
			$this->result["logs"] = $t["logs"];
			$this->result["pages"] = $t["pages"];
			$this->mLog->adminLog("查看文件列表"); 
		    $this->tplname = "filemgr";
 			$this->Display();
 		}
 	}
?>