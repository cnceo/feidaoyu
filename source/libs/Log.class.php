<?php
	/**
	* Log 日志记录类
	* @package   Seasoft
	* @Author by Vince Shen<vinceshen@live.com>
	* @version  v1.0
	*/
	class Logs
	{
		public $mDb;
		
		public function __construct()
		{
			$this->mDb->debug = true;
		}
		
		public function getList()
		{
			$sql = "SELECT * FROM ".get_table("logs");
			if (!empty($_GET["stime"])) $w[] = "addtime >= '".$_GET["stime"]." 00:00:00'";
			if (!empty($_GET["etime"])) $w[] = "addtime <= '".$_GET["etime"]." 23:59:59'";
			if (!empty($_GET["utype"])) $w[] = "utype = '".$_GET["utype"]."'";
			if (!empty($_GET["uname"]))  $w[] = "uname like '".$_GET["uname"]."'";
			if($w)
			{
				$sql .= " WHERE ";
	  		if(is_array($w))
	  		{
	  			$sql .= implode(" AND ",$w);
	  		}
			}
			$sql .= " ORDER BY id DESC";
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
		/**
		 * Create time : 6/6/2008
		 * Last modify : 6/6/2008
		 * @param  array $uerinfo
		 * @param text $text
		 */
		public function adminLog($text)
		{
			$sql = "INSERT INTO ".get_table("logs")." (uid,utype,uname,content)Values('".$_SESSION["login_admin"]["id"]."','admin','".$_SESSION["login_admin"]["admin"]."','$text')";
			$this->mDb->execute($sql);
		}
	
		public function userLog($text)
		{
			$sql = "INSERT INTO ".get_table("logs")." (uid,utype,uname,content)Values('".$_SESSION["login_user"]["id"]."','admin','".$_SESSION["login_user"]["username"]."','$text')";
			$this->mDb->execute($sql);
		}
	}
?>