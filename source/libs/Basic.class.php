<?php

	class Basics
	{
		public $mDb;

		public function __construct()
		{
			//$this->mDb->debug = true;
		}

		public function getList($table,$where,$size=_PAGES)
		{
			$sql = "SELECT * FROM ".get_table($table);
			if($where)$sql .=" WHERE ".implode("AND",$where);
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

		public function getNavList($table,$where,$limit=10)
		{
			$sql = "SELECT * FROM ".get_table($table);
			if($where)
			{
				$sql .= " WHERE $where";
			}
			$sql .= " LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function cateList($table,$type=null , $where,$name='catename')
		{
			$sql = "SELECT * FROM ".get_table($table);
			if($where)
			{
				$sql .= " WHERE $where";
			}
			$rs = $this->mDb->getall($sql);
			if(!empty($type))
			{
				$cate = array();
				foreach ($rs as $val)
					{
						$cate[$val["id"]] = $val["$name"];
					}
				$rs = $cate;
			}
			return $rs;
		}

		public function getCateTotal($table,$where)
		{
			$sql = "SELECT count(*) FROM ".get_table($table);
			if($where)
			{
				$sql .= " WHERE $where";
			}
			$rs = $this->mDb->getone($sql);
			return $rs;
		}


		public function getCateListByID($table,$pid=0,$type=null)
		{
			$sql = "SELECT * FROM ".get_table($table) ." WHERE pid=$pid";
			$rs = $this->mDb->getall($sql);
			if(!empty($type))
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

		public function cateList2($table,$type=null)
		{
			$sql = "SELECT * FROM ".get_table($table);
			$rs = $this->mDb->getall($sql);
			if(!empty($type))
			{
				$cate = array();
				foreach ($rs as $val)
					{
						$cate[$val["id"]] = $val["content"].$val["catename"];
					}
				$rs = $cate;
			}
			return $rs;
		}

		public function cateDropList($table,$sid=0,$pid=0,$blank)
		{
			//$str = "";
			$blank = "&nbsp;&nbsp;".$blank;
			$sql = "SELECT * FROM ".get_table($table)." WHERE pid=$pid";
			$rs = $this->mDb->getall($sql);
			//if($pid==0) $str .= "<option value=\"0\">|根</option>";
			foreach ($rs as $vul)
			{
				$str .= "<option ";
				if($sid == $vul["id"])
				{
					$str .= " selected ";
				}
				$str .= "value=\"".$vul["id"]."\">".$blank."|-".$vul["name"]."</option>";
				$str .= $this->cateDropList($table,$sid,$vul["id"],$blank);
			}
			return $str;
		}

		public function getName($table,$id,$name='catename')
		{
			$sql = "SELECT $name FROM ".get_table($table)." WHERE id=".$id;
			$rs = $this->mDb->getone($sql);
			return $rs;
		}

		public function getMax($table)
		{
			$sql = "SELECT max(id) FROM ".get_table($table)."";
			$id = $this->mDb->getone($sql);
			return $id;
		}

		public function savePost($table)
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
				$sql = "INSERT INTO ".get_table($table)." SET ".implode(",",$sqlv);

			}
			else
			{
				$sql = "UPDATE ".get_table($table)." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			return $rs;
		}

		public function Del($table,$id)
		{
			$rs = $this->mDb->execute("DELETE FROM ".get_table($table)." WHERE id=".$id);
			return $rs;
		}

		public function getRow($table,$id)
		{
			$sql = "SELECT * FROM ".get_table($table)." WHERE id=".$id;
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		public function getCityDorpList($pid=0,$type=null)
		{
			$sql = "SELECT * FROM ".get_table("citys")." WHERE pid=$pid";
			$rs = $this->mDb->getall($sql);
			if(!empty($type))
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

		public function getCitybyId($id)
		{
			$sql = "SELECT name FROM ".get_table("citys")." WHERE id=$id";
			$name = $this->mDb->getone($sql);
			return $name;
		}

		//按多个逗号分隔ID值查询名称
		public function getNames($table,$idstr,$name='name')
		{
			$sql = "SELECT $name FROM ".get_table($table)." WHERE id in (".$idstr.") ";
			$rs = $this->mDb->getall($sql);
			for($i=0;$i<count($rs);$i++){
			$names[]= $rs[$i][$name];
			}
			$rsstr = implode("、",$names);
			return $rsstr;
		}

		public function getID($table,$where)
		{
			$sql = "SELECT id FROM ".get_table($table)." WHERE ".$where;
			$rs = $this->mDb->getone($sql);
			return $rs;
		}

		public function checkField($tables,$field,$value)
		{
			$sql = "SELECT * FROM ".get_table($tables)." WHERE $field='$value'";
			$rs = $this->mDb->getone($sql);
			return $rs;
		}
	}

?>