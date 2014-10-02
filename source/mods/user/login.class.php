<?php
    /**
     * 用户登陆*
     *
     */
 	class login extends Controller
 	{
 		public function defshow()
 		{
 			$this->_globals();
 			if(!$_SESSION["login_user"]){
			//来路跳转
			$uri = explode("baseurl=",$_SERVER["REQUEST_URI"]);
			$this->result["baseurl"] = "http://".$_SERVER["HTTP_HOST"].urldecode($uri[1]);
			$this->result["uri"] = $uri[1];
 			$this->tplname = "login";
 			$this->result["sites"]["pagetitle"] = "会员登陆";
			}else {
			header("Location: /user/order.html");
			}
 		}

 		/**
 		 * 用户登录检查
 		 *
 		 */
 		public function checklogin()
 		{
 			$this->_globals();
 			$_POST["username"] = strtolower($_POST["username"]);
 			$rs = $this->mCustomer->checkLogin();
		    if($rs)
			{
				$sql="SELECT * FROM ".get_table("customers")." WHERE email = '".$_POST["username"]."'";
				$r = $this->mDb->getRow($sql);
				if($r["status"] == 1)
				{
					$msg["status"] = "true";
					$this->mCustomer->upHits($_SESSION["login_user"]["id"]);
					$_SESSION["login_user"] = $r;
					$msg["message"] = "登录成功";
					$this->mLog->userLog("前台登录成功");
                                }else{
                                    $msg["status"] = "false";
                                    $msg["message"] = "您的邮箱还没有验证,请查看邮件进行验证";
                                }
			}
			else
			{
				$msg["status"] = "false";
				$msg["message"] = "错误的用户名或密码";
				$_SESSION["tmpuser"] = $_POST["username"];
			}
			echo json_encode($msg);
 			die();
 		}

 		 /**
 		  * 检查邮件用户名
 		  */
 		public function check()
 		{
 			$this->_globals();
 			if($_GET["email"])$msg = $this->mCustomer->checkField("email",$_GET["email"]);
 			if(!$msg=="")echo "1";
 			die();
 		}

 		//重设密码页面
 		public function repwd()
 		{
 			$this->_globals();
 			$this->result["rs"] = $this->mCustomer->getUserBymEmail($_GET["email"]);
 			if(!$this->result["rs"])
 			{
 				$this->result["error"] = "错误链接";
 			}
 			$this->result["sites"]["pagetitle"] = "找回密码";
 			$this->tplname = 'forgetpwd';
 		}

 	    private function _globals()
 		{
 			$this->loadModel(array("Customer"));
 		}
 	}
?>