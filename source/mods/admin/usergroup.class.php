<?php
 	class usergroup extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->_globals();
 			$this->result["sites"]["contents"] = "active";
 			if($this->mPurview->adminCheck("PW_USERG","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->result["logs"] = $this->mBasic->cateList("usergroup");
 			$this->tplname = 'usergroup';
 			$this->mLog->adminLog("查看会员等级列表");
 			
 		}
 		
 		public function del()
 			{
 				$this->_globals();
 				if($this->mPurview->adminCheck("PW_USERG","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mBasic->Del("usergroup",$_POST["id"]) == false)
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
 				$rs = $this->mBasic->savePost("usergroup");
 				if($rs)
		  		{
		  			$this->mPurview->update("group",$_POST["id"]);
		  			$msg["status"] = "true";
		  			$this->mLog->adminLog("添加/编辑用户组成功"); 
		  		}
		  		else
		  		{
		  			$msg["status"] = "false";
					$msg["message"] = "保存错误，请联系管理员";
					$this->mLog->adminLog("添加/编辑用户组失败");
		  		}
 				echo json_encode($msg);
 				die();
 			}
 		
 		public function add()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_USERG","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_USERG","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}

			if($_GET["id"])
			{
				$this->result["log"] = $this->mBasic->getRow("usergroup",$_GET["id"]);
				$this->result["pw"] = $this->mPurview->edit("group",$_GET["id"]);
			}
			$this->result["statuslist"] = array(
									1 => "已认证",
									0 => "未认证");
			$this->tplname = 'usergroup_add';
			$this->result["pw"]["radios"] = array(
					1 => "许可",
					0 => "不许可");
			
			$this->result["pw"]["checkboxes"] = array(
					1 => "浏览",
					2 => "新加",
					3 => "编辑",
					4 => "删除");
			$this->mLog->adminLog("添加/编辑用户组");
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","User"));
 			$this->result["sites"]["system"] = "selected";
 			$this->result["sites"]["title"] = "用户组";
 			$this->result["sites"]["url"] = encrypt("custormer");
 		}
 	}
?>