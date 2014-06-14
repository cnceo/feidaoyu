<?php
	class Users
	{
		public $mDb;
		public $mLog;

		public function __construct()
		{
			//$this->mDb->debug = true;
		}

		public function getList()
		{
			$sql = "SELECT * FROM ".get_table("admins");
			$pager    = new Page;
			$get_page = is_numeric($_GET["page"]) ? $get_page : 1;
	  		$pagesize = $_GET["pagesize"] ? $_GET["pagesize"] : _PAGES;
			$pager->Page($key='', $pagesize, $groupsize=0, $current=$get_page);
			$pager->execute($this->mDb,$sql);
			$pages['link']  = $pager->pageLinks();
			$pages['fromto']  = $pager->fromto();
			$pages['total'] = $pager->getTotalpage();
			$pages['current'] = $pager->getCurrent();
			$pages['totalnum'] = $pager->getTotalnum();
			$pages['jump'] = $pager->jump();
			$pages['pagenum'] = $pagesize;
			$rs  = $pager->getResult();
			$r["logs"] = $rs;
			$r["pages"] = $pages;
			return $r;
		}

		public function adminCheck()
		{
			$msg["status"] = "false";
			$sql = "SELECT * FROM ".get_table("admins")." WHERE admin='".$_POST["username"]."'";
			$rs = $this->mDb->getrow($sql);
			if(empty($rs))
			{
				$msg["message"] = "用户名不存在";
			}
			elseif ($rs['password']!=$_POST["password"])
			{
				$msg["message"] = "用户名和密码不匹配";
				$_SESSION["pw_error"] = $_SESSION["pw_error"] +1;
				if($_SESSION["pw_error"]>=3)
				{
					$msg["message"] = "连续输入密码超过3次，帐户被锁定，请联系管理员";
					$this->lockUser($_POST["username"]);
				}
				$this->mLog->adminLog("登陆失败，密码错误");
			}
			elseif ($rs['status']=="1")
			{
				$msg["message"] = "帐户被锁定，请联系管理员";
			}
			else
			{
				unset($_SESSION["pw_error"]);
				unset($_SESSION["fromurl"]);
				$_SESSION["login_admin"] = $rs;
				$msg["status"] = "true";
				$msg["message"] = "登陆成功";
				$this->login($rs["id"]);
				$this->mLog->adminLog("登录成功");
			}
			return $msg;
		}

		private function lockUser($user)
		{
			$sql = "UPDATE ".get_table("admins")." SET status='1' WHERE admin='$user'";
			$this->mLog->adminLog("密码错误次数太多，账户被锁定");
			$this->mDb->execute($sql);
		}

		public function checkPasswd($table,$id,$passwd)
		{
			$sql = "SELECT * FROM $table WHERE id=$id and password ='".md5($passwd)."'";
			$rs = $this->mDb->getrow($sql);
			if(!empty($rs))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function getRow($id)
		{
			$sql = "SELECT * FROM ".get_table("admins")." WHERE id=$id";
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		private function checkName($table,$uname)
		{
			if ($table=="admins")
			{
				$sql = "SELECT *  FROM $table  WHERE admin='$uname'";
			}
			else
			{
				$sql = "SELECT id FROM $table  WHERE username='$uname'";
			}
			$id = $this->mDb->getone($sql);
			if($id)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function Del($id)
		{
			$sql = "DELETE FROM ".get_table("admins")." WHERE id=$id";
			$rs = $this->mDb->execute($sql);
			return $rs;
		}

		public function getSn($table)
		{
			$id = $this->mDb->getone("SELECT max(id) FROM $table");
			$sn = formatNumber($id+1,3);
			return $sn;
		}

		private function login($id)
		{
			$sql = "UPDATE ".get_table("admins")."  SET hits=hits+1 WHERE id=$id";
			$this->mDb->execute($sql);
		}

		public function Upflag()
		{
			if($_GET["action"]=="active")
	 		{
	 			$sql = "UPDATE ".get_table("admins")."  SET status=0 WHERE id=".$_POST["id"];
	 		}
	 		else
	 		{
	 			$sql = "UPDATE ".get_table("admins")."  SET status=1 WHERE id=".$_POST["id"];

	 		}
			//echo $sql;
	 		$rs = $this->mDb->execute($sql);
	 		return $rs;
		}

		public function savePost()
		{
			foreach ($_POST as $key =>$val)
				{
					if(!in_array($key,array("id","password")))
					{
						$sqlv[] = " $key = '".sb_addslashes($val)."'";
					}
				}
			if($_POST["password"])
			{
				$sqlv[] = " password = '".md5($_POST["password"])."'";
			}
			if(!$_POST["id"])
			{
				$sql = "INSERT INTO ".get_table("admins")." SET ".implode(",",$sqlv);

			}
			else
			{
				$sql = "UPDATE ".get_table("admins")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			return $rs;
 		}

 		public function verifyPassword($uid,$password)
		{
			$rs = $this->mDb->getone("SELECT id FROM ".get_table("admins")." WHERE id=$uid AND password='".md5($password)."'");
			if($rs)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
?>