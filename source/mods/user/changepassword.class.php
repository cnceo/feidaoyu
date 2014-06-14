<?php
 	class changepassword extends Controller
 	{
 		public function defshow()
 		{
 			$this->_globals();
 			$this->tplname = "repwd";
 			$this->result["log"] = $this->getRow("customers",$_SESSION["login_user"]["id"]);
 			$this->result["sites"]["pagetitle"] = "会员中心".$this->result["sites"]["sitename"];
 		}

 		public function checkpasswd()
		{
			$this->_globals();
			$msg = $this->mCustomer->verifyPassword($_SESSION["login_user"]["id"],$_GET["oldpasswd"]);
			echo json_encode($msg);
			die();
		}

		public function update()
		{
			$this->_globals();
			$_POST["id"] = $_SESSION["login_user"]["id"];
			$rs = $this->mCustomer->savePost();
 			if($rs)
			{
				unset($_SESSION["login_user"]);
				$msg["status"] = "true";
				$msg["message"] = "保存成功";
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
 			$this->loadModel(array("Customer"));
 			$this->checkUserLogin();
 		}

 	}
?>