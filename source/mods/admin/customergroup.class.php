<?php
 	class customergroup extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
	 			if($this->mPurview->adminCheck("PW_CLIENTG","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$this->result["logs"] = $this->mCustomer->getGroupList();
	 			$this->tplname = 'customergroup';
	 			$this->mLog->adminLog("查看会员等级列表");
 			
 		}
 		
 		public function del()
 			{
 				$this->_globals();
 				if($this->mPurview->adminCheck("PW_CLIENTG","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mCustomer->GroupDel($_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除会员等级失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除会员等级成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function savePost()
 			{
 				$this->_globals();
 				$rs = $this->mCustomer->saveGroupPost();
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("添加/编辑会员等级成功"); 
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("添加/编辑会员等级失败"); 
 				}
 				echo json_encode($msg);
 				die();
 			}
 		
 		public function add()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_CLIENTG","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_CLIENTG","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}

			if($_GET["id"])
			{
				$this->result["log"] = $this->mCustomer->getGroupRow($_GET["id"]);
			}
			$this->result["statuslist"] = array(
									1 => "已认证",
									0 => "未认证");
			$this->tplname = 'customergroup_add';
			$this->mLog->adminLog("添加/编辑会员等级"); 
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","Customer"));
 			$this->result["sites"]["customer"] = "selected";
 			$this->result["sites"]["title"] = "会员等级";
 			$this->result["sites"]["url"] = encrypt("customergroup");
 		}
 	}
?>