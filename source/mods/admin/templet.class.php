<?php
 	class templet extends Controller 
 	{
 		protected $tpl;
 		public function show()
 		{
 			$this->checkLogin();
 			//$this->mDb->debug = true;
 			include(_APP_PATH."libs/Templet.class.php");
 			$this->tpl = new Templets();
 			$this->tpl->mDb = $this->mDb;
 			if($this->mAction=="save")
 			{
 				$this->save();
 				$this->mLog->adminLog("保存/修改模板"); 
 			}
 			$this->result["sites"]["templets"] = "active";
 			$this->result["sites"]["curr_tpl"] = $this->tpl->mType[$_GET["ttype"]];
 			$this->result["sites"]["ttype"] = $_GET["ttype"];
 			if($this->mAction=="add")
 			{
 				if($this->mPur->adminCheck("SYS_TMPT","2")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				if($this->mPur->adminCheck("SYS_TMPT","3")==false && $_GET["id"])
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
 				if($_GET["id"])
				{
				    $this->result["log"] = $this->tpl->getRow($_GET["id"]);
				    $this->result["log"]["content"] = str_replace(array("<textarea","</textarea>","<TEXTAREA","</TEXTAREA>"),array("&lt;textarea","&lt;/textarea&gt;","&lt;textarea","&lt;/textarea&gt;"),$this->result["log"]["content"]);
				}
				else
				{
					$this->result["log"]["lang"] = "cn";
				}
 				$this->result["typelist"] = $this->tpl->mType;
 				$this->result["logs"] = $this->tpl->gobList("0");
				$this->result["logs_ad"] = $this->tpl->adList();
 				$this->tplname = 'templet_add';
 				$this->mLog->adminLog("添加/编辑模板"); 
 			}
 			else
 			{
	 			if($this->mPur->adminCheck("SYS_TMPT","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
 				include(_APP_PATH."libs/adodb/adodb-pager2.inc.php");
 				$t =  $this->tpl->getList();
				$this->result["logs"] = $t["logs"];
				foreach($this->result["logs"] as $key => $val)
				{
					$this->result["logs"][$key]["utype"] = $this->tpl->mType[$this->result["logs"][$key]["ttype"]];
				}
				$this->result["pages"] = $t["pages"];
	 			$this->tplname = 'templet';
	 			$this->mLog->adminLog("查看模板"); 
 			}
 			$this->Display();
 		}
 		
 		private function save()
 		{
 			$arr_from = array("&lt;textarea","&lt;/textarea&gt;","'");
		 	$arr_to = array("<textarea","</textarea>","\'");
		 	$_POST["content"] = str_replace($arr_from,$arr_to,$_POST["content"]);
	 		if(!$_POST["id"])
	 		{
	 			$sql = "INSERT into templet(title,content,ttype,lang,filename,uid)VALUES('".$_POST["title"]."','".$_POST["content"]."','".$_POST["ttype"]."','".$_POST["lang"]."','".$_POST["filename"]."','".$_SESSION["login_admin"]["id"]."')";
	 			$msg_text = "添加新模板 - ".$_POST["title"];
				$rs = $this->mDb->execute($sql);
				$id = $this->mDb->Insert_ID();
	 		}
	 		else
	 		{
	 			$sql = "UPDATE templet SET ";
				if(!empty($_POST["title"]))
				{
				$sql .=" title='".$_POST["title"]."',";
				}
				if(!empty($_POST["ttype"]))
				{
				$sql .=" ttype='".$_POST["ttype"]."',";
				}
				$_POST["content"] = str_replace("'","‘",$_POST["content"]);
				$sql .="content='".$_POST["content"]."',lang='".$_POST["lang"]."' WHERE id=".$_POST["id"];
				$rs = $this->mDb->execute($sql);
				$id = $_POST["id"];
	 			$msg_text = "修改模板 - ".$_POST["title"];
	 		}
	
	 		if(!$rs)
			 {
				 echo "error";
			 }
			 else
			 {
				$_POST["content"] = str_replace(array('\"',"\'"),array('"',"'"),$_POST["content"]);
			 	if($_POST["ttype"]=="1")
				 {
				 	$this->tpl->Building("global/".$_POST["filename"],$_POST["content"]);
				 }
				elseif($_POST["ttype"]=="2")
				 {
				 	$this->tpl->Building("general/".$_POST["lang"]."/".$_POST["filename"],$_POST["content"]);
				 } 
			 	elseif($_POST["ttype"]=="3" || $_POST["ttype"]=="4")
				 {
				 	$this->tpl->Building("customs/".$id,$_POST["content"]);
				 }
				 elseif($_POST["ttype"]=="5")
				 {
				 	$this->tpl->BuildStyle($_POST["lang"]."/".$_POST["filename"],$_POST["content"]);
				 }
				 else 
				 {
				 	$this->tpl->BuildAll();
				 }
				 //$this->mLog->adminLog($msg_text); 
				  echo "succeed";
			 }
 			die();
 		}
 	}
?>