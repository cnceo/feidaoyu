<?php
	class Asks
	{
		public $mDb;

		public function __construct()
		{
			//$this->mDb->debug = true;
		}

		public function cateList($blank,$pid=0)
		{
			//$str = "";
			$blank = "&nbsp; &nbsp;".$blank;
			$sql = "SELECT * FROM ".get_table("ask_cates")." WHERE pid=$pid ORDER BY sequence DESC";
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
				$str .= ">&nbsp;<a href='?m=".encrypt("ask")."&cateid=".$vul["id"]."'>".$vul["cname"]."</a></td>
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
				$str .= $this->cateList($blank,$vul["id"]);
			}
			return $str;
		}

		public function getList($size=_PAGES)
		{
			$sql = "SELECT * FROM ".get_table("asks");
			if($_GET["title"]) $sqlv[] = " (title LIKE '%".$_GET["title"]."%') ";
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

		public function getNavCateList($pid=0)
		{
			$sql = "SELECT * FROM ".get_table("ask_cates")." WHERE pid=$pid ORDER BY sequence DESC";
			$rs = $this->mDb->getall($sql);

			foreach ($rs as $key =>$val)
			{
				$pos = array("/"," ","%","'",",",".","\"");
				$rs[$key]["urlkey"] = str_replace($pos,"-",$val["ename"]);
				$rs[$key]["child"] = $this->getNavCateList($val["id"]);
			}
			return $rs;
		}

		public function getCateRow($id)
		{
			$sql = "SELECT * FROM ".get_table("ask_cates")." WHERE id=".$id;
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		public function getSolveList($limit=3)
		{

			$sql = "SELECT * FROM ".get_table("asks")." WHERE is_done=1 LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function getNotSolveList($limit=3)
		{
			$sql = "SELECT * FROM ".get_table("asks")." WHERE is_done=0 LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function getAskList($limit=3,$where,$order)
		{
			$sql = "SELECT * FROM ".get_table("asks");
			if($where)$sql .=" WHERE ".implode("AND",$where);
			if($order)$sql." ORDER BY $order ";
			$sql.=" LIMIT $limit";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function getCateName($id,$field="ename")
		{
			$sql = "SELECT $field FROM ".get_table("ask_cates")." WHERE id=".$id;
			$rs = $this->mDb->getone($sql);
			return $rs;
		}

	    public function cateDropList($sid=0,$pid=0,$blank)
		{
			//$str = "";
			$blank = "&nbsp;&nbsp;".$blank;
			$sql = "SELECT * FROM ".get_table("ask_cates")." WHERE pid=$pid ORDER BY sequence DESC";
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

				$str .= $this->cateDropList($sid,$vul["id"],$blank);

			}
			return $str;
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
				$sql = "INSERT INTO ".get_table("asks")." SET ".implode(",",$sqlv).",addtime='".time()."'";

			}
			else
			{
				$sql = "UPDATE ".get_table("asks")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			return $rs;
 		}

	    public function Batch()
	  	{
	  		$i=0;
	  		while ($i<count($_POST["selected"]))
	  		{
	  			if($_POST["more"]=="0")
	  			{
	  				$sql = "DELETE FROM ".get_table("asks")." WHERE id=".$_POST["selected"][$i];
	  			}
	  			else
	  			{
	  				$sql = "UPDATE ".get_table("asks")." SET class_id='".$_POST["class_id"]."' WHERE id=".$_POST["selected"][$i];
	  			}
	  			$rs = $this->mDb->execute($sql);
	  			$i++;
	  		}
	  	}

	  	public function Del($id)
	  	{
	  		$sql = "DELETE FROM ".get_table("asks")." WHERE id=".$id;
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

		public function getStatusList()
		{
			return array(
							0 => "待解决",
							1 => "已解决",
							2=> "紧急问题"
							);
		}

		/*
		自定义推荐
		*/
		public function getrecommendList()
		{
			return array(
							0 => "未推荐",
			                1 => "推荐"
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

	}

?>