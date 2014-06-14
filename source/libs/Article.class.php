<?php
	class Articles
	{
		public $mDb;
		public $mLang;

		public function cateList($blank,$pid=0)
		{
			//$str = "";
			$blank = "&nbsp; &nbsp;".$blank;
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE pid=$pid ORDER BY sequence DESC";
			$rs = $this->mDb->getall($sql);
			foreach ($rs as $vul)
			{
				$str .= " <tr><td class=\"left\">".$blank."|-<img src=\"";
				if($vul["childnum"]>0)
				{
					$str .= "./images/plus.gif\"";
				}else
				{
					$str .= "./images/minus.gif\"";
				}
				$str .= ">&nbsp;<a href='?m=".encrypt("article")."&cateid=".$vul["id"]."'>".$vul["cname"]."</a></td>
		   		<td>".$vul["ename"]."</td>
		   		<td>".$blank."<input name=\"seque[".$vul["id"]."]\" value=\"0\" size=\"2\"></td>
	         	<td><a href=\"#\" onclick=\"Add('".$vul["id"]."');\"  alt=\"Save\"> 修改 </a>
					 |
					<a href=\"#\" onclick=\"Del('".$vul["id"]."');\"> 删除 </a>
					 |
					<a href=\"#\" onclick=\"Add();\"> 新加 </a>
					 |
					<a href=\"#\" onclick=\"subAdd('".$vul["id"]."');\"> 新加子类 </a></td>
	       		 </tr>";
				if($vul["childnum"]>0)
				{
					$str .= $this->cateList($blank,$vul["id"]);
				}
			}
			return $str;
		}

		public function cateLists($blank,$pid=0)
		{
			//$str = "";
			$blank = "&nbsp; &nbsp;".$blank;
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE pid=$pid ORDER BY sequence DESC";
			$rs = $this->mDb->getall($sql);
			foreach ($rs as $vul)
			{
				$str .= " <tr><td class=\"left\">".$blank."|-<img src=\"";
				if($vul["childnum"]>0)
				{
					$str .= "./images/plus.gif\"";
				}else
				{
					$str .= "./images/minus.gif\"";
				}
				$str .= ">&nbsp;<a href='?m=".encrypt("down")."&cateid=".$vul["id"]."'>".$vul["cname"]."</a></td>
	         	<td align='center'><a href='?m=".encrypt("down")."&cateid=".$vul["id"]."'> 查看 </a></td>
	       		 </tr>";
				if($vul["childnum"]>0)
				{
					$str .= $this->cateLists($blank,$vul["id"]);
				}
			}
			return $str;
		}

		public function getPidList($pid=0)
		{
			if(empty($pid))$pid=0;
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE pid=$pid ORDER BY sequence DESC";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function cateDropList($sid=0,$pid=0,$blank)
		{
			//$str = "";
			$blank = "&nbsp;&nbsp;".$blank;
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE pid=$pid ORDER BY sequence DESC";
			$rs = $this->mDb->getall($sql);
			//if($pid==0) $str .= "<option value=\"0\">|根</option>";
			foreach ($rs as $vul)
			{
				$str .= "<option ";
				if($sid == $vul["id"])
				{
					$str .= " selected ";
				}
				$str .= "value=\"".$vul["id"]."\">".$blank."|-".$vul["cname"]."</option>";
				if($vul["childnum"]>0)
				{
					$str .= $this->cateDropList($sid,$vul["id"],$blank);
				}
			}
			return $str;
		}

		public function getTwoNavList($ids)
		{
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE id IN($ids) ORDER BY sequence DESC";
			$rs = $this->mDb->getall($sql);
			foreach ($rs as $key=>$val)
			{
				$sql = "SELECT * FROM ".get_table("articles")." WHERE class_id=".$val["id"]." AND status=1 ORDER BY addtime DESC";
				$rs[$key]["articlelist"] = $this->mDb->getall($sql);
			}
			return $rs;
		}

		public function getCateList($pid=0,$type=null)
		{
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE pid=$pid";
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


		public function getNavCateList($pid=0)
		{
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE pid=$pid";
			$rs = $this->mDb->getall($sql);

			foreach ($rs as $key =>$val)
				{
					$pos = array("/"," ","%","'",",",".","\"");
					$rs[$key]["urlkey"] = str_replace($pos,"-",$val["ename"]);
				}
			return $rs;
		}


		public function getAllNavCateList($pid=0)
		{
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE pid=$pid";
			$rs = $this->mDb->getall($sql);

			foreach ($rs as $key =>$val)
				{
					$pos = array("/"," ","%","'",",",".","\"");
					$rs[$key]["urlkey"] = str_replace($pos,"-",$val["ename"]);
					if($val["childnum"]>0)
					{
						$rs[$key]["child"] = $this->getAllNavCateList($val["id"]);
					}
				}
			return $rs;
		}

		public function getCateChildId($pid=0)
		{
			$child_id = array();
			$child_id[] = $pid;
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE pid=$pid";
			$rs = $this->mDb->getall($sql);

			foreach ($rs as $key =>$val)
				{
					$child_id[] = $val["id"];
					if($val["childnum"]>0)
					{
						$child_id = array_unique(array_merge($child_id,$this->getCateChildId($val["id"])));
					}
				}
			return $child_id;
		}

		public function getChildNavCateList($pid)
		{
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE pid=$pid";
			$rs = $this->mDb->getall($sql);

			foreach ($rs as $key =>$val)
				{
					$pos = array("/"," ","%","'",",",".","\"");
					$rs[$key]["urlkey"] = str_replace($pos,"-",$val["ename"]);
					if($val["childnum"]>0)
					{
						$rs[$key]["child"] = $this->getChildNavCateList($val["id"]);
					}
				}
			return $rs;
		}


		public function saveCatePost()
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
				$sql = "INSERT INTO ".get_table("art_cates")." SET ".implode(",",$sqlv);

			}
			else
			{
				$sql = "UPDATE ".get_table("art_cates")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			if($_POST["pid"]!=0)
			{
				$this->upCateChildNum($_POST["pid"],"+1");
			}
			return $rs;
 		}

		public function cateDel($id)
		{
			$rs = $this->mDb->execute("DELETE FROM ".get_table("art_cates")." WHERE id=".$id);
			if(!$rs)
			{
				return false;
			}
			else
			{
				return true;
			}
		}

		public function getCateRow($id)
		{
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE id=".$id;
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		public function getCateRowByName($value,$field="ename")
		{
			$sql = "SELECT * FROM ".get_table("art_cates")." WHERE $field='$value'";
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		public function getCateName($id,$field="ename")
		{
			$sql = "SELECT $field FROM ".get_table("art_cates")." WHERE id=".$id;
			$rs = $this->mDb->getone($sql);
			return $rs;
		}

		public function upCateChildNum($id,$aciton)
		{
			$sql = "UPDATE ".get_table("art_cates")." SET childnum = childnum $aciton WHERE id=".$id;
			$this->mDb->execute($sql);
		}


		public function getList($cateid,$size=_PAGES)
		{
			$sql = "SELECT * FROM ".get_table("articles");
			if($_GET["title"]) $sqlv[] = " title LIKE '".$_GET["title"]."%' ";
			if($_GET["status"] || $_GET["status"]=='0') $sqlv[] = " status = '".$_GET["status"]."' ";
			if($cateid)
			{
				if(is_array($cateid))
			    {
			    	$cateid =  implode(",",$cateid);
			    }
			    $sqlv[] = " class_id IN ($cateid)";
			}
			if($sqlv)$sql .=" WHERE ".implode("AND",$sqlv);

			$sql .="  ORDER BY id DESC";
			$pager    = new Page;
			$get_page = is_numeric($_GET["page"]) ? $get_page : 1;
	  		$pagesize = $_GET["pagesize"] ? $_GET["pagesize"] : $size;
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


		public function getNavList($classid,$limit=50,$lang="cn",$desc="DESC",$order="addtime")
	  	{
	  		$sql = "SELECT t1.*,t2.ename as classname FROM ".get_table("articles")." t1, ".get_table("art_cates")." t2 WHERE t2.id=t1.class_id AND t1.class_id='".$classid."' AND t1.status='1' AND t1.lang='$lang' ORDER BY t1.$order $desc LIMIT ".$limit;
	  		//echo $sql;
	  		$rs  = $this->mDb->getall($sql);
			return $rs;
	  	}

	  	public function getCateArtList($classid,$lang="cn")
	  	{
	  		$sql = "SELECT * FROM ".get_table("articles")."  WHERE class_id='".$classid."' AND lang='$lang' ORDER BY addtime DESC ";
	  		$rs  = $this->mDb->getall($sql);
	  		$cate = array();
	  		foreach ($rs as $val)
			{
				$cate[$val["id"]] = $val["title"];
			}
			return $cate;
	  	}

	  	public function getNavListTotal($classid,$limit=50,$lang="cn",$desc="DESC",$order="addtime")
	  	{
	  		$sql = "SELECT count(*) FROM ".get_table("articles")." WHERE class_id='".$classid."' AND status='1' AND lang='$lang'";
	  		//echo $sql;
	  		$rs  = $this->mDb->getone($sql);
			return $rs;
	  	}



	  	public function getTopList($classid,$limit=50,$lang,$status,$desc="DESC",$order="addtime",$t=0)
	  	{
	  		$sql = " SELECT t1. * , t2.admin AS username,t3.catename,t3.unikey  FROM articles t1,admins t2,cates t3 WHERE t1.uid=t2.id AND t1.classid=t3.id ";
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
	  		$sql = " SELECT t1. *,t3.catename,t3.unikey  FROM articles t1,cates t3 WHERE  t1.classid=t3.id AND t1.picurl<>''";
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
	  		$sql = "SELECT *  FROM ".get_table("articles")." WHERE id=".$id;
	  		$rs = $this->mDb->getrow($sql);
	  		return $rs;
	  	}

		public function getRowCount($id)
	  	{
	  		$sql = "SELECT count(id) as id  FROM ".get_table("articles")." WHERE class_id=".$id;
	  		$rs = $this->mDb->getrow($sql);
	  		return $rs;
	  	}

		public function getRowCountUser($id,$uid)
	  	{
	  		$sql = "SELECT count(id) as id  FROM ".get_table("articles")." WHERE class_id=".$id." and status=1 and uid =".$uid;
	  		$rs = $this->mDb->getrow($sql);
	  		return $rs;
	  	}

	  	public function savePost()
		{
			foreach ($_POST as $key =>$val)
				{
					if(!in_array($key,array("id","aid")))
					{
						$sqlv[] = " $key = '".sb_addslashes($val)."'";
					}
				}
			if(!$_POST["id"])
			{
				$sql = "INSERT INTO ".get_table("articles")." SET ".implode(",",$sqlv).",addtime='".time()."'";

			}
			else
			{
				$sql = "UPDATE ".get_table("articles")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			return $rs;
 		}

		/*public function Save()
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
	 			$sql = "INSERT into articles(title,subhead,lang,uid,classid$fields,source,author,picurl,keywords,description,content,addtime,hits,tid,ttype,flag)VALUES('".$_POST["title"]."','".$_POST["subhead"]."','".$_POST["lang"]."','".$_SESSION["login_admin"]["id"]."','".$_POST["classid"]."'$values,'".$_POST["source"]."','".$_POST["author"]."','".$_POST["picurl"]."','".$_POST["keywords"]."','".$_POST["description"]."','".$_POST["content"]."','".time()."','".$_POST["hits"]."','".$_POST["tid"]."','".$_POST["ttype"]."','".$_POST["flag"]."')";
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
	 			$sql = "UPDATE articles SET title='".$_POST["title"]."',subhead='".$_POST["subhead"]."',lang='".$_POST["lang"]."',uid='".$_SESSION["login_admin"]["id"]."',classid='".$_POST["classid"]."'$query,source='".$_POST["source"]."',author='".$_POST["author"]."',picurl='".$_POST["picurl"]."',keywords='".$_POST["keywords"]."',description='".$_POST["description"]."',content='".$_POST["content"]."',hits='".$_POST["hits"]."',tid='".$_POST["tid"]."',ttype='".$_POST["ttype"]."',flag='".$_POST["flag"]."' WHERE id=".$_POST["id"];
	 		}
			//echo $sql;
	 		$rs = $this->mDb->execute($sql);
	 		return $rs;
		}*/

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
 					$sql = "UPDATE articles SET sequence='".$val."' WHERE id = $key";
	 				$this->mDb->execute($sql);
		 		}
			}
		}

		public function Upflag()
		{
			if($_GET["action"]=="active")
	 		{
	 			$sql = "UPDATE articles SET flag=0 WHERE addtime=".$_POST["id"];
	 		}
	 		else
	 		{
	 			$sql = "UPDATE articles SET flag=1 WHERE addtime=".$_POST["id"];

	 		}
			//echo $sql;
	 		$rs = $this->mDb->execute($sql);
	 		return $rs;
		}

		public function UpStatus()
		{
			if($_GET["action"]=="topnew")
	 		{
	 			$sql = "UPDATE articles SET status='1' WHERE addtime=".$_POST["id"];
	 		}
	 		else
	 		{
	 			$sql = "UPDATE articles SET status='0' WHERE addtime=".$_POST["id"];

	 		}
			//echo $sql;
	 		$rs = $this->mDb->execute($sql);
	 		return $rs;
		}

	  	public function Del($id)
	  	{
	  		$sql = "DELETE FROM ".get_table("articles")." WHERE id=".$id;
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
	  		while ($i<count($_POST["selected"]))
	  		{
	  			if($_POST["more"]=="0")
	  			{
	  				$sql = "DELETE FROM ".get_table("articles")." WHERE id=".$_POST["selected"][$i];
	  			}
	  			else
	  			{
	  				$sql = "UPDATE ".get_table("articles")." SET class_id='".$_POST["class_id"]."' WHERE id=".$_POST["selected"][$i];
	  			}
	  			$rs = $this->mDb->execute($sql);
	  			$i++;
	  		}
	  	}

		public function Hits($id)
		{
			$sql = "UPDATE ".get_table("articles")." SET hits=hits+1 WHERE id=$id";
	 		$rs = $this->mDb->execute($sql);
		}

		public function getStatusList()
		{
			return array(
							1 => "开放",
							0 => "关闭");
		}

		public function getlangList()
		{
			return array(
							"cn" => "中文");
		}


	}
?>