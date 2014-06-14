<?php
 	class directmail extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			if($this->mPur->adminCheck("PW_DM","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
 			$this->tplname = 'directmail';
 			$this->mLog->adminLog("查看邮件列表");
 		}
 		
 		public function mass()
 		{
 			$this->pageinfo();
 			$this->result["cglist"] = $this->mClient->getGroupDropList("t");
 			
 			$sql = "SELECT * FROM ".get_table("template")." WHERE type=1";
			$rs = $this->mDb->getall($sql);
			foreach ($rs as $val)
				{
					$this->result["tpllist"][$val["id"]] = $val["title"];
				} 			
 			$this->tplname = 'directmail_mass';
 			$this->mLog->adminLog("查看邮件列表");
 		}
 		
 		public function logs()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$sql = "SELECT * FROM ".get_table("msg_log"); 
 			if (!empty($_GET["stime"])) $w[] = "addtime >= '".$_GET["stime"]." 00:00:00'";
			if (!empty($_GET["etime"])) $w[] = "addtime <= '".$_GET["etime"]." 23:59:59'";
			if (!empty($_GET["uname"]))  $w[] = "uname like '".$_GET["uname"]."'";
			if($w)
			{
				$sql .= " WHERE ";
	  		if(is_array($w))
	  		{
	  			$sql .= implode(" AND ",$w);
	  		}
			}
 			$sql .=" ORDER BY addtime DESC";
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
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
 			$this->tplname = 'directmail_logs';
 			$this->mLog->adminLog("查看邮件列表");
 		}
 		
 		public function templetsave()
 		{
 			$sqlv[] = " type = '1'";
 			foreach ($_POST as $key =>$val)
			{
				if(!in_array($key,array("id")))
				{
					$sqlv[] = " $key = '$val'";
				} 
			}
			if(!$_POST["id"])
			{
				$sql = "INSERT INTO ".get_table("template")." SET ".implode(",",$sqlv);
				
			}
			else
			{
				$sql = "UPDATE ".get_table("template")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			}
			$rs = $this->mDb->execute($sql);
			if($rs)
			{
				$msg["status"] = "true";
			}
			else
			{
				$msg["false"] = "true";
				$msg["message"] = "保存错误，请联系管理员";
				
			}
			echo json_encode($msg);
			die();
 		}
 		
 		public function setting()
 		{
 			$this->pageinfo();
 			$this->result["log"] = $this->mSite->get();
 			$this->tplname = 'directmail_setting';
 			$this->mLog->adminLog("查看邮件列表");
 		}
 		
 		public function templet()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$sql = "SELECT * FROM ".get_table("template")." WHERE type=1 ORDER BY id DESC";
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
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
			if($_GET["id"])
			{
				$sql = "SELECT * FROM ".get_table("template")." WHERE type=1 AND id=".$_GET["id"];
				$this->result["log"] = $this->mDb->getrow($sql);
			}
 			$this->tplname = 'directmail_templet';
 			$this->mLog->adminLog("查看邮件列表");
 		}
 	
 		public function send()
 		{
 			
			$sql = "INSERT INTO ".get_table("msg_log")." SET uid='".$_SESSION["login_admin"]["id"]."',uname='".$_SESSION["login_admin"]["username"]."',msgtext='".$_POST["message"]."',msgresult='$output',mobile='".$_POST["mobile"]."'";
    		$this->mDb->execute($sql);
 			die();
 		}
 		
 		public function del()
		{
			if($this->mPur->adminCheck("PW_DM","4")==false)
		 	{
		 		die("Permission denied");
		 	}
			$sql = "DELETE FROM ".get_table("template")." WHERE type=1 AND id=".$_GET["id"];
			$rs = $this->mDb->execute($sql);
			if($rs)
			{
				echo "succeed";
			}
			else
			{
				echo "error";
			}
			die();
		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["sales"] = "selected";
 			$this->result["sites"]["title"] = "邮件管理";
 			$this->result["sites"]["url"] = encrypt("keyword");
 		}
 	}
?>