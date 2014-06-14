<?php
 	class my extends Controller 
 	{
 		public function defshow()
 		{
 			$this->_globals();
 			$this->result["log"] = $this->mUser->getRow($_SESSION["login_admin"]["id"]);
 			$this->result["deptlist"] = $this->mBasic->cateList("depts","t");
			$this->result["grouplist"] = $this->mBasic->cateList("usergroup","t");
 			$this->tplname = 'my';
 		}
 		
 		public function changepasswd()
 		{
 			$this->_globals();
 			$this->tplname = 'password';
 		}
 		
 		public function savePost()
		{
			$this->_globals();
			$rs = $this->mUser->savePost();
			if($rs)
			{
				$msg["status"] = "true";
			}
			else
			{
				$msg["false"] = "true";
				$msg["message"] = "保存错误，请联系管理员";
				
			}
			echo json_encode($msg);
			die();
		}
		
		public function checkpasswd()
		{
			$this->_globals();
			$msg = $this->mUser->verifyPassword($_SESSION["login_admin"]["id"],$_GET["oldpasswd"]);
			echo json_encode($msg);
		}
 		
 		private function _globals() 
 		{
 			$this->loadModel(array("User","Basic"));
 			$this->result["sites"]["system"] = "selected";
 			$this->result["sites"]["title"] = "我的设置";
 			$this->result["sites"]["url"] = encrypt("my");
 		}
 	}
?>