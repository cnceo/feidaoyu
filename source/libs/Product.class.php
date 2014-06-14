<?php
	class Products
	{
		public $mDb;

		public function __construct()
		{
			//$this->mDb->debug = true;
		}

		public function getList($cateid,$size=_PAGES)
		{
			$sql = "SELECT * FROM ".get_table("products");
			if($_GET["prodname"]) $sqlv[] = " cprodname LIKE '%".$_GET["prodname"]."%'";
			if($_GET["keyword"]) $sqlv[] = " (cprodname LIKE '%".$_GET["keyword"]."%' OR eprodname LIKE '%".$_GET["keyword"]."%' OR jprodname LIKE '%".$_GET["keyword"]."%') ";
			if($_GET["model"]) $sqlv[] = " model LIKE '%".$_GET["model"]."%' ";
			if($_GET["brand"])
			{
				$sqlv[] = " brand_id IN(SELECT id FROM ".get_table("brands")."  WHERE cname LIKE '%".$_GET["brand"]."%') ";
			}
			if($_GET["quantity"]) $sqlv[] = " quantity = '".$_GET["quantity"]."%' ";
			if($_GET["status"] || $_GET["status"]=='0') $sqlv[] = " status = '".$_GET["status"]."' ";
			if($_GET["is_best"] || $_GET["is_best"]=='0') $sqlv[] = " is_best = '".$_GET["is_best"]."' ";
			if($cateid)
			{
				if(is_array($cateid))
			    {
			    	$cateid =  implode(",",$cateid);
			    }
			    $sqlv[] = " class_id IN ($cateid)";
			}
			if($sqlv)$sql .=" WHERE ".implode("AND",$sqlv);

			switch ($_GET["order"])
			{
				case "2":
					$order = "price DESC";
					break;
				case "3":
					$order = "price ASC";
					break;
				case "4":
					$order = "hits DESC";
					break;
				case "5":
					$order = "starttime DESC";
					break;
			    default:
					$order = "id DESC";
			}
			$sql .="  ORDER BY $order";
			//echo $sql;
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

		public function getCateTotal($cateid)
		{
			$sql = "SELECT count(*) FROM ".get_table("products");
			if(is_array($cateid))
			    {
			    	$cateid =  implode(",",$cateid);
			    }
			    $sqlv[] = " class_id IN ($cateid)";
			$sql .=" WHERE ".implode("AND",$sqlv);
			$num = $this->mDb->getone($sql);
			return $num;
		}

		public function getParameterList ($size=_PAGES)
		{
			$sql = "SELECT * FROM ".get_table("parameters");
			if($_GET["name"]) $sqlv[] = " name LIKE '%".$_GET["name"]."%' ";
			if($sqlv)$sql .=" WHERE ".implode("AND",$sqlv);
			//$sql .="  ORDER BY $order";
			//echo $sql;
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


		public function getParameterListByCateID ($cateid,$selectd,$type=null)

		{
			$sql= "SELECT * FROM sb_categorys WHERE id=".$cateid;
			$rs = $this->mDb->getrow($sql);
			$id = $rs["parameters"].",".$rs["parameters1"].",".$rs["parameters2"];
			$id = explode(",",$id);
			$new_id = array();
			for($i=0;$i<count($id);$i++)
			{
				if($id[$i]>0)$new_id[] = $id[$i];
			}
			$sql = "SELECT DISTINCT t1.id FROM sb_parameters t1, sb_rules t2 WHERE t1.id = t2.kid AND t2.pid IN ( SELECT id FROM sb_products WHERE class_id =$cateid)";
			if($_GET["name"])
			{
				$sql .= " AND  t1.name LIKE '%".$_GET["name"]."%'";
			}
			$ids = $this->mDb->getall($sql);
			foreach ($ids as $val)
			{
				$new_id[] = $val["id"];
			}
			//print_r($new_id);
			//$sql .= ")";
			if(is_array($new_id))
			{
				$sql = " SELECT * FROM sb_parameters WHERE id IN (".implode(",",$new_id).")";
			}

				//echo $sql;
				$rs = $this->mDb->getall($sql);
				//print_r($rs);
				if($rs && !empty($type))
				{
					$cate = array();
					foreach ($rs as $val)
						{
							$cate[$val["id"]] = $val["name"];
						}
					$rs = $cate;
				}
			return $rs;
		}


		public function RemoveParameters($id,$cateid)
		{
			$sql = "DELETE FROM sb_rules WHERE kid=$id AND pid IN (SELECT id FROM sb_products WHERE class_id=$cateid)";
			//echo $sql;
			$rs = $this->mDb->execute($sql);
			return $rs;
		}

		public function batchRemoveParameters()
		{
			if(is_array($_POST["selected"]))
			{
				foreach ($_POST["selected"] as $val)
				{
					$rs = $this->RemoveParameters($val,$_POST["cateid"]);
				}
			}
			return $rs;
		}

		public function setGroupParameter($name,$pid,$cid,$cateid)
		{
			if(is_array($pid))
			{
				$pid=implode(",",$pid);
			}
			$sql = "SELECT id FROM sb_cateparagroup WHERE name='$name' AND cid=$cid AND cateid=$cateid";
			$id = $this->mDb->getone($sql);
			if($id)
			{
				$sql = "UPDATE sb_cateparagroup SET parameters='$pid' WHERE cid=$cid AND id=$id";
			}
			else
			{
				$sql = "INSERT INTO sb_cateparagroup SET name='$name',cateid='$cateid',cid='$cid',parameters='$pid'";
			}
			$rs = $this->mDb->execute($sql);
			return $rs;
		}

		public function getGroupParaByID($cateid,$type)
		{

			$sql = "SELECT * FROM sb_cateparagroup WHERE cateid=$cateid";
			$rs = $this->mDb->getall($sql);
			if($rs && !empty($type))
				{
					$cate = array();
					foreach ($rs as $val)
						{
							$parameters = explode(",",$val["parameters"]);
							if(is_array($parameters))
							{
								foreach ($parameters as $key)
								{
									$cate[$key] = $val["name"];
								}
							}
						}
					$rs = $cate;
				}
			return $rs;
		}

		public function setParameterSeque($para,$cateid)
		{
			$this->mDb->execute("DELETE FROM sb_category_seque WHERE cateid=$cateid");
			foreach ($para as $key => $val)
			{
				$sql = "INSERT INTO sb_category_seque SET cateid='$cateid',pid='$key',seque='$val'";
				$this->mDb->execute($sql);
			}
			return true;

			if(is_array($para["para1"]))
			{
				//$para["para1"] = rsort($para["para1"]);
				$para1 = array();
				foreach ($para["para1"] as $key => $val)
				{
					if($val)
					{
						$para1[$val] = $key;
					}
					else
					{
						$para1[] = $key;
					}
				}
				krsort($para1);
				$para1 = implode(",",$para1);

			}

			if(is_array($para["para2"]))
			{
				$para2 = array();
				foreach ($para["para2"] as $key => $val)
				{
					if($val)
					{
						$para2[$val] = $key;
					}
					else
					{
						$para2[] = $key;
					}
				}
				$para2 = implode(",",$para2);
			}

			if(is_array($para["para3"]))
			{
				$para3 = array();
				foreach ($para["para3"] as $key => $val)
				{
					if($val)
					{
						$para3[$val] = $key;
					}
					else
					{
						$para3[] = $key;
					}
				}
				$para3 = implode(",",$para3);
			}
			//$para1 = krsort($para["para1"]);
			//print_r($para1);
			$sql = "SELECT group_concat(id SEPARATOR ',') FROM sb_products WHERE class_id =$cateid";
			$pid = $this->mDb->getone($sql);
			//die();
			$sql = "UPDATE sb_categorys SET parameters='$para1',parameters1='$para2',parameters2='$para3' WHERE id=$cateid";
			$rs =$this->mDb->execute($sql);
			if(is_array($para["other"]))
			{
				foreach($para["other"] as $key => $val)
		 		{
	 				if($val=="")$val=0;
	 				$sql = "UPDATE sb_rules SET sequence='".$val."' WHERE kid = $key AND pid IN($pid)";
		 			$this->mDb->execute($sql);
		 		}
			}
			return $rs;
		}

	public function getParameterListByCateID2 ($cateid,$selectd)

		{
			//$this->mDb->debug=1;
			$paragroup = $this->getGroupParaByID($cateid,"t");
			//print_r($paragroup);
			$sql= "SELECT * FROM sb_categorys WHERE id=".$cateid;
			$rs = $this->mDb->getrow($sql);
			$id = $rs["parameters"].",".$rs["parameters1"].",".$rs["parameters2"];
			$ids = explode(",",$id);
			$new_id = array();
			for($i=0;$i<count($ids);$i++)
			{
				if($ids[$i]>0)$new_id[] = $ids[$i];
			}

			$sql = "SELECT DISTINCT t1.id FROM sb_parameters t1, sb_rules t2 WHERE t1.id = t2.kid AND t2.pid IN ( SELECT id FROM sb_products WHERE class_id =$cateid)";
			$ids = $this->mDb->getall($sql);
			foreach ($ids as $val)
			{
				$new_id[] = $val["id"];
			}
			$para1 = explode(",",$rs["parameters"]);
			$data["para1"] = $this->getParameterListByIdNew($cateid,$para1,null,$paragroup);
			//print_r($data["para1"]);
			$para2 = explode(",",$rs["parameters1"]);
			$data["para2"] = $this->getParameterListByIdNew($cateid,$para2,null,$paragroup);

			$para3 = explode(",",$rs["parameters2"]);
			$data["para3"] = $this->getParameterListByIdNew($cateid,$para3,null,$paragroup);
			//die();
			$id = explode(",",$id);
			$id = array_diff($id, array(null));
			$data["para4"] = $this->getParameterListByIdNew($cateid,$new_id,$id,$paragroup);

				//echo $sql;

			return $data;
		}


		public function getParameterListByIdNew($cateid,$id,$nid,$paragroup)
		{
			if(is_array($id) && count($id)>0)
				{

					$sql ="SELECT t1 . * , t2.pid,t2.cateid,t2.seque
							FROM sb_parameters t1
							LEFT JOIN (

							SELECT *
							FROM sb_category_seque
							WHERE cateid =$cateid
							) AS t2 ON t2.pid = t1.id
							WHERE t1.id
							IN ( ".implode(",",$id)." )";
					 if(is_array($nid) && count($nid)>0)
					{
						$sql .= " AND t1.id NOT IN(".implode(",",$nid).")";
					}
					$sql.=" ORDER BY t2.seque DESC";
					//echo $sql;
					$data = $this->mDb->getall($sql);
					if(is_array($data))
					{
						foreach ($data as $key =>$val)
						{
							$data[$key]["paragroup"] = $paragroup[$val["id"]];
						}
					}
				}
				return $data;
		}


//		public function getParameterListByCateID2 ($cateid,$selectd)
//
//		{
//			//$this->mDb->debug=1;
//			$paragroup = $this->getGroupParaByID($cateid,"t");
//			//print_r($paragroup);
//			$sql= "SELECT * FROM sb_categorys WHERE id=".$cateid;
//			$rs = $this->mDb->getrow($sql);
//			$id = $rs["parameters"].",".$rs["parameters1"].",".$rs["parameters2"];
//			$ids = explode(",",$id);
//			$new_id = array();
//			for($i=0;$i<count($ids);$i++)
//			{
//				if($ids[$i]>0)$new_id[] = $ids[$i];
//			}
//
//			$sql = "SELECT DISTINCT t1.id FROM sb_parameters t1, sb_rules t2 WHERE t1.id = t2.kid AND t2.pid IN ( SELECT id FROM sb_products WHERE class_id =$cateid)";
//			$ids = $this->mDb->getall($sql);
//			foreach ($ids as $val)
//			{
//				$new_id[] = $val["id"];
//			}
//			//print_r($new_id);
//			//$sql .= ")";
//			//print_r($rs["parameters"]);
//			//die();
//			$data["para1"] = $this->getParameterListByID($rs["parameters"],$paragroup);
//			$data["para2"] = $this->getParameterListByID($rs["parameters1"],$paragroup);
//			$data["para3"] = $this->getParameterListByID($rs["parameters2"],$paragroup);
//			   /* if($rs["parameters"])
//			    {
//			    	$val="";
//			    	$para1 = explode(",",$rs["parameters"]);
//			    	foreach ($para1 as $val)
//			    	{
//			    		if($val)$data["para1"][] = $this->mDb->getrow("SELECT * FROM sb_parameters WHERE id=$val");
//			    	}
//			    }
//			     if($rs["parameters1"])
//			    {
//			    	$val="";
//			    	$para2 = explode(",",$rs["parameters1"]);
//			    	foreach ($para2 as $val)
//			    	{
//			    		if($val)$data["para2"][] = $this->mDb->getrow("SELECT * FROM sb_parameters WHERE id=$val");
//			    	}
//			    }
//			     if($rs["parameters2"])
//			    {
//			    	$val="";
//			    	$para3 = explode(",",$rs["parameters2"]);
//			    	foreach ($para3 as $val)
//			    	{
//			    		if($val)$data["para3"][] = $this->mDb->getrow("SELECT * FROM sb_parameters WHERE id=$val");
//			    	}
//			    }*/
//				if(is_array($new_id))
//				{
//
//					$sql ="SELECT *
//							FROM (
//
//							SELECT DISTINCT t1. * , t2.sequence
//							FROM sb_parameters t1, sb_rules t2
//							WHERE t1.id = t2.kid
//							AND t1.id
//							IN ( ".implode(",",$new_id)." )";
//					 if($id)
//					{
//						$id = explode(",",$id);
//						$id = array_diff($id, array(null));
//						if(count($id)>0)$sql .= " AND t1.id NOT IN(".implode(",",$id).")";
//					}
//					$sql.="	ORDER BY t2.sequence DESC
//						) AS t
//						GROUP BY id
//						ORDER BY sequence DESC";
//					/*$sql = " SELECT t1.* FROM sb_parameters t1, sb_rules t2 WHERE t1.id = t2.kid AND  t1.id IN (".implode(",",$new_id).")";
//					if($id)
//					{
//						$id = explode(",",$id);
//						$id = array_diff($id, array(null));
//						if(count($id)>0)$sql .= " AND t1.id NOT IN(".implode(",",$id).")";
//					}
//					$sql .= " GROUP BY t1.id ORDER BY t2.sequence DESC";*/
//					$data["para4"] = $this->mDb->getall($sql);
//					if(is_array($data["para4"]))
//					{
//						foreach ($data["para4"] as $key =>$val)
//						{
//							$data["para4"][$key]["paragroup"] = $paragroup[$val["id"]];
//						}
//					}
//				}
//
//				//echo $sql;
//
//			return $data;
//		}

		/*public function getParameterListByID ($id,$type=null)
		{
			$sql = "SELECT * FROM sb_parameters  WHERE id IN ($id)";
			if($_GET["name"])
			{
				$sql .= " AND  name LIKE '%".$_GET["name"]."%'";
			}
				//echo $sql;
				$rs = $this->mDb->getall($sql);
				//print_r($rs);
				if($rs && !empty($type))
				{
					$cate = array();
					foreach ($rs as $val)
						{
							$cate[$val["id"]] = $val["name"];
						}
					$rs = $cate;
				}
			return $rs;
		}*/

		public function getParameterListByID ($id,$paragroup,$type=null)
		{

			$id = explode(",",$id);
	    	foreach ($id as $val)
	    	{
	    		if($val) $t= $this->mDb->getrow("SELECT * FROM sb_parameters WHERE id=$val");
	    		if($t) $rs[] =$t;
	    	}

	    	if($rs && !empty($type))
				{
					$cate = array();
					foreach ($rs as $val)
						{
							$cate[$val["id"]] = $val["name"];
						}
					$rs = $cate;
				}
				else
				{
					if(is_array($rs))
						{
							foreach ($rs as $key =>$val)
							{
								$rs[$key]["paragroup"] = $paragroup[$val["id"]];
							}
						}
				}
			return $rs;
			//print_r($rs);
		}

		public function getListSN($cateid,$size=_PAGES)
		{
			$sql = "SELECT t2.*,t1.cprodname,t1.sku,t1.picpath FROM ".get_table("products")." t1,".get_table("product_sn")." t2 ";
			 $sqlv[] = "t1.id=t2.pid ";
			if($_GET["prodname"]) $sqlv[] = " (t1.cprodname LIKE '%".$_GET["prodname"]."%' OR t1.eprodname LIKE '%".$_GET["prodname"]."%' OR t1.jprodname LIKE '%".$_GET["prodname"]."%') ";
			if($_GET["keyword"]) $sqlv[] = " (t1.cprodname LIKE '%".$_GET["keyword"]."%' OR t1.eprodname LIKE '%".$_GET["keyword"]."%' OR t1.jprodname LIKE '%".$_GET["keyword"]."%') ";
			if($_GET["sku"]) $sqlv[] = " t1.sku LIKE '".$_GET["sku"]."%' ";
			if($_GET["sn"]) $sqlv[] = " t2.sn LIKE '".$_GET["sn"]."%' ";
			if($_GET["status"] || $_GET["status"]=='0') $sqlv[] = " t2.flag = '".$_GET["status"]."' ";
			if($cateid)
			{
				if(is_array($cateid))
			    {
			    	$cateid =  implode(",",$cateid);
			    }
			    $sqlv[] = " class_id IN ($cateid)";
			}
			if($sqlv)$sql .=" WHERE ".implode("AND",$sqlv);

			switch ($_GET["order"])
			{
				case "2":
					$order = "t1.price DESC";
					break;
				case "3":
					$order = "t1.price ASC";
					break;
				case "4":
					$order = "t1.hits DESC";
					break;
				case "5":
					$order = "t1.starttime DESC";
					break;
			    default:
					$order = "t1.id DESC";
			}
			$sql .="  ORDER BY $order";
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


		public function getKeyWordManageList($size=_PAGES)
		{
			$sql = "SELECT * FROM ".get_table("keywords")."  ORDER BY hits DESC";
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

		public function getCommmentList($size=_PAGES)
		{
			$sql = "SELECT * FROM ".get_table("comments")."  ORDER BY id DESC";
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

		public function getCommmentListbyUid($uid,$size=_PAGES)
		{
			$sql = "SELECT t1.*,t2.orderno,t4.cprodname,t4.sku FROM ".get_table("comments")." t1,".get_table("orders")." t2,".get_table("orderprodlist")." t3,".get_table("products")." t4
			        WHERE t2.uid=$uid AND t1.uid=t2.uid AND t1.pid=t3.pid AND t1.pid=t4.id AND t3.order_id=t2.id ORDER BY t1.id DESC";
			//echo $sql;
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

		public function getCommentTotalByUid($uid)
		{
			$sql = "SELECT COUNT(*) FROM ".get_table("comments")." WHERE uid=$uid";
			return $this->mDb->getone($sql);
		}

		public function getProdutctPackagesList($size=_PAGES)
		{
			$sql = "SELECT * FROM ".get_table("product_packages")."  ORDER BY id DESC";
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

		public function getNavBrandList($pid=0)
		{
			$sql = "SELECT * FROM ".get_table("products")." WHERE pid=$pid";
			$rs = $this->mDb->getall($sql);

			foreach ($rs as $key =>$val)
				{
					$pos = array("/"," ","%","'",",",".","\"");
					$rs[$key]["urlkey"] = str_replace($pos,"-",$val["ename"]);
				}
			return $rs;
		}

		public function getNavProductList($cateid,$limit=3)
		{
		    if(is_array($cateid))
		    {
		    	$cateid =  implode(",",$cateid);
		    }
			$sql = "SELECT * FROM ".get_table("products")." WHERE class_id IN ($cateid) AND status=1 LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}


		public function getTopSaleList($limit=300)
		{
			$sql = "SELECT * FROM ".get_table("products")." WHERE sold_quantity >0 ORDER BY sold_quantity DESC LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function getTopHitsList($limit=300)
		{
			$sql = "SELECT * FROM ".get_table("products")." WHERE hits >=0 ORDER BY hits DESC LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function getBestProductList($limit=3)
		{
			$sql = "SELECT * FROM ".get_table("products")." WHERE  is_best=1 AND status=1 ORDER BY id DESC LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function getSpecialProductList($limit=3)
		{
			$sql = "SELECT t1.price AS saleprice ,t1.date_end, t2 . * FROM (SELECT * FROM ".get_table("product_sales")." WHERE TYPE =2 AND date_start<=NOW() AND date_end>=NOW() ORDER BY priority DESC )
			AS t1, ".get_table("products")." t2 WHERE t1.pid = t2.id AND t2.status=1 GROUP BY t1.pid ORDER BY t2.sequence DESC LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			foreach ($rs as $key=>$vul)
			{
				$rs[$key]["discount"] = discount($vul["saleprice"],$vul["price"]);
				$rs[$key]["leavhr"] = leavHr($vul["date_end"]);
			}
			return $rs;
		}

		public function getDiscountProductList($limit=3)
		{
			$sql = "SELECT t1.price AS saleprice , t2 . * FROM (SELECT * FROM ".get_table("product_sales")." WHERE TYPE =1 AND date_start<=NOW() AND date_end>=NOW() ORDER BY priority DESC )
			AS t1, ".get_table("products")." t2 WHERE t1.pid = t2.id AND t2.status=1 GROUP BY t1.pid ORDER BY t2.sequence DESC LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function getPackagesSale($id)
		{
			$sql = "SELECT * FROM ".get_table("product_packages")." WHERE id=".$id;
			$rs = $this->mDb->getRow($sql);
			return $rs;
		}

		public function getPackagesSaleList($id)
		{
			$sql = "SELECT t2.*,t1.* FROM ".get_table("product_to_packages")." t1,".get_table("products")." t2 WHERE t1.pid=t2.id AND t1.ppid=".$id;
			$rs = $this->mDb->getAll($sql);
			return $rs;
		}

		public function getPackagesSaleListByPID($pid,$t="yes")
		{
			$sql = "SELECT t2.*,t1.quantity,t1.pid FROM ".get_table("product_to_packages")." t1,".get_table("product_packages")." t2 WHERE t1.ppid=t2.id AND ";
			if(is_array($pid))
			{
				$sql .= " t2.id IN(SELECT distinct ppid FROM ".get_table("product_to_packages")." WHERE  pid IN (".implode(",",$pid)."))" ;
			}
			 else
			{
			 	$sql .= " t1.pid =$pid " ;
			}
			$sql .= "AND t2.date_start<=NOW() AND t2.date_end >=NOW()";
 			$packages = $this->mDb->getAll($sql);
			if($t=="yes")
			{
				foreach ($packages as $key =>$val)
				{
					$packages[$key]["id"] = $val["id"];
					$packages[$key]["items"] = $this->getPackagesSaleList($val["id"]);
					$packages[$key]["total"] = 0;
					foreach ($packages[$key]["items"] as $val)
					{
						$packages[$key]["total"] =  $packages[$key]["total"]+$val["price"]*$val["quantity"];
					}
					$packages[$key]["total_end"] =  $packages[$key]["total"]*$packages[$key]["discount"]/100;
				}
			}
			return $packages;
		}


		public function savePost()
		{
			if(!$_POST["is_best"]) $_POST["is_best"]= '0';
			if(!$_POST["is_new"]) $_POST["is_new"]= '0';
			if(!$_POST["is_hot"]) $_POST["is_hot"]= '0';
			if($_POST["status"]=="1")$_POST["starttime"] = date("Y-m-d H:i:s");
			if(!$_POST["is_alone_sale"]) $_POST["is_alone_sale"]= '0';
			$parameter = $_POST["parameter"];
			unset($_POST["parameter"]);
			$product_vals = $_POST["product_vals"];
			unset($_POST["product_vals"]);
			foreach ($_POST as $key =>$val)
				{
					if(!in_array($key,array("id","aid","product_discount","product_special")))
					{
						if($key == "class_ids")
						{
							$i=0;
							foreach($val as $ckey => $cval)
					 		{
				 				if($val[$ckey]!="")
				 				{
				 					$sqlv[] = " class_id$i = '$cval'";
				 					$i++;
				 				}

					 		}
						}
						else
						{
							$sqlv[] = " $key = '".sb_addslashes($val)."'";
						}

					}
				}
			if(!$_POST["id"])
			{
				$sql = "INSERT INTO ".get_table("products")." SET ".implode(",",$sqlv);

			}
			else
			{
				$sql = "UPDATE ".get_table("products")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			if(!$_POST["id"])
			{
				$pid = $this->mDb->Insert_ID();
			}
			else
			{
				$pid = $_POST["id"];
			}
			$this->updateAttachments($pid);
			//$this->createParameter($parameter,$pid);
			/* $this->createParameter2($product_vals,$pid); */
			//if($_POST["product_discount"])$this->updateSales("discount",$pid);
			//if($_POST["product_special"])$this->updateSales("special",$pid);
			return $rs;
 		}

 		public function Batch()
	  	{
	  		$i=0;
	  		while ($i<count($_POST["selected"]))
	  		{
	  			if($_POST["more"]=="0")
	  			{
	  				$sql = "DELETE FROM ".get_table("products")." WHERE id=".$_POST["selected"][$i];
	  			}
	  			else if($_POST["more"]=="3")
	  			{
	  				$sql = "UPDATE ".get_table("products")." SET status='1' WHERE id=".$_POST["selected"][$i];
	  			}
	  			else if($_POST["more"]=="4")
	  			{
	  				$sql = "UPDATE ".get_table("products")." SET status='0' WHERE id=".$_POST["selected"][$i];
	  			}
	  			else
	  			{
	  				$sql = "UPDATE ".get_table("products")." SET class_id='".$_POST["class_id"]."' WHERE id=".$_POST["selected"][$i];
	  			}
	  			$rs = $this->mDb->execute($sql);
	  			$i++;
	  		}
	  	}

	  	public function autoDo()
	  	{
	  		$i=0;
	  		while ($i<count($_POST["selected"]))
	  		{
	  			$sql = "UPDATE ".get_table("products")." SET ";
	  			if($_GET["do"]=="1")
	  			{
	  				$sql .= "up_date = '".$_POST["dodate"]."' WHERE id=".$_POST["selected"][$i];
	  			}
	  			else
	  			{
	  				$sql .= "under_date = '".$_POST["dodate"]."' WHERE id=".$_POST["selected"][$i];
	  			}
	  			$rs = $this->mDb->execute($sql);
	  			$i++;
	  		}
	  	}


	  	public function nowDo($type)
	  	{
	  		$sql = "SELECT id FROM ".get_table("products")." WHERE under_date > '0000-00-00'";
	  		if($type=="1")
	  		{
	  			$sql .= " AND up_date < now() ";
	  		}
	  		else
	  		{
	  			$sql .= " AND under_date < now() ";
	  		}
	  		$rs = $this->mDb->getall($sql);
	  		foreach ($rs as $val)
	  		{
	  			$sql = "UPDATE ".get_table("products")." SET status=$type,";
	  			if($type=="1")
	  			{
	  				$sql .= " starttime = now(),up_date='' WHERE id=".$val["id"];
	  			}
	  			else
	  			{
	  				$sql .= " starttime = '',under_date='' WHERE id=".$val["id"];
	  			}
	  			$this->mDb->execute($sql);
	  		}
	  	}


		public function saveUpdate()
		{
			if(is_array($_POST["seque"]))
			{
				foreach($_POST["seque"] as $key => $val)
		 		{
	 				if($val=="")$val=0;
	 				$sql = "UPDATE ".get_table("products")." SET sequence='".$val."' WHERE id = $key";
		 			$this->mDb->execute($sql);
		 		}
			}
		}

		public function getDropList($type=null,$where)
		{
			$sql = "SELECT * FROM ".get_table("products").$where;
			$rs = $this->mDb->getall($sql);
			if(!empty($type))
			{
				$cate = array();
				foreach ($rs as $val)
					{
						$cate[$val["id"]] = $val["cprodname"];
					}
				$rs = $cate;
			}
			return $rs;
		}

		public function getKeyword()
		{
			$sql = "SELECT * FROM ".get_table("keywords")." WHERE keyword  LIKE '".$_GET["q"]."%' ORDER BY hits DESC LIMIT 10";
			$rs = $this->mDb->getall($sql);

			foreach ($rs as $key=>$val)
			{
			   $str.= $val["keyword"]."|".$val["keyword"]."\n";
			}
			return $str;
		}

		public function getKeywordList($limit)
		{
			$sql = "SELECT * FROM ".get_table("keywords")." ORDER BY hits DESC LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function getKeyWordRow($id)
		{
			$sql = "SELECT * FROM ".get_table("keywords")." WHERE id=$id";
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		public function getCommentRow($id)
		{
			$sql = "SELECT * FROM ".get_table("comments")." WHERE id=$id";
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		public function getCommentList($pid)
		{
			$sql = "SELECT * FROM ".get_table("comments")." WHERE pid=$pid ORDER BY id DESC";
			$rs = $this->mDb->getAll($sql);
			return $rs;
		}

		public function getProductByKeyword()
		{
			$sql = "SELECT id,cprodname,price,quantity FROM ".get_table("products")." WHERE (cprodname LIKE '%".$_GET["q"]."%' || sku LIKE '".$_GET["q"]."%') ORDER BY hits DESC LIMIT 10";
			$rs = $this->mDb->getall($sql);

			foreach ($rs as $key=>$val)
			{
			   $str.= $val["cprodname"]."|".$val["id"]."|".number_format($val["price"],2)."|".$val["quantity"]."\n";
			}
			return $str;
		}

		public function getParameterByKeyword()
		{
			$sql = "SELECT id,name FROM ".get_table("parameters")." WHERE name LIKE '%".$_GET["q"]."%' ORDER BY id DESC LIMIT 10";
			$rs = $this->mDb->getall($sql);

			foreach ($rs as $key=>$val)
			{
			   $str.= $val["name"]."|".$val["id"]."\n";
			}
			return $str;
		}

		public function KeywordBatch()
	  	{
	  		$i=0;
	  		while ($i<count($_POST["selected"]))
	  		{
	  			if($_POST["more"]=="0")
	  			{
	  				$sql = "DELETE FROM ".get_table("keywords")." WHERE id=".$_POST["selected"][$i];
	  			}
	  			else
	  			{
	  				$sql = "UPDATE ".get_table("keywords")." SET hits='".$_POST["hits"][$_POST["selected"][$i]]."' WHERE id=".$_POST["selected"][$i];
	  			}
	  			$rs = $this->mDb->execute($sql);
	  			$i++;
	  		}
	  	}

	  	public function CommentBatch()
	  	{
	  		$i=0;
	  		while ($i<count($_POST["selected"]))
	  		{
	  			$sql = "DELETE FROM ".get_table("comments")." WHERE id=".$_POST["selected"][$i];
	  			$rs = $this->mDb->execute($sql);
	  			$i++;
	  		}
	  	}


		public function saveKeywordPost()
		{
			if($_POST["id"])
			{
				$sql ="UPDATE ".get_table("keywords")." SET keyword='".$_POST["keyword"]."',hits='".$_POST["hits"]."' WHERE id=".$_POST["id"];
			}
			else
			{
				$sql ="INSERT INTO ".get_table("keywords")." SET keyword='".$_POST["keyword"]."',hits=1";
			}
			$rs = $this->mDb->execute($sql);
			return $rs;
		}


		public function saveProductComments($content,$pid,$uid,$username,$order_id)
		{
			if($_POST["id"])
			{
				$sql = "UPDATE ".get_table("comments")." SET content='".$content."' WHERE id=".$_POST["id"];
				$rs = $this->mDb->execute($sql);
			}
			else
			{
				$sql ="INSERT INTO ".get_table("comments")." SET content='".$content."',pid='".$pid."',uid='".$uid."',username='".$username."',order_id='$order_id'";
				$rs = $this->mDb->execute($sql);
				if($rs)$this->mDb->execute("UPDATE ".get_table("products")." SET comments=comments+1 WHERE id=$pid");
			}
			return $rs;
		}


		public function saveKeyword($keyword)
		{
			if(!$keyword)return $keyword;
			$sql = "SELECT id FROM ".get_table("keywords")." WHERE keyword='$keyword'";
			$id =$this->mDb->getone($sql);
			if($id)
			{
				$sql ="UPDATE ".get_table("keywords")." SET hits=hits+1 WHERE id=".$id;
			}
			else
			{
				$sql ="INSERT INTO ".get_table("keywords")." SET keyword='$keyword',hits=1";
			}
			$this->mDb->execute($sql);
		}

		public function DelKeyWord($id)
		{
			$rs = $this->mDb->execute("DELETE FROM ".get_table("keywords")." WHERE id=".$id);
			if(!$rs)
			{
				return false;
			}
			else
			{
				return true;
			}
		}


		public function Del($id)
		{
			$rs = $this->mDb->execute("DELETE FROM ".get_table("products")." WHERE id=".$id);
			if(!$rs)
			{
				return false;
			}
			else
			{
				return true;
			}
		}

		public function DelComment($id)
		{
			$rs = $this->mDb->execute("DELETE FROM ".get_table("comments")." WHERE id=".$id);
			if(!$rs)
			{
				return false;
			}
			else
			{
				return true;
			}
		}

		public function DelProductSales($id)
		{
			$rs = $this->mDb->execute("DELETE FROM ".get_table("product_sales")." WHERE id=".$id);
			if(!$rs)
			{
				return false;
			}
			else
			{
				return true;
			}
		}

		public function getRow($id,$table="products")
		{
			$sql = "SELECT * FROM ".get_table($table)." WHERE id=".$id;
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		public function getProductSaleRow($id)
		{
			$sql = "SELECT t1.*,t2.cprodname FROM ".get_table("product_sales")." t1,".get_table("products")." t2 WHERE t1.pid=t2.id AND t1.id=".$id;
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		public function upHits($id)
		{
			$sql = "UPDATE ".get_table("products")." SET hits = hits+1 WHERE id=".$id;
			$this->mDb->execute($sql);
		}

		public function getFilebyUid($uid)
		{
			$sql = "SELECT * FROM  ".get_table("attachments")." WHERE pid=0";
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

		private function updateAttachments($pid)
		{
			$this ->mDb->execute("UPDATE ".get_table("attachments")." SET pid=0 WHERE pid=".$pid);
			foreach ($_POST["aid"] as $val)
			{
				$sql = "UPDATE ".get_table("attachments")." SET pid=$pid WHERE id=".$val;
				$this->mDb->execute($sql);
			}
		}

		private function createParameter($parameter,$pid)
		{
			$this ->mDb->execute("DELETE FROM ".get_table("parameters")." WHERE pid=".$pid);
			if($parameter)
			{
				foreach ($parameter as $key=>$val)
				{
					$keys = explode("_",$key);
					$custom=$val;
					if($keys[2]==$val)$custom="";
					$sql = "INSERT INTO ".get_table("parameters")." SET pid='$pid',ptype='".$keys[0]."', pkey='".$keys[1]."', pval='".$keys[2]."', custom='$custom'";
					$this->mDb->execute($sql);
				}
			}
		}

		public function getParameter($pid,$type)
		{
			$sql ="SELECT * FROM ".get_table("parameters")." WHERE pid=".$pid;
			if($type) $sql.=" ptype='$type'";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}


		public function setMergeParameter($name,$kids,$cateid)
		{
			$sql = "SELECT id FROM ".get_table("parameters")." WHERE name='$name'";
			$new_kid = $this->mDb->getone($sql);
			if(!$new_kid)
			{
				$sql = "INSERT INTO ".get_table("parameters")." SET name='$name'";
			    $this->mDb->execute($sql);
			    $new_kid = $this->mDb->Insert_ID();
			}
			$sql = "UPDATE ".get_table("rules")." SET kid ='$new_kid' WHERE kid IN(".implode(",",$kids).") AND pid IN(SELECT id FROM ".get_table("products")." WHERE class_id=$cateid)";
			$this->mDb->execute($sql);
			return $new_kid;
		}

		private function createParameter2($parameter,$pid)
		{
			$this ->mDb->execute("DELETE FROM ".get_table("rules")." WHERE pid=".$pid);
			//print_r($parameter);
			if($parameter)
			{
				foreach ($parameter as $key=>$val)
				{
					$sql = "SELECT id FROM ".get_table("parameters")." WHERE name='".$val["name"]."'";
					$kid = $this->mDb->getone($sql);
					if(!$kid)
					{
						$sql = "INSERT INTO ".get_table("parameters")." SET name='".$val["name"]."'";
					    $this->mDb->execute($sql);
					    $kid = $this->mDb->Insert_ID();
					}
					$sql = "INSERT INTO ".get_table("rules")." SET pid='$pid',kid='$kid',val='".$val["pvals"]."'";
					$this->mDb->execute($sql);
				}
			}
		}

		public function getProductParameter($pid,$cateid)
		{
			$sql ="SELECT t1.val,t2.name,t2.id FROM ".get_table("rules")." t1,".get_table("parameters")." t2 WHERE t1.kid=t2.id AND t1.pid=".$pid;
			$rs = $this->mDb->getall($sql);
			if(is_array($rs))
			{
				foreach ($rs as $val)
				{
					$data4[$val["id"]] = $val;
				}
			}
			//print_r($data4);
			$paragroup = $this->getGroupParaByID($cateid,"t");
			//print_r($paragroup);
			$sql= "SELECT * FROM sb_categorys WHERE id=".$cateid;
			$rs = $this->mDb->getrow($sql);
			$id = $rs["parameters"].",".$rs["parameters1"].",".$rs["parameters2"];
			$para1 = explode(",",$rs["parameters"]);
			$data1 = $this->getParameterListByIdNew($cateid,$para1,null,$paragroup);
			if(is_array($data1))
			{
				foreach ($data1 as $val)
				{
					$color = "#9bc6a8";
					if(array_key_exists($val["id"],$data4))
					{
						$data4[$val["id"]]["color"] = $color;
						$data[] = $data4[$val["id"]];
						//print_r($data4[$val["id"]]);
						unset($data4[$val["id"]]);
					}
					else
					{
						$val["color"] = $color;
						$data[] = $val;
					}
					//print_r($data);
				}
			}
			//print_r($data["para1"]);
			$para2 = explode(",",$rs["parameters1"]);
			$data2 = $this->getParameterListByIdNew($cateid,$para2,null,$paragroup);
			if(is_array($data2))
			{
				foreach ($data2 as $val)
				{
					$color = "#ddfee7";
					if(array_key_exists($val["id"],$data4))
					{
						$data4[$val["id"]]["color"] = $color;
						$data[] = $data4[$val["id"]];
						//print_r($data4[$val["id"]]);
						unset($data4[$val["id"]]);
					}
					else
					{
						$val["color"] = $color;
						$data[] = $val;
					}
				}
			}

			$para3 = explode(",",$rs["parameters2"]);
			$data3 = $this->getParameterListByIdNew($cateid,$para3,null,$paragroup);
			if(is_array($data3))
			{
				foreach ($data3 as $val)
				{
					$color = "#9ae1db";
					if(array_key_exists($val["id"],$data4))
					{
						$data4[$val["id"]]["color"] = $color;
						$data[] = $data4[$val["id"]];
						//print_r($data4[$val["id"]]);
						unset($data4[$val["id"]]);
					}
					else
					{
						$val["color"] = $color;
						$data[] = $val;
					}
				}
			}

			if(is_array($data4))
			{
				foreach ($data4 as $val)
				{
					$data[] = $val;
				}
			}
			//print_r($data4);
			return $data;
		}

		public function getParameter2($pid,$type)
		{
			$sql ="SELECT t1.val,t2.name FROM ".get_table("rules")." t1,".get_table("parameters")." t2 WHERE t1.kid=t2.id AND t1.pid=".$pid;
			//if($type) $sql.=" ptype='$type'";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function getParameter3($pid)
		{
			$sql ="SELECT * FROM ".get_table("parameters")." WHERE pid IN($pid)";
			//if($type) $sql.=" ptype='$type'";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		private function updateSales($type,$pid)
		{
			switch($type)
			{
				case "discount":
					$type_index = 1;
					break;
				case "special":
					$type_index = 2;
					break;
				case "countdown":
					$type_index = 3;
					break;
			}
			$sql = "DELETE FROM ".get_table("product_sales")." WHERE pid=$pid AND type=$type_index";
			$this->mDb->execute($sql);

			foreach ($_POST["product_$type"] as $val)
			{
				$sql = "INSERT INTO ".get_table("product_sales")." SET pid='$pid',type='$type_index',customer_group_id='".$val["customer_group_id"]."',quantity='".$val["quantity"]."',priority='".$val["priority"]."',price='".$val["price"]."',date_start='".$val["date_start"]."',date_end='".$val["date_end"]."'";
				$this->mDb->execute($sql);
			}
		}

		public function saveProductSales($type)
		{
			$sqlv[] = " type = '$type'";
			foreach ($_POST as $key =>$val)
				{
					if(!in_array($key,array("id","product")))
					{
						$sqlv[] = " $key = '".sb_addslashes($val)."'";
					}
				}
			if(!$_POST["id"])
			{
				$sql = "INSERT INTO ".get_table("product_sales")." SET ".implode(",",$sqlv);

			}
			else
			{
				$sql = "UPDATE ".get_table("product_sales")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			return $rs;
		}


		public function savePackagesSales()
		{
			foreach ($_POST as $key =>$val)
				{
					if(!in_array($key,array("id","product_package")))
					{
						$sqlv[] = " $key = '".sb_addslashes($val)."'";
					}
				}
			if(!$_POST["id"])
				{
					$sql = "INSERT INTO ".get_table("product_packages")." SET ".implode(",",$sqlv);

				}
				else
				{
					$sql = "UPDATE ".get_table("product_packages")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
				}
			$rs = $this->mDb->execute($sql);
			if(!$_POST["id"])
				{
					$ppid = $this->mDb->Insert_ID();
				}
				else
				{
					$ppid = $_POST["id"];
				}
				$sql = "DELETE FROM  ".get_table("product_to_packages")." WHERE ppid=".$ppid;
			    $this->mDb->execute($sql);
			foreach ($_POST["product_package"] as $val)
				{
					$sql = "INSERT INTO ".get_table("product_to_packages")." SET ppid='$ppid',pid='".$val["pid"]."',quantity='".$val["quantity"]."'";
					$this->mDb->execute($sql);
				}
			return $rs;
		}

		public function DelPackagesSales($id)
		{
			$sql = "DELETE FROM  ".get_table("product_to_packages")." WHERE ppid=".$id;
			$this->mDb->execute($sql);
			$sql = "DELETE FROM  ".get_table("product_packages")." WHERE id=".$id;
			$rs = $this->mDb->execute($sql);
			return $rs;
		}

		public function updateCountDownSales()
		{
			$type_index = 3;
			$sql = "DELETE FROM ".get_table("product_sales")." WHERE type=$type_index";
			$this->mDb->execute($sql);

			foreach ($_POST["product_countdown"] as $val)
			{
				$sql = "INSERT INTO ".get_table("product_sales")." SET pid='".$val["pid"]."',type='$type_index',customer_group_id='".$val["customer_group_id"]."',quantity='".$val["quantity"]."',priority='".$val["priority"]."',price='".$val["price"]."',date_start='".$val["date_start"]."',date_end='".$val["date_end"]."'";
				$this->mDb->execute($sql);
			}
		}

		public function getCountDownSales($status,$limit,$today=null)
		{
			if($status)
			{
				$sql = "SELECT t1.price AS saleprice ,t1.date_end, t2 . *  FROM ".get_table("product_sales")." t1,".get_table("products")." t2 WHERE t1.pid=t2.id AND t1.type=3 AND t2.status=1";
			}
			else
			{
				$sql = "SELECT t1.*,t2.cprodname FROM ".get_table("product_sales")." t1,".get_table("products")." t2 WHERE t1.pid=t2.id AND t1.type=3";
			}

			if($today)$sql .= "  AND t1.date_end<='".date("Y-m-d")." 23:59:59'  AND t1.date_start>='".date("Y-m-d")." 00:00:00'";
			$sql .= " ORDER by t1.date_end";
			if($limit)$sql .= " LIMIT $limit ";
			$rs = $this->mDb->getall($sql);
			if($status)
			{
				foreach ($rs as $key=>$val)
	 			{
	 				if(strtotime($val["date_end"])<= time())
	 				{
	 					$rs[$key]["date_end"] = 1;
	 				}
	 			}
			}
			return $rs;
		}


		public function getProdutctSaleList($type,$status,$size)
		{
			if($status)
			{
				$sql = "SELECT t1.price AS saleprice , t1.point , t1.date_end, t1.date_start, t1.quantity AS quantity_limit,t1.point,(t1.quantity-t1.sold_quantity) AS residue,t1.buyusers , t2 . *  FROM ".get_table("product_sales")." t1,".get_table("products")." t2 WHERE t1.pid=t2.id AND t1.type=$type AND t2.status=1";
			}
			else
			{
				$sql = "SELECT t1.*,t2.cprodname,t2.status FROM ".get_table("product_sales")." t1,".get_table("products")." t2 WHERE t1.pid=t2.id AND t1.type=$type";
			}

			$sql .= " ORDER by t1.date_end";
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
			if($status)
			{
				foreach ($rs as $key=>$val)
	 			{
	 				if(strtotime($val["date_end"])<= time())
	 				{
	 					$rs[$key]["date_end"] = 1;
	 				}
	 			}
			}
			$r["logs"] = $rs;
			$r["pages"] = $pages;
			return $r;
		}

		public function getTopProdutctSaleList($type,$status,$limit)
		{
			if($status)
			{
				$sql = "SELECT t1.price AS saleprice ,t1.date_end, t1.date_start, t1.quantity AS quantity_limit,t1.point,  t2 . *  FROM ".get_table("product_sales")." t1,".get_table("products")." t2 WHERE t1.pid=t2.id AND t1.type=$type AND t2.status=1";
			}
			else
			{
				$sql = "SELECT t1.*,t2.cprodname FROM ".get_table("product_sales")." t1,".get_table("products")." t2 WHERE t1.pid=t2.id AND t1.type=$type";
			}

			$sql .= " ORDER by t1.priority,t1.date_end LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function getProductSales($type,$pid)
		{
			switch($type)
			{
				case "discount":
					$type_index = 1;
					break;
				case "special":
					$type_index = 2;
					break;
			}
			$sql = "SELECT * FROM ".get_table("product_sales")." WHERE pid=$pid AND type=$type_index ORDER BY priority DESC";
			$rs = $this->mDb->getAll($sql);
			return $rs;
		}

		public function getProductSalePrice($type,$pid,$order)
		{
			$sql = "SELECT $order FROM ".get_table("product_sales")." WHERE pid=$pid AND type=$type  AND date_end>=NOW()  AND date_start<=NOW()";;
			if($type!=2)$sql .= " AND quantity >0 ";
			$sql .= "ORDER BY $order ASC";
			$rs = $this->mDb->getone($sql);
			return $rs;
		}

		public function getProductSalePriceInfo($type,$pid,$order)
		{
			$sql = "SELECT * FROM ".get_table("product_sales")." WHERE pid=$pid AND type=$type  AND date_end>=NOW()  AND date_start<=NOW()";;
			if($type!=2)$sql .= "AND quantity >0 ";
			//echo $sql;
			$sql .= "ORDER BY $order ASC";
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		public function getFilebyPid($pid,$limit=0)
		{
			$sql = "SELECT * FROM  ".get_table("attachments")." WHERE pid=$pid";
			if($limit) $sql .=" LIMIT $limit";
			$rs = $this->mDb->getAll($sql);
			return $rs;
		}

		public function setVisitLog($pid)
		{
			//unset($_SESSION["visitlog"]);
			/*$_SESSION["visitlog"][$pid] = $this->getRow($pid);
			arsort($_SESSION["visitlog"]);
			return true;*/
			$logs = $_SESSION["visitlog"];
			foreach ($logs as $key => $val)
			{
				if($val["id"] == $pid)
				{
					$tmp = $val;
					unset($_SESSION["visitlog"][$key]);
					$i = 1;
					foreach ($logs as $val)
					{
						if($val["id"]!=$pid)
						{
							$_SESSION["visitlog"][$i] = $val;
							$i++;
						}
						if($i>5)return true;
					}
					$_SESSION["visitlog"][0] = $tmp;
					return true;
				}
			}
			echo $b;
			if(count($logs)==6)
			{
				unset($logs[6]);
			}
			$_SESSION["visitlog"][0] = $this->getRow($pid);
			$i = 1;
			foreach ($logs as $val)
			{
				$_SESSION["visitlog"][$i] = $val;
				$i++;
				if($i>5)return true;
			}
		}

		public function batchImport()
		{
			require_once("Excel/reader.php");
			if(!$_FILES["file"]["tmp_name"])
			{
				$r["nofile"] = true;
				return $r;
			}
			$fp = fopen(_FILE_PATH."logs/import.txt", "w+");
			$data = new Spreadsheet_Excel_Reader();
			//$data->setOutputEncoding('GB2312');
			$data->setOutputEncoding('utf-8');
			$data->read($_FILES["file"]["tmp_name"]);
			$error =0;
			for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++)
			{
				if($data->sheets[0]['cells'][$i][1])
				{
				$sql="INSERT INTO ".get_table("product_sn")." SET pid='".$_POST["pid"]."'
					,sn='".$data->sheets[0]['cells'][$i][1]."',
					passwd='".$data->sheets[0]['cells'][$i][2]."'";
				echo $sql;
				//$sql = iconv("gbk","utf-8",$sql);
				$rs = $this->mDb->execute($sql);
				}
				if(!$rs)$error=$error+1;
			}
			//fclose($fp);
			$r["error"] = $error;
			$r["sucess"] = $data->sheets[0]['numRows']-2-$error;
			return $r;
		}

		public function picMapping()
		{
			///require_once("Files.php");
			$u = new Files();
			$u->mDb = $this->mDb;
			$u->mUid = $_SESSION["login_admin"]["id"];
			$filepaths = _FILE_PATH."/customs/".$_POST["picpath"];
			$dir = opendir($filepaths);
			while (($file = readdir($dir)) !== false)
			{
				if ($file=="." or $file=="..") {} else
				{
					$sql = "SELECT id FROM ".get_table("products")." WHERE sku=".$file;
					$pid = $this->mDb->getone($sql);
					if($pid)
					{
						$imgfile = "/customs/".$_POST["picpath"]."/".$file."/0.jpg";
						$sql = "update ".get_table("products")." SET picpath='$imgfile' where id=".$pid;
						$this->mDb->execute($sql);

						$u->thumb($imgfile,100,100);
						$u->thumb($imgfile,140,140);
						$u->thumb($imgfile,280,280);
						$dir2 = opendir(_FILE_PATH."/customs/".$_POST["picpath"]."/".$file);
						while (($file2 = readdir($dir2)) !== false)
						{
							$ext = strtolower(substr(strrchr($file2,'.'),1));
							if ($file2=="." or $file2==".." or $file2=="0.jpg") {} else
							{
								if(in_array($ext,array("jpg","gif","png","bmp")))
								{
									$imgfile2 = "/customs/".$_POST["picpath"]."/".$file."/$file2";
									echo $imgfile2;
									$filesize =
									$filesize = filesize(_FILE_PATH."/customs/".$_POST["picpath"]."/".$file."/".$file2);
									list($width, $height) = getimagesize(_FILE_PATH."/customs/".$_POST["picpath"]."/".$file."/".$file2);
									//$this->thumb($imgfile2,650,2000,".thumb.jpg");
									$u->thumb($imgfile2,100,100);
									$u->SaveToDb($imgfile2,$width,$filesize,1,$_SESSION["login_admin"]["id"],1);
								}
							}
					    }

					}
				}
			}
			closedir($dir);
		}

		public function getUnitList()
		{
			return array(
							1 => "千克",
							2 => "克");
		}

		public function getStatusList()
		{
			return array(
							1 => "上架",
							0 => "下架");
		}

		public function getTypeList()
		{
			return array(
							1 => "台式",
							2 => "便携",
							3 => "在线");
		}
	}

?>