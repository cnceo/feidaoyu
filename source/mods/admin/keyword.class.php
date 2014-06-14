<?php
 	class keyword extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPurview->adminCheck("PW_KEYWD","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mProduct->getKeyWordManageList();
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'keyword';
	 			$this->mLog->adminLog("查看关键词列表");
 			
 		}
 		
 		public function del()
 			{
 				if($this->mPurview->adminCheck("PW_KEYWD","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mProduct->DelKeyWord($_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除关键词失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除关键词成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function savePost()
 			{
 				$this->_globals();
 				$rs = $this->mProduct->saveKeywordPost();
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("添加/编辑关键词成功"); 
 				}
 				else
 				{
 					$msg["status"] = "false";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("添加/编辑关键词失败"); 
 				}
 				echo json_encode($msg);
 				die();
 			}
 		public function batch()
 			{
 				$this->_globals();
 				$rs = $this->mProduct->KeywordBatch();
		 		$this->mLog->adminLog("批量移动/删除关键词");
 				/*if($rs)
 				{
 					$msg["status"] = "true";
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					
 				}
 				echo json_encode($msg);*/
 				die();
 			}
 			
 		public function add()
 		{
			if($this->mPurview->adminCheck("PW_KEYWD","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_KEYWD","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->_globals();
			if($_GET["id"])$this->result["log"] = $this->mProduct->getKeyWordRow($_GET["id"]);
			$this->tplname = 'keyword_add';
			$this->mLog->adminLog("添加/编辑关键词"); 
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","Product"));
 			$this->result["sites"]["arts"] = "selected";
 			$this->result["sites"]["title"] = "搜索关键词";
 			$this->result["sites"]["url"] = encrypt("keyword");
 		}
 	}
?>