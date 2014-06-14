<?php
	class Events
	{
		public $mDb;

		public function __construct()
		{
			//$this->mDb->debug = true;
		}

		public function getList($cateid,$size=_PAGES)
		{
			$sql = "SELECT * FROM ".get_table("events");
			if($_GET["title"]) $sqlv[] = " (title LIKE '%".$_GET["title"]."%') ";
			if($_GET["keyword"]) $sqlv[] = " (cprodname LIKE '%".$_GET["keyword"]."%' OR eprodname LIKE '%".$_GET["keyword"]."%' OR jprodname LIKE '%".$_GET["keyword"]."%') ";
			if($_GET["sku"]) $sqlv[] = " sku LIKE '".$_GET["sku"]."%' ";
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

		public function getListByUid($uid,$size=_PAGES)
		{
			$sql = "SELECT * FROM ".get_table("events")." WHERE uid=$uid  ORDER BY id DESC";
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

		public function checkField($field,$value)
		{
			$sql = "SELECT * FROM ".get_table("events")." WHERE $field='$value'";
			$rs = $this->mDb->getone($sql);
			return $rs;
		}

		public function savePost()
		{
			if($_POST["status"]=="1");
			$aid = $_POST["aid"];
			unset($_POST["aid"]);
			foreach ($_POST as $key =>$val)
				{
					if(!in_array($key,array("id","place_traffic")))
					{
						$sqlv[] = " $key = '".sb_addslashes($val)."'";
					}
				}
			if(!$_POST["id"])
			{
				//$sqlv[] = " createtime = '".time()."'";
				$sql = "INSERT INTO ".get_table("events")." SET ".implode(",",$sqlv);

			}
			else
			{
				$sql = "UPDATE ".get_table("events")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
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
			if($rs)$rs = $pid;
			$this->updateAttachments($aid,$pid,"events");
			return $rs;
 		}

 		public function Batch()
	  	{
	  		$i=0;
	  		while ($i<count($_POST["selected"]))
	  		{
	  			if($_POST["more"]=="0")
	  			{
	  				$sql = "DELETE FROM ".get_table("events")." WHERE id=".$_POST["selected"][$i];
	  			}
	  			else if($_POST["more"]=="3")
	  			{
	  				$sql = "UPDATE ".get_table("events")." SET status='1' WHERE id=".$_POST["selected"][$i];
	  			}
	  			else if($_POST["more"]=="4")
	  			{
	  				$sql = "UPDATE ".get_table("events")." SET status='0' WHERE id=".$_POST["selected"][$i];
	  			}
	  			else
	  			{
	  				$sql = "UPDATE ".get_table("events")." SET class_id='".$_POST["class_id"]."' WHERE id=".$_POST["selected"][$i];
	  			}
	  			$rs = $this->mDb->execute($sql);
	  			$i++;
	  		}
	  	}

		public function saveUpdate()
		{
			if(is_array($_POST["seque"]))
			{
				foreach($_POST["seque"] as $key => $val)
		 		{
	 				if($val=="")$val=0;
	 				$sql = "UPDATE ".get_table("events")." SET sequence='".$val."' WHERE id = $key";
		 			$this->mDb->execute($sql);
		 		}
			}
		}

		public function getDropList($type=null,$where)
		{
			$sql = "SELECT * FROM ".get_table("events").$where;
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

		/*更新图片附件*/
		private function updateAttachments($aid,$pid,$utype)
		{
			if(is_array($aid))
			{
				$this ->mDb->execute("UPDATE ".get_table("attachments")." SET pid=0 WHERE utype='$utype' AND pid=".$pid);
				foreach ($aid as $val)
				{
					$sql = "UPDATE ".get_table("attachments")." SET pid='$pid',utype='$utype' WHERE id=".$val;
					$this->mDb->execute($sql);
				}
			}
		}

		/*获取附件*/
		public function getFilebyPid($pid,$limit=0)
		{
			$sql = "SELECT * FROM  ".get_table("attachments")." WHERE pid=$pid AND utype='events'";
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


		public function getStatusList()
		{
			return array(
							0 => "未审核",
							1 => "审核通过",
							2 => "审核未通过",
							3 => "进行中");
		}

		/*
		自定义推荐
		*/
		public function getsbStarList()
		{
			return array(
							0 => "未推荐",
			                1 => "铜牌推荐",
							2 => "银牌推荐",
							3 => "金牌推荐",
							4 => "置顶推荐",
							);
		}

		/*
		酒店星级
		*/
		public function getStarList()
		{
			return array(
							0 => "无",
			                1 => "一星级",
							2 => "二星级",
							3 => "三星级",
							4 => "四星级",
							5 => "五星级",
							6 => "六星级"
							);
		}

		public function getPaystatus()
		{
			return array(
							0 => "未支付",
			                1 => "已支付"
							);
		}

		public function getPayType()
		{
			return array(
							1 => "在线支付",
			                2 => "票到付款",
			                3 => "现场购票",
			                4 => "银行转账",
			                5 => "邮局汇款"
							);
		}

	}

?>