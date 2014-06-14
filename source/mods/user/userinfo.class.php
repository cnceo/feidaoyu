<?php
 	class userinfo extends Controller
 	{
 		public function defshow()
 		{

 			$this->_globals();

			$this->result["log"] = $this->mCustomer->getRow($_SESSION["login_user"]["id"]);
			$this->result["genderlist"] = array(0=>"女",1=>"男");
			$this->result["yearlist"] = getNumList(1950,2013);
			$this->result["monthlist"] = getNumList(1,13);
			$this->result["daylist"] = getNumList(1,32);

			$this->result["sites"]["pagetitle"] = "会员中心";
			$this->tplname = "userinfo";
 		}

 		public function update()
 		{
 			$this->_globals();
 			$_POST["id"] = $_SESSION["login_user"]["id"];

 			if($_POST["password"])
 			{
 				$r=$this->mCustomer->getRow($_SESSION["login_user"]["id"]);
 				if($r["password"]==md5($_POST["password"]))
 				{
 					$rs = $this->mCustomer->savePost();
 				}
 				else
 				{
 					$msg["status"] = "false";
 					$msg["message"] = "原有密码输入错误";
 				}
 			}
 			else
 			$rs = $this->mCustomer->savePost();

 			if($rs)
 			{
 				$msg["status"] = "true";
 				$msg["truename"] = $_POST["truename"];
 				///第一次更新基本信息,派送积分
 				$_SESSION["login_user"] = $this->mCustomer->getRow($_SESSION["login_user"]["id"]);
 				//if($_POST["uflag"])$this->mCustomer->sendPoint($_SESSION["login_user"]["id"],$this->result["sites"]["upc_point"],"更新个人信息","系统自动派送","+",$_SESSION["login_user"]["id"]);


 				//$this->mTpl->clear_all_cache();//情况缓存
 				//system("rm -rf ".TPL_PATH . "/compile/");


 			}
 			else
 			{
 				$msg["status"] = "false";
 				$msg["message"] = "保存错误，请联系管理员";

 			}
 			echo json_encode($msg);
 			die();
 		}

 		public function password()
 		{

 			$this->_globals();

 			$this->result["log"] = $this->mCustomer->getRow($_SESSION["login_user"]["id"]);

 			$this->result["sites"]["pagetitle"] = "会员中心--".$this->result["sites"]["sitename"];
 			$this->tplname = "password";
 		}

 		public function avatar()
 		{

 			$this->_globals();

 			$this->result["log"] = $this->mCustomer->getRow($_SESSION["login_user"]["id"]);

 			$this->result["sites"]["pagetitle"] = "会员中心--".$this->result["sites"]["sitename"];
 			$this->tplname = "avatar";
 		}

 		public function citylist()
 		{
 			$this->_globals();
 			$rs = $this->mBasic->getCateListByID("parameters2",$_GET["pid"]);
 			$str = "<option value=\"\">请选择城市</option>";
 			foreach ($rs as $val)
 			{
 				$str .="<option value=\"".$val["id"]."\">".$val["name"]."</option>";
 			}
 			//$this->result["log"]=$val["name"]
 			echo $str;
 			die();
 		}

 		public function countylist()
 		{
 			$this->_globals();
 			$rs = $this->mBasic->getCateListByID("parameters2",$_GET["pid"]);
 			$str = "<option value=\"\">请选择区县</option>";
 			foreach ($rs as $val)
 			{
 				$str .="<option value=\"".$val["id"]."\">".$val["name"]."</option>";
 			}
 			echo $str;
 			die();
 		}

 		private function _globals()
 		{
 			$this->checkUserLogin();
 			$this->loadModel(array("Basic","User","Customer"));
 		}
 	}
?>