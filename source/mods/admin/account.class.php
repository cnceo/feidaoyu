<?php
 	class account extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPurview->adminCheck("PW_USERS","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mUser->getList();
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["dept"] = $this->mBasic->getName("depts",$val["deptid"]);
					$r["logs"][$key]["group"] = $this->mBasic->getName("usergroup",$val["groupid"]);
				}
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'account';
	 			$this->mLog->adminLog("查看用户列表");
 			
 		}
 		
 		public function del()
		{
			$this->_globals();
			if($this->mPurview->adminCheck("PW_USERS","4")==false)
		 	{
		 		die("Permission denied");
		 	}
			if($this->mUser->Del($_POST["id"]) == false)
			 {
				$this->mLog->adminLog("删除用户失败"); 
			 	echo "error";
			 }
			 else
			 {
				$this->mLog->adminLog("删除用户成功"); 
			 	echo "succeed";
			 }
			die();
		}
 		
 		public function savePost()
		{
			$this->_globals();
			$rs = $this->mUser->savePost();
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/编辑用户成功"); 
			}
			else
			{
				$msg["false"] = "true";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/编辑用户失败"); 
			}
			echo json_encode($msg);
			die();
		}
 			
 		public function add()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_USERS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_USERS","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			
			if($_GET["id"])
			{
				$this->result["log"] = $this->mUser->getRow($_GET["id"]);
			}
			$this->result["deptlist"] = $this->mBasic->cateList("depts","t");
			$this->result["grouplist"] = $this->mBasic->cateList("usergroup","t");
			$this->result["statuslist"] = $this->getStatusList();
			$this->tplname = 'account_add';
			$this->mLog->adminLog("添加/编辑用户"); 
 		}

 		private function _globals()
 		{
 			$this->loadModel(array("Purview","User","Basic"));
 			$this->checkLogin();
 			$this->result["sites"]["system"] = "selected";
 			$this->result["sites"]["title"] = "用户";
 			$this->result["sites"]["url"] = encrypt("account");
 		}
 		
 		public function getStatusList()
		{
			return array(   0 => "正常",
							1 => "锁定"
							);
		}
 	}
?>