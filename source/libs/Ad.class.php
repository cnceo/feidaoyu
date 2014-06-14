<?php
class Ads
{
	public $mDb;

	public function getTempletList($size=_PAGES)
	{
		$sql = "SELECT * FROM ".get_table("adt");
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

	public function getAd($label,$type=null)
	{
		$sql = "SELECT t1.*,t2.content as template FROM ".get_table("adv")." t1 ,".get_table("adt")." t2 WHERE t1.starttime <= date_format( NOW( ) , '%Y%m%d' )
		        AND t1.endtime >= date_format( NOW( ) , '%Y%m%d' ) AND t1.status=1 AND t2.status=1 AND t1.aid=t2.id  AND t2.tagname='$label'";
		if($type=="list")
		{
			$rs = $this->mDb->getall($sql);
			/*foreach ($rs as $val)
			{
				$template = $val["template"];
				$tmp["title"][] = $val["title"];
				$tmp["link"][] = $val["link"];
				if($val["picpath"])
				{
					$tmp["imglink"][] = IMG_HOST.$val["picpath"];
				}else
				{
					$tmp["imglink"][] = $val["imglink"];
				}
			}
			$tmp["title"] = implode("|",$tmp["title"]);
			$tmp["link"] = implode("|",$tmp["link"]);
			$tmp["imglink"] = implode("|",$tmp["imglink"]);
			$rs = $tmp;*/
		}
		else
		{
			$rs = $this->mDb->getrow($sql);
			/*$template = $rs["template"];
			if($rs["picpath"])
			{
				$rs["imglink"][] = IMG_HOST.$rs["picpath"];
			}*/
		}

		$template = str_replace("\'","'",$template);
		//$ad = str_replace(array("[[link]]","[[file]]","[[title]]"),array($rs["link"],$rs["imglink"],$rs["title"]),$template);
		return $rs;
		return $ad;
	}

	public function getTempletDrop()
	{
		$sql = "SELECT * FROM ".get_table("adt")."  ORDER BY id DESC";
		$rs = $this->mDb->getall($sql);
		$cate = array();
		foreach ($rs as $val)
			{
				$cate[$val["id"]] = $val["title"]." ".$val["lang"];
			}
		$rs = $cate;
		return $rs;
	}

  	public function saveTempletPost()
	{
		foreach ($_POST as $key =>$val)
			{
				if(!in_array($key,array("id")))
				{
					$val = str_replace("'","\'",$val);
					$sqlv[] = " $key = '".sb_addslashes($val)."'";
				}
			}
		if(!$_POST["id"])
		{
			$sql = "INSERT INTO ".get_table("adt")." SET ".implode(",",$sqlv);

		}
		else
		{
			$sql = "UPDATE ".get_table("adt")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
		}
		$rs = $this->mDb->execute($sql);
		return $rs;
	}

	public function getTempletRow($id)
	{
		$sql = "SELECT * FROM ".get_table("adt")." WHERE id =".$id;
		$rs = $this->mDb->getRow($sql);
		return $rs;
	}

	public function TempletDel($id)
	{
		$sql = "DELETE FROM ".get_table("adt")." WHERE id =".$id;
		$rs = $this->mDb->execute($sql);
		return $rs;
	}

	public function getAdvList($size=_PAGES)
	{
		$sql = "SELECT * FROM ".get_table("adv");
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

	public function saveAdvPost()
	{
		foreach ($_POST as $key =>$val)
			{
				if(!in_array($key,array("id")))
				{
					$sqlv[] = " $key = '".sb_addslashes($val)."'";
				}
			}
		if(!$_POST["id"])
		{
			$sql = "INSERT INTO ".get_table("adv")." SET ".implode(",",$sqlv);

		}
		else
		{
			$sql = "UPDATE ".get_table("adv")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
		}
		$rs = $this->mDb->execute($sql);
		return $rs;
	}

	public function getAdvRow($id)
	{
		$sql = "SELECT * FROM ".get_table("adv")." WHERE id =".$id;
		$rs = $this->mDb->getRow($sql);
		return $rs;
	}

	public function AdvDel($id)
	{
		$sql = "DELETE FROM ".get_table("adv")." WHERE id =".$id;
		$rs = $this->mDb->execute($sql);
		return $rs;
	}

}
?>