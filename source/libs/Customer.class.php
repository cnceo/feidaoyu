<?php
	class Customers
	{
		public $mDb;
		public $mLog;

		public function __construct()
		{
			//$this->mDb->debug = true;
		}

		public function checkUname($username)
		{
			$sql = "SELECT reguwords FROM ".get_table("sites")." WHERE id=1";
			$reguwords = $this->mDb->getone($sql);
			if($reguwords)
			{
				/*if(in_array($username,explode("|",$reguwords)))
				{
					return "error";
				}*/
				$reguwords = explode("|",$reguwords);
				foreach ($reguwords as $val)
				{
					if(strstr($username,$val)!=false)return "error";
				}
				$sql = "SELECT * FROM ".get_table("customers")." WHERE username='$username'";
				$rs = $this->mDb->getone($sql);
				return $rs;
		}

		}

		public function checkField($field,$value,$uid)
		{
			$sql = "SELECT * FROM ".get_table("customers")." WHERE $field='$value'";
			if($uid)$sql .= " AND id!='$uid'";
			$rs = $this->mDb->getone($sql);
			return $rs;
		}

		public function getList()
		{
			$sql = "SELECT * FROM ".get_table("customers");
			if($_GET["username"]) $sqlv[] = " (username LIKE '%".$_GET["username"]."%' OR truename LIKE '%".$_GET["username"]."%' OR nickname LIKE '%".$_GET["username"]."%') ";
			if($_GET["mobile"]) $sqlv[] = " mobile LIKE '".$_GET["mobile"]."%' ";
			if($_GET["email"]) $sqlv[] = " email LIKE '".$_GET["email"]."%' ";
			if($_GET["customer_group_id"]) $sqlv[] = " customer_group_id = '".$_GET["customer_group_id"]."' ";
			if($_GET["status"] || $_GET["status"]=='0') $sqlv[] = " status = '".$_GET["status"]."' ";
			if($sqlv)$sql .=" WHERE ".implode("AND",$sqlv);
			$sql .="  ORDER BY id DESC";
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

		public function getNewUser($limit=9)
 		{
 			$sql = "SELECT * FROM ".get_table("customers")." ORDER BY id DESC LIMIT ".$limit;
 			$rs = $this->mDb->getAll($sql);
 			if($rs)
 			{
 				foreach ($rs as $key=>$val)
 				{
 					$rs[$key]["expiration"] = diffDate($val["date_added"],date("Y-m-d H:i:s"));
 				}
 			}
 			return $rs;
 		}

		public function Batch()
	  	{
	  		$i=0;
	  		while ($i<count($_POST["selected"]))
	  		{
	  			if($_POST["more"]=="0")
	  			{
	  				$sql = "DELETE FROM ".get_table("customers")." WHERE id=".$_POST["selected"][$i];
	  			}
	  			else
	  			{
	  				$sql = "UPDATE ".get_table("customers")." SET customer_group_id='".$_POST["class_id"]."' WHERE id=".$_POST["selected"][$i];
	  			}
	  			$rs = $this->mDb->execute($sql);
	  			$i++;
	  		}
	  	}

		public function savePost()
		{
			foreach ($_POST as $key =>$val)
				{
					if(!in_array($key,array("id","checkcode","repasswd","checkbox")))
					{
						if($key=="password")
						{
							if($val) $sqlv[] = " $key = '".md5($val)."'";
						}
						else
						{
							$sqlv[] = " $key = '".sb_addslashes($val)."'";
						}
					}
				}
			if(!$_POST["id"])
			{
				$sql = "INSERT INTO ".get_table("customers")." SET ".implode(",",$sqlv);

			}
			else
			{
				$sql = "UPDATE ".get_table("customers")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			return $rs;
 		}

 		public function checkLogin()
 		{
 			$sql = "SELECT * FROM ".get_table("customers")." WHERE (username='".$_POST["username"]."' OR email='".$_POST["username"]."' OR mobile='".$_POST["username"]."') AND password='".md5($_POST["password"])."'";
 			$rs = $this->mDb->getRow($sql);
 			return $rs;
 		}

 		public function upHits($uid)
 		{
 			$sql = "UPDATE ".get_table("customers")." SET hits=hits+1,date_last='".date("Y-m-d H:i:s")."' WHERE id=$uid";
 			$this->mDb->execute($sql);
 		}

 		public function getRow($uid)
 		{
 			$sql = "SELECT * FROM ".get_table("customers")." WHERE id=".$uid;
 			return  $this->mDb->getRow($sql);
 		}

 		public function getUserByEmail($email)
 		{
 			$sql = "SELECT * FROM ".get_table("customers")." WHERE email='$email'";
 			return  $this->mDb->getRow($sql);
 		}

 		public function getUserBymEmail($email)
 		{
 			$sql = "SELECT * FROM ".get_table("customers")." WHERE mdemail='$email'";
 			return  $this->mDb->getRow($sql);
 		}

 		public function getEmailById($id)
 		{
 			$sql = "SELECT email FROM ".get_table("customers")." WHERE id='$id'";
 			return  $this->mDb->getone($sql);
 		}

 		public function getUserByUname($username)
 		{
 			$sql = "SELECT * FROM ".get_table("customers")." WHERE username='$username'";
 			return  $this->mDb->getRow($sql);
 		}


 		public function Del($uid)
 		{
 			$sql = "DELETE  FROM ".get_table("customers")." WHERE id=".$uid;
 			return  $this->mDb->execute($sql);
 		}

 		public function GroupDel($id)
 		{
 			$sql = "DELETE  FROM ".get_table("customergourp")." WHERE id=".$id;
 			return  $this->mDb->execute($sql);
 		}

 		public function verifyPassword($uid,$password)
		{
			$rs = $this->mDb->getone("SELECT id FROM ".get_table("customers")." WHERE id=$uid AND password='".md5($password)."'");
			if($rs)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

 		public function getGroupRow($id)
 		{
 			$sql = "SELECT * FROM ".get_table("customergourp")." WHERE id=".$id;
 			return  $this->mDb->getRow($sql);
 		}

 		public function getGroupList()
 		{
 			$sql = "SELECT * FROM ".get_table("customergourp");
 			return  $this->mDb->getAll($sql);
 		}

 		public function saveGroupPost()
		{
			foreach ($_POST as $key =>$val)
				{
					if($key!="id")
					{
						$sqlv[] = " $key = '".sb_addslashes($val)."'";
					}
				}
			if(!$_POST["id"])
			{
				$sql = "INSERT INTO ".get_table("customergourp")." SET ".implode(",",$sqlv);

			}
			else
			{
				$sql = "UPDATE ".get_table("customergourp")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			return $rs;
 		}

 		public function getGroupDropList($type=null)
		{
			$sql = "SELECT * FROM ".get_table("customergourp");
			$rs = $this->mDb->getall($sql);
			if(!empty($type))
			{
				$cate = array();
				foreach ($rs as $val)
					{
						$cate[$val["id"]] = $val["cname"];
					}
				$rs = $cate;
			}
			return $rs;
		}

		public function getGroupName($id)
		{
			$sql = "SELECT cname FROM ".get_table("customergourp")." WHERE id=$id";
			return $this->mDb->getone($sql);
		}

	   public function updateAddress($address_id,$uid)
	   {
	   		$sql = "UPDATE ".get_table("customers")." SET address_id='$address_id' WHERE id=".$uid;
	   		$this->mDb->execute($sql);
	   }

	   public function saveFavorite($uid,$pid)
	   {
	   		$sql = "INSERT INTO ".get_table("favorites")." SET uid='$uid',pid='$pid'";
	   		return $this->mDb->execute($sql);
	   }

      public function delFavorite($uid,$id)
	   {
	   		$sql = "DELETE FROM ".get_table("favorites")." WHERE uid=$uid AND pid=$id";
	   		$rs = $this->mDb->execute($sql);
	   		return $rs;
	   }

	   public function getFavorite($uid,$limit=10)
	   {
	   		$sql = "SELECT t2.*  FROM ".get_table("favorites")." t1, ".get_table("products")." t2 WHERE t1.uid='$uid' AND t1.pid=t2.id ORDER BY t1.createtime DESC LIMIT $limit";
	   		return $this->mDb->getall($sql);
	   }

	   public function getFavoriteList($uid)
		{
			$sql = "SELECT t2.*,t1.createtime  FROM ".get_table("favorites")." t1, ".get_table("products")." t2 WHERE t1.uid='$uid' AND t1.pid=t2.id ORDER BY t1.createtime DESC";
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

	 public function forgetPasswd()
	{
		$rs = $this->getUserByEmail($_POST["email"]);
		if($rs)
		{
			$_POST["reset"] = random();
			$_POST["id"] = $rs["id"];
			$this->savePost();
			$url = "http://shop.mpets.com.cn/cn/user/forgetpassword.html&a=reset&username=".$rs["username"]."&key=".createKey($rs["id"].$rs["username"].$_POST["reset"]);
			$subject   = "=?UTF-8?B?".base64_encode('百万宝贝会员重置密码')."?=";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers .= "To: ".$rs['email']."\r\n";
			$headers .= "From: no-rely@mpets.com.cn<no-rely@mpets.com.cn>\r\n";
			list($msec, $sec) = explode(" ", microtime());
			$headers .= "Message-ID: <".date("YmdHis", $sec).".".($msec*1000000).".".$mail_from.">\r\n";

			$body = "请点击下面链接重置密码<br/>\r\n";
			$body .= $url."<br/>\r\n";
			$body .= "百万宝贝 ".date("Y-m-d")."\r\n";
			$email = @mail($to, $subject, $body,$headers);
			if($email===true)
			{
				$msg["status"] = "false";
				$msg["message"] = "邮件发送成功，请注意查收";

			}
			else
			{
				$msg["status"] = "false";
			    $msg["message"] = "邮件发送失败，请重试一次";
			}
		}
		else
		{
			$msg["status"] = "false";
			$msg["message"] = "错误的邮箱地址";

		}
		return $msg;
	}

	public function sendPoint($cid,$point,$title,$content,$uid,$act="+")
	{
		$sql = "INSERT INTO ".get_table("points")." SET uid='$uid',cid='$cid',point='$act$point',title='$title',content='$content'";
		$this->mDb->execute($sql);
		$sql = "UPDATE ".get_table("customers")." SET points=points$act$point WHERE id=$cid";
		$this->mDb->execute($sql);
	}

	public function getPointList($uid)
	{
		$sql = "SELECT *  FROM ".get_table("points")." WHERE cid='$uid' ORDER BY id DESC";
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

	public function dropList($keyword,$type)
	{
		$sql = "SELECT * FROM ".get_table("customers");
		if($keyword)
		{
			$sql .= " WHERE (truename LIKE '%$keyword%'	OR username LIKE '%$keyword%' OR nickname LIKE '%$keyword%')";
		}
		$rs = $this->mDb->getall($sql);
		if(!empty($type))
		{
			$drop = array();
			foreach ($rs as $val)
				{
					$drop[$val["id"]] = $val["truename"]."(".$val["username"].")";
				}
			$rs = $drop;
		}
		return $rs;
	}

	public function doUpdate($id,$array,$table='product_sn'){
	$sqlv = "";
	foreach($array as $k => $v){
	if($k=="password"){$v=md5($v);}
	 $sqlv[]= $k."='".$v."'";
	}
	$sql = "UPDATE ".get_table($table)." SET ".implode(",",$sqlv)." WHERE id='$id'";
	$rs = $this->mDb->execute($sql);
	return $rs;
	}

	public function checkOldpass($id,$oldpass)
	{
		$sql = "SELECT * FROM ".get_table("customers")." WHERE id = '".$id."' AND password='".md5($oldpass)."'";
		$rs = $this->mDb->getRow($sql);
		return $rs;
	}

	public function getComments($category,$uid,$pid)
	{
		$sql = "SELECT *  FROM ".get_table("comments");
		if($category) $sqlv[] = " category='$category'";
		if($uid) $sqlv[] = " uid='$uid'";
		if($pid) $sqlv[] = " pid='$pid'";
		if(is_array($sqlv)) $sql .= " WHERE ".implode(" AND ",$sqlv);
		$sql .= " ORDER BY id DESC";
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


	public function getFilebyUid($uid,$isimage=1)
	{
		$sql = "SELECT * FROM  ".get_table("attachments")." WHERE pid=0 and isimage=$isimage";
		$pager    = new Page;
		$get_page = is_numeric($_GET["page"]) ? $get_page : 1;
  		$pagesize = $_GET["pagesize"] ? $_GET["pagesize"] : 24;
		$pager->Page($key='', $pagesize, $groupsize=0, $current=$get_page);
		$pager->execute($this->mDb,$sql);
		$pages['link']  = $pager->pageLinks();
		$pages['frontlink']  = $pager->searchlinks();
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


}
?>