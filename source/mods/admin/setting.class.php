<?php
 	class setting extends Controller 
 	{
 		public function defshow()
 		{
 			$this->checkLogin();
 			$this->_globals();
 			$this->mPurview->adminCheck("PW_SETUP","1");
 			$this->result["log"] = $this->mSite->get();
 			$this->tplname = 'setting';
 			$this->mLog->adminLog("查看系统设置");
 		}
 		
 		public function savePost()
 		{
 			$this->_globals();
 			$rs = $this->mSite->savePost();
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
 		
 		private function _globals() 
 		{
 			$this->loadModel(array("Purview","Site"));
 			$this->result["sites"]["system"] = "selected";
 			$this->result["sites"]["title"] = "系统设置";
 			$this->result["sites"]["url"] = encrypt("my");
 		}
 	}
?>