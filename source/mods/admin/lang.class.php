<?php
 	class lang extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPur->adminCheck("PW_DEPT","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$this->result["logs"] = $this->mUni->cateList("langs");
	 			$this->tplname = 'lang';
	 			$this->mLog->adminLog("查看语言列表");
 			
 		}
 		
 		public function del()
 			{
 				if($this->mPur->adminCheck("PW_DEPT","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mUni->Del("langs",$_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除语言失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除语言成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function savePost()
 			{
 				$this->pageinfo();
 				$rs = $this->mUni->savePost("langs");
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("添加/编辑语言成功"); 
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("添加/编辑语言失败"); 
 				}
 				echo json_encode($msg);
 				die();
 			}
 		
 		public function add()
 		{
			if($this->mPur->adminCheck("PW_DEPT","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPur->adminCheck("PW_DEPT","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			if($_GET["id"])
			{
				$this->result["log"] = $this->mUni->getRow("langs",$_GET["id"]);
			}
			$this->result["statuslist"] = array(
									1 => "已认证",
									0 => "未认证");
			$this->tplname = 'lang_add';
			$this->mLog->adminLog("添加/编辑语言"); 
 		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["system"] = "selected";
 			$this->result["sites"]["title"] = "语言";
 			$this->result["sites"]["url"] = encrypt("custormer");
 		}
 	}
?>