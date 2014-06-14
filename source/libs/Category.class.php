<?php
	class Categorys
	{
		public $mDb;
		public $mTable;

		public function __construct()
		{
			$this->mTable = "categorys";
		}

		public function cateList($blank,$pid=0)
		{
			//$str = "";
			$blank = "&nbsp; &nbsp;".$blank;
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE pid=$pid ORDER BY sequence DESC";
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
				$str .= ">&nbsp;<a href='?m=".encrypt("product")."&cateid=".$vul["id"]."'>".$vul["cname"]."</a></td>
		   		<td>".$vul["ename"]."</td>
		   		<td>".$vul["jname"]."</td>
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

		public function getPidList($pid=0)
		{
			if(empty($pid))$pid=0;
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE pid=$pid ORDER BY sequence DESC";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function cateDropList($sid=0,$pid=0,$blank)
		{
			//$str = "";
			$blank = "&nbsp;&nbsp;".$blank;
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE pid=$pid ORDER BY sequence DESC";
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

		public function cateDropList2($sid=0,$pid=0,$blank)
		{
			//$str = "";
			$blank = "&nbsp;".$blank;
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE pid=$pid";
			$rs = $this->mDb->getall($sql);
			//if($pid==0) $str .= "<option value=\"0\">|根</option>";
			foreach ($rs as $vul)
			{
				$str .= "<option ";
				if($sid == $vul["id"])
				{
					$str .= " selected ";
				}
				$str .= "value=\"".$vul["id"]."\">".$blank.$vul["cname"]."</option>";
				if($vul["childnum"]>0)
				{
					$str .= $this->cateDropList2($sid,$vul["id"],$blank);
				}
			}
			return $str;
		}

		public function cateTwoList($id="0")
		{
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE pid=$id";
			$rs = $this->mDb->getall($sql);
			foreach ($rs as $key => $val)
			{
				if($val["childnum"]>0)
				{
					$str = null;
					$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE pid=".$val["id"];
					$childs = $this->mDb->getall($sql);
					foreach ($childs as $vul)
					{
						$str .= "<li ";
						if ($_GET["cate"]==$vul["unikey"])
						{
							$str .= " class=\"nav_on\" ";
						}
						$str .= " ><a href=\""._URL_."/".$_GET["lang"]."/".$vul["unikey"]."/\" class=\"link14\">".$vul["cname"]."</a></li>";
					}
					$rs[$key]["childs"] = $str;
				}
			}
			return $rs;
		}

		public function cateTwoListPrent($id)
		{
			if($id>0)
			{
				$sql = "SELECT pid FROM ".get_table($this->mTable)." WHERE id=$id";
				$id  = $this->mDb->getone($sql);
			}

			return $this->cateTwoList($id);
		}

		public function getCateList($pid=0,$type=null)
		{
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE pid=$pid";
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
			else
			{
				foreach ($rs as $key=>$val)
					{
						$rs[$key]["childnum"] = $this->mDb->getone("SELECT count(id) FROM ".get_table($this->mTable)." WHERE pid=".$val["id"]);
					}
			}
			return $rs;
		}


		public function getNavCateList($pid=0)
		{
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE pid=$pid ORDER BY sequence DESC";
			$rs = $this->mDb->getall($sql);

			foreach ($rs as $key =>$val)
				{
					$pos = array("/"," ","%","'",",",".","\"");
					$rs[$key]["urlkey"] = str_replace($pos,"-",$val["ename"]);
				}
			return $rs;
		}



		/**
		 * 活动父级id信息
		 * */
		public function getCateParentList($pid,$cate)
		{
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE id=$pid ORDER BY sequence DESC";
			$rs = $this->mDb->getrow($sql);
			$cate[] =  $rs;
			if($rs["pid"]){$cate=$this->getCateParentList($rs["pid"],$cate);}
			return $cate;
		}

		public function getAllNavCateList($pid=0)
		{
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE pid=$pid AND id!=944 ORDER BY sequence DESC";
			$rs = $this->mDb->getall($sql);
			foreach ($rs as $key =>$val)
				{
					$pos = array("/"," ","%","'",",",".","\"");
					$rs[$key]["urlkey"] = str_replace($pos,"-",$val["ename"]);
					if($val["childnum"]>0)
					{
						$rs[$key]["child"] = $this->getAllNavCateList($val["id"]);
					}
					if($val["brands"])
					{
						$rs[$key]["brandlist"] = $this->getNavBrandList($val["brands"]);
					}
				}
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

		public function getCateChildId($pid=0)
		{
			$child_id = array();
			$child_id[] = $pid;
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE pid=$pid";
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
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE pid=$pid";
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
				$sql = "INSERT INTO ".get_table($this->mTable)." SET ".implode(",",$sqlv);

			}
			else
			{
				$sql = "UPDATE ".get_table($this->mTable)." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			if($_POST["pid"]!=0)
			{
				$this->upChildNum($_POST["pid"],"+1");
			}
			return $rs;
 		}

		public function saveUpdate()
		{
			if(is_array($_POST["seque"]))
			{
				foreach($_POST["seque"] as $key => $val)
		 		{
	 				if($val=="")$val=0;
	 				$sql = "UPDATE ".get_table($this->mTable)." SET sequence='".$val."' WHERE id = $key";
		 			$this->mDb->execute($sql);
		 		}
			}
		}

		public function getName($id)
		{
			$sql = "SELECT cname FROM ".get_table($this->mTable)." WHERE id=".$id;
			$rs = $this->mDb->getone($sql);
			return $rs;
		}

		public function getUnikey($id)
		{
			$sql = "SELECT unikey FROM ".get_table($this->mTable)." WHERE id=".$id;
			$rs = $this->mDb->getone($sql);
			return $rs;
		}

		public function getMax($table)
		{
			$sql = "SELECT max(id) FROM $table";
			$id = $this->mDb->getone($sql);
			return $id;
		}

		public function Del($id)
		{
			$rs = $this->mDb->execute("DELETE FROM ".get_table($this->mTable)." WHERE id=".$id);
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
			$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE id=".$id;
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}

		public function upChildNum($id,$aciton)
		{
			$sql = "UPDATE ".get_table($this->mTable)." SET childnum = childnum $aciton  WHERE id=".$id;
			$this->mDb->execute($sql);
		}

	   public function getTopcate($id)
	   {
	   		$sql = "SELECT * FROM ".get_table($this->mTable)." WHERE id=".$id;
	   		$rs = $this->mDb->getRow($sql);
	   		$pos = array("/"," ","%","'",",",".","\"");
			$rs["urlkey"] = str_replace($pos,"-",$rs["ename"]);
			$nav = " > <a href='/".$_GET["lang"]."/".$rs["urlkey"]."-".$rs["id"].".html'>".$rs["cname"]."</a>".$nav;
	   		if($rs["pid"]!=0)
	   		{
	   			$rs = $this->getTopcate($rs["pid"]);
	   			$nav = $rs["nav"].$nav;
	   		}
	   		$rs["nav"] = $nav;
	   		return $rs;
	   }

	}

?>