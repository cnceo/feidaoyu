<?php
 	class comment extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPur->adminCheck("PW_COMMIT","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mProd->getCommmentList();
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'comment';
	 			$this->mLog->adminLog("查看评论列表");
 			
 		}
 		
 		public function del()
		{
			if($this->mPur->adminCheck("PW_COMMIT","4")==false)
		 	{
		 		die("Permission denied");
		 	}
				if($this->mProd->DelComment($_POST["id"]) == false)
			 {
				$this->mLog->adminLog("删除评论失败"); 
			 	echo "error";
			 }
			 else
			 {
				$this->mLog->adminLog("删除评论成功"); 
			 	echo "succeed";
			 }
			die();
		}
 		
 		public function savePost()
		{
			$this->pageinfo();
			$content = str_replace($this->result["sites"]["badwords"],$this->result["sites"]["replaceword"],$_POST["content"]);
 			$rs = $this->mProd->saveProductComments($content);
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/编辑评论成功"); 
			}
			else
			{
				$msg["status"] = "false";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/编辑评论失败"); 
			}
			echo json_encode($msg);
			die();
		}
		
 		public function batch()
		{
			$this->pageinfo();
			$rs = $this->mProd->CommentBatch();
 			$this->mLog->adminLog("批量移动/删除评论");
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
			if($this->mPur->adminCheck("PW_COMMIT","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPur->adminCheck("PW_COMMIT","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			if($_GET["id"])$this->result["log"] = $this->mProd->getCommentRow($_GET["id"]);
			$this->tplname = 'comment_add';
			$this->mLog->adminLog("添加/编辑评论"); 
 		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["catalog"] = "selected";
 			$this->result["sites"]["title"] = "评论管理";
 			$this->result["sites"]["url"] = encrypt("comment");
 		}
 	}
?>