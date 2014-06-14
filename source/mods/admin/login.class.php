<?php
 	class login extends Controller 
 	{
 		
 		public function checklogin()
 		{
 			$this->loadModel(array("User"));
 			$msg = $this->mUser->adminCheck();
 			echo json_encode($msg);
			die();
 		}
 		public function defshow()
 		{
 			$this->tplname = 'login';
 			$this->result["pagetitle"] = "用户登陆";
 		}
 	}
?>