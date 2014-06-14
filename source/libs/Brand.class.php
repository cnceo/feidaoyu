<?php
	class Brands
	{
		public $mDb;

		public function __construct()
		{
			//$this->mDb->debug = true;
		}

		public function getList()
		{
			$blank = "&nbsp; &nbsp;".$blank;
			$sql = "SELECT * FROM ".get_table("brands")."  ORDER BY sequence DESC";
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

		public function getAllBrandList()
		{
			$sql = "SELECT * FROM ".get_table("brands")."  ORDER BY sequence DESC";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function getNavBrandList($ids)
		{
			$sql = "SELECT * FROM ".get_table("brands")." WHERE id IN($ids)";
			$rs = $this->mDb->getall($sql);

			foreach ($rs as $key =>$val)
				{
					$pos = array("/"," ","%","'",",",".","\"");
					$rs[$key]["urlkey"] = str_replace($pos,"-",$val["ename"]);
				}
			return $rs;
		}


		public function savePost()
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
				$sql = "INSERT INTO ".get_table("brands")." SET ".implode(",",$sqlv);

			}
			else
			{
				$sql = "UPDATE ".get_table("brands")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			return $rs;
 		}

		public function saveUpdate()
		{
			if(is_array($_POST["seque"]))
			{
				foreach($_POST["seque"] as $key => $val)
		 		{
	 				if($val=="")$val=0;
	 				$sql = "UPDATE ".get_table("brands")." SET sequence='".$val."' WHERE id = $key";
		 			$this->mDb->execute($sql);
		 		}
			}
		}

		public function Del($id)
		{
			$rs = $this->mDb->execute("DELETE FROM ".get_table("brands")." WHERE id=".$id);
			if(!$rs)
			{
				return false;
			}
			else
			{
				return true;
			}
		}

		public function getRow($id)
		{
			$sql = "SELECT * FROM ".get_table("brands")." WHERE id=".$id;
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		public function getDropList($type=null,$where)
		{
			$sql = "SELECT * FROM ".get_table("brands").$where;
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

	}

?>