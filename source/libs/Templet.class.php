<?php
	class Templets
	{
		public $mDb;
		public $mType;
		protected $mVarBegin = '<!-- ~ ';
		protected $mVarEnd = ' ~ -->';
		protected $mTpl;
		
		public function __construct()
		{
			//$this->mDb->debug = true;
			$this->getType();
		}
		
		public function getList()
	  	{
	  		$sql = " SELECT t1. * , t2.admin AS username FROM templet t1,admins t2 WHERE t1.uid = t2.id ";
	  		if($_GET["ttype"]=="0")
	  		{
	  			$sql .= " AND ttype=0";
	  		}
	  		elseif($_GET["ttype"])
	  		{
	  			$sql .= " AND ttype=".$_GET["ttype"];
	  		}
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
	  	
	  	public function getRow($id)
	  	{
	  		$sql = "SELECT * FROM templet WHERE id=".$id;
	  		$rs = $this->mDb->getrow($sql);
	  		return $rs;
	  	}

		private function getOne($title)
	  	{
	  		$sql = "SELECT content FROM templet WHERE title='".$title."'";
	  		$rs = $this->mDb->getone($sql);
	  		return $rs;
	  	}
	  	
	  	public function Del($id)
	  	{
	  		$sql = "DELETE FROM templet WHERE id=".$id;
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

		public function cateList($t,$lang)
		{
			$sql = "SELECT * FROM templet WHERE ttype = $t ";
			if($lang)
			{
				$sql .= " AND lang='$lang'";
			}
			$sql .=" ORDER BY id ASC";
			$rs = $this->mDb->getall($sql);
			$cate = array();
				foreach ($rs as $val)
					{
						$cate[$val["id"]] = $val["title"];
					}
			return $cate;
		}

		public function gobList($t)
		{
			$sql = "SELECT title FROM templet WHERE ttype = $t ";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}
		
		public function adList($t)
		{
			$sql = "SELECT title,unikey FROM advts";
			$rs = $this->mDb->getall($sql);
			return $rs;
		}

		public function Building($id,$str)
		{
			mkpath(dirname(_TPL_PATH."/".$id.".tpl"));
			$this->mTpl = $str;
			foreach ($this->Analyse() as $v) {
				$tmp1[] = $this->mVarBegin.$v.$this->mVarEnd;
				$tmp2[] = $this->getOne($v);
			}
			$str = str_replace($tmp1,$tmp2,$this->mTpl);
			$str = str_replace("‘","'",$str);
			$str = str_replace("\'","'",$str);
			$fp=fopen(_TPL_PATH."/".$id.".tpl","wb");
			fwrite ($fp,$str);
			fclose($fp);
		}
		
		public function BuildStyle($id,$str)
		{
			mkpath(dirname(_CSS_PATH.$id.".css"));
			$fp=fopen(_CSS_PATH.$id.".css","wb");
			$str = str_replace("‘","'",$str);
			$str = str_replace("\'","'",$str);
			fwrite ($fp,$str);
			fclose($fp);
		}
			

		private function Analyse() 
		{
			
			$VarReg = "|$this->mVarBegin([^}\n]+)$this->mVarEnd|U";
			if (!preg_match_all($VarReg, $this->mTpl, $vars , PREG_SET_ORDER)) {
				return null;
			}
			$tmp = array();
			foreach ($vars as $v) {
				$tmp[$v[1]] = '';//防止有重复的标签
			}
			return array_keys($tmp);
		}

		public function BuildAll()
		{
			$sql = "SELECT id,content,filename,ttype,lang FROM templet WHERE ttype>0";
	  		$rs = $this->mDb->getall($sql);
			foreach($rs as $v)
			{
				if($v["ttype"]=="1")
				 {
				 	$this->Building("global/".$v["filename"],$v["content"]);
				 }
				elseif($v["ttype"]=="2")
				 {
				 	$this->Building("general/".$v["lang"]."/".$v["filename"],$v["content"]);
				 } 
			 	elseif($v["ttype"]=="3" || $v["ttype"]=="4")
				 {
				 	$this->Building("customs/".$v["id"],$v["content"]);
				 }
				 elseif($v["ttype"]=="5")
				 {
				 	$this->Building("ads/".$id,$v["content"]);
				 }
			}
		}
		
		private function getType()
		{
			$this->mType = array(0=>"标签",
			                     1=>"全局",
			                     2=>"系统",
			                     3=>"列表",
			                     4=>"内容",
			                     5=>"css");
		}
	}
?>