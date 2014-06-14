<?php
	class Goods
	{
		public $mDb;
		public $mLang;
		
		public function getList($classid,$t,$lang,$size=30)
	  	{
	  		if($_GET["auditing"])$t=$_GET["auditing"];
	  		$sql = "SELECT * FROM ".get_table("goods")." ORDER BY id DESC";
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
	  	
	  	public function getCateArticeList($id,$cate,$desc="addtime",$lang,$limit=12,$t=0)
	  	{
	  		$sql = " SELECT t1. * , t2.admin AS username,t3.catename,t3.unikey  FROM goods t1,admins t2,cates t3 WHERE t1.uid=t2.id AND t1.classid=t3.id AND t3.unikey='$cate' AND t1.addtime!=$id";
			$sql .= " AND t1.flag=$t  AND t1.lang='$lang' ORDER BY t1.$desc DESC limit ".$limit;
			$rs  = $this->mDb->getall($sql);
			return $rs;
	  	}

		public function getNaviList($classid,$limit=50,$lang,$desc="DESC",$order="addtime",$t=0)
	  	{
	  		$sql = " SELECT t1. * , t2.admin AS username,t3.catename,t3.unikey  FROM goods t1,admins t2,cates t3 WHERE t1.uid=t2.id AND t1.classid=t3.id ";
			if(!empty($classid))
			{
				$sql .="  AND t1.classid IN (".$classid.")";
			}
			$sql .= "  AND t1.flag=$t AND t1.lang='$lang' ORDER BY t1.$order $desc limit ".$limit;
			$rs  = $this->mDb->getall($sql);
			return $rs;
	  	}
	  	
	  	public function getTopList($classid,$limit=50,$lang,$status,$desc="DESC",$order="addtime",$t=0)
	  	{
	  		$sql = " SELECT t1. * , t2.admin AS username,t3.catename,t3.unikey  FROM goods t1,admins t2,cates t3 WHERE t1.uid=t2.id AND t1.classid=t3.id ";
			if(!empty($classid))
			{
				$sql .="  AND t1.classid IN (".$classid.")";
			}
			$sql .= "  AND t1.flag=$t AND t1.status='$status' AND t1.lang='$lang' ORDER BY t1.$order $desc limit ".$limit;
			$rs  = $this->mDb->getall($sql);
			return $rs;
	  	}
	  	
	  	public function getPicNewList($classid,$limit=50,$desc="addtime",$t=0)
	  	{
	  		$sql = " SELECT t1. *,t3.catename,t3.unikey  FROM goods t1,cates t3 WHERE  t1.classid=t3.id AND t1.picurl<>''";
			if(!empty($classid))
			{
				$sql .="  AND t1.classid IN (".$classid.")";
			}
			$sql .= "  AND t1.flag=$t  ORDER BY t1.$desc DESC limit ".$limit;
			$rs  = $this->mDb->getall($sql);
			return $rs;
	  	}
	  	
	  	public function getRow($id)
	  	{
	  		$sql = "SELECT t1. *,t3.catename,t3.ename,t3.unikey,t3.pid  FROM goods t1,cates t3 WHERE t1.classid=t3.id AND t1.addtime=".$id;
	  		$rs = $this->mDb->getrow($sql);
	  		return $rs;
	  	}

		public function getRowBycate($id,$lang,$desc=" DESC ")
	  	{
	  		$sql = " SELECT t1. * , t2.admin AS username,t3.catename,t3.unikey,t3.pid  FROM goods t1,admins t2,cates t3 WHERE t1.uid=t2.id AND t1.classid=t3.id AND t1.classid=".$id." AND lang='$lang' ORDER BY t1.sequence $desc";
	  		$rs = $this->mDb->getrow($sql);
	  		return $rs;
	  	}

		public function Save()
		{
			$_POST["content"] = str_replace(array("\"../images/","\"images/","'"),array("\"/images/","\"/images/","???"),$_POST["content"]);
			if(empty($_POST["id"]))
	 		{
	 			if(is_array($_POST["classids"]))
	 			{
	 				$i = 0;
	 				foreach($_POST["classids"] as $key => $val)
			 		{
		 				if($_POST["classids"][$key]!="")
		 				{
		 					$fields .=",classid".$i;
		 					$values .= ",'".$val."'";
		 					$i++;
		 				}
			 		}
	 			}
	 			$sql = "INSERT into goods(title,subhead,lang,uid,classid$fields,source,author,picurl,keywords,description,content,addtime,hits,tid,ttype,flag)VALUES('".$_POST["title"]."','".$_POST["subhead"]."','".$_POST["lang"]."','".$_SESSION["login_admin"]["id"]."','".$_POST["classid"]."'$values,'".$_POST["source"]."','".$_POST["author"]."','".$_POST["picurl"]."','".$_POST["keywords"]."','".$_POST["description"]."','".$_POST["content"]."','".time()."','".$_POST["hits"]."','".$_POST["tid"]."','".$_POST["ttype"]."','".$_POST["flag"]."')";
	 		}
	 		else
	 		{
	 			if(is_array($_POST["classids"]))
	 			{
	 				$i = 0;
	 				foreach($_POST["classids"] as $key => $val)
			 		{
		 				if($_POST["classids"][$key]!="")
		 				{
		 					$query .=",classid".$i."='".$val."'";
		 					$i++;
		 				}
		 				else
		 				{
		 					$query .=",classid".(3-$i)."='".$val."'";
		 				}
			 		}
	 			}
	 			$sql = "UPDATE goods SET title='".$_POST["title"]."',subhead='".$_POST["subhead"]."',lang='".$_POST["lang"]."',uid='".$_SESSION["login_admin"]["id"]."',classid='".$_POST["classid"]."'$query,source='".$_POST["source"]."',author='".$_POST["author"]."',picurl='".$_POST["picurl"]."',keywords='".$_POST["keywords"]."',description='".$_POST["description"]."',content='".$_POST["content"]."',hits='".$_POST["hits"]."',tid='".$_POST["tid"]."',ttype='".$_POST["ttype"]."',flag='".$_POST["flag"]."' WHERE id=".$_POST["id"];
	 		}
			//echo $sql;
	 		$rs = $this->mDb->execute($sql);
	 		return $rs;
		}
		
		public function saveUpdate()
		{
			if(is_array($_POST["seque"]["cate"]))
			{
				foreach($_POST["seque"]["cate"] as $key => $val)
		 		{
	 				if($val=="")$val=0;
	 				$sql = "UPDATE cates SET sequence='".$val."' WHERE id = $key";
		 			$this->mDb->execute($sql);
		 		}
			}
			if(is_array($_POST["seque"]["cont"]))
			{
				foreach($_POST["seque"]["cont"] as $key => $val)
		 		{
	 				if($val=="")$val=0;
 					$sql = "UPDATE goods SET sequence='".$val."' WHERE id = $key";
	 				$this->mDb->execute($sql);
		 		}
			}
		}
		
		public function Upflag()
		{
			if($_GET["action"]=="active")
	 		{
	 			$sql = "UPDATE goods SET flag=0 WHERE addtime=".$_POST["id"];
	 		}
	 		else
	 		{
	 			$sql = "UPDATE goods SET flag=1 WHERE addtime=".$_POST["id"];
	
	 		}
			//echo $sql;
	 		$rs = $this->mDb->execute($sql);
	 		return $rs;
		}
		
		public function UpStatus()
		{
			if($_GET["action"]=="topnew")
	 		{
	 			$sql = "UPDATE goods SET status='1' WHERE addtime=".$_POST["id"];
	 		}
	 		else
	 		{
	 			$sql = "UPDATE goods SET status='0' WHERE addtime=".$_POST["id"];
	
	 		}
			//echo $sql;
	 		$rs = $this->mDb->execute($sql);
	 		return $rs;
		}
	  	
	  	public function Del($id)
	  	{
	  		$sql = "DELETE FROM goods WHERE addtime=".$id;
	  		$rs = $this->mDb->execute($sql);
	  		if(!$rs)
			 {
			 	return false;
			 }
			 else
			 {
			 	return true;
			 }
	  	}
	  	
	  	public function Batch()
	  	{
	  		$i=0;
	  		while ($i<count($_POST["id"]))
	  		{
	  			if($_POST["more"]=="0")
	  			{
	  				$sql = "DELETE FROM goods WHERE id=".$_POST["id"][$i];
	  			}
	  			else
	  			{
	  				$sql = "UPDATE goods SET classid='".$_POST["classid"]."' WHERE id=".$_POST["id"][$i];
	  			}
	  			$rs = $this->mDb->execute($sql);
	  			$i++;
	  		}
	  	}

		public function getCate($key)
		{
			$sql = "SELECT * FROM cates WHERE unikey='$key'";
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}
		
		public function Hits($id)
		{
			$sql = "UPDATE goods SET hits=hits+1 WHERE id=$id";
	 		$rs = $this->mDb->execute($sql);
		}
	}
?>