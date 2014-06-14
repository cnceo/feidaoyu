<?php
 	class parameter2 extends Controller 
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
				if(!$_GET["pid"])$_GET["pid"]=0;
				$this->result["logs"] = $this->mBasic->getCateListByID("parameters2",$_GET["pid"]);
	 			$this->tplname = 'parameter2';
	 			$this->mLog->adminLog("查看参数列表");
 			
 		}
 		
 		public function del()
 			{
 				$this->_globals();
 				if($this->mPurview->adminCheck("PW_DEPT","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mBasic->Del("parameters2",$_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除参数失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除参数成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function savePost()
 			{
 				$this->_globals();
 				$rs = $this->mBasic->savePost("parameters2");
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("添加/编辑参数成功"); 
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("添加/编辑参数失败"); 
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
				$this->result["log"] = $this->mBasic->getRow("parameters2",$_GET["id"]);
			}
			if ($_GET["pid"])$this->result["log"]["pid"] = $_GET["pid"]; 
			$this->result["plist"] = $this->mBasic->cateDropList("parameters2",$this->result["log"]["pid"]);
			$this->result["statuslist"] = array(
									1 => "已认证",
									0 => "未认证");
			$this->tplname = 'parameter_add2';
			$this->mLog->adminLog("添加/编辑参数"); 
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","User"));
 			$this->result["sites"]["system"] = "selected";
 			$this->result["sites"]["title"] = "参数";
 			$this->result["sites"]["url"] = encrypt("custormer");
 		}
 	}
?>