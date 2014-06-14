<?php
 	class downcate extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			if($this->mPur->adminCheck("PW_CONTC","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
				$this->result["logs"] = $this->mArt->cateLists("",6);
 			$this->tplname = 'downcate';
 			$this->mLog->adminLog("查看下载分类列表");
 			
 		}
 		
 		public function del()
 			{
 				if($this->mPur->adminCheck("PW_CONTC","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mArt->CateDel($_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除内容分类失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除内容分类成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function savePost()
 			{
 				$this->pageinfo();
 				$rs = $this->mArt->saveCatePost();
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("添加/编辑内容分类成功"); 
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("添加/编辑内容分类失败"); 
 				}
 				echo json_encode($msg);
 				die();
 			}
 		
 		public function add()
 		{
			if($this->mPur->adminCheck("PW_CONTC","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPur->adminCheck("PW_CONTC","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			if($_GET["id"])
			{
				$this->result["log"] = $this->mArt->getCateRow($_GET["id"]);
			}
			if ($_GET["pid"])$this->result["log"]["pid"] = $_GET["pid"]; 
			$this->result["statuslist"] = array(
									1 => "启用",
									0 => "关闭");
			$this->result["plist"] = $this->mArt->cateDropList($this->result["log"]["pid"]);
			$this->tplname = 'articlecate_add';
			$this->mLog->adminLog("添加/编辑内容分类"); 
 		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["arts"] = "selected";
 			$this->result["sites"]["title"] = "下载分类";
 			$this->result["sites"]["url"] = encrypt("downcate");
 		}
 	}
?>