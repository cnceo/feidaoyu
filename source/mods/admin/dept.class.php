<?php
 	class dept extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->_globals();
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPurview->adminCheck("PW_DEPT","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$this->result["logs"] = $this->mBasic->cateList("depts");
	 			$this->tplname = 'dept';
	 			$this->mLog->adminLog("查看部门列表");
 			
 		}
 		
 		public function del()
 			{
 				$this->_globals();
 				if($this->mPurview->adminCheck("PW_DEPT","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mBasic->Del("depts",$_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除部门失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除部门成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function savePost()
 			{
 				$this->_globals();
 				$rs = $this->mBasic->savePost("depts");
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("添加/编辑部门成功"); 
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("添加/编辑部门失败"); 
 				}
 				echo json_encode($msg);
 				die();
 			}
 		
 		public function add()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_DEPT","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_DEPT","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			
			if($_GET["id"])
			{
				$this->result["log"] = $this->mBasic->getRow("depts",$_GET["id"]);
			}
			$this->result["statuslist"] = array(
									1 => "已认证",
									0 => "未认证");
			$this->tplname = 'dept_add';
			$this->mLog->adminLog("添加/编辑部门"); 
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","User"));
 			$this->result["sites"]["system"] = "selected";
 			$this->result["sites"]["title"] = "部门";
 			$this->result["sites"]["url"] = encrypt("custormer");
 		}
 	}
?>