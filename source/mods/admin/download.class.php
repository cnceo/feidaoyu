<?php
 	class download extends Controller
 	{
 		protected $tpl;

 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPurview->adminCheck("PW_CONTS","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mBasic->getList("download");
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["status"] = $this->result["statuslist"][$val["status"]];
					
					$r["logs"][$key]["classname"] = $this->mArticle->getCateName($val["class_id"]);
				}
				$this->result["catelist"] = $this->mArticle->cateDropList();
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'download';
	 			$this->mLog->adminLog("查看内容列表");

 		}

 		public function del()
 			{
 				$this->_globals();
 				if($this->mPurview->adminCheck("PW_CONTS","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mArticle->Del($_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除内容失败");
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除内容成功");
				 	echo "succeed";
				 }
 				die();
 			}

 		public function savePost()
 			{
 				$this->_globals();
 				$rs = $this->mBasic->savePost("download");
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("添加/编辑资源成功");
 				}
 				else
 				{
 					$msg["status"] = "false";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("添加/编辑资源失败");
 				}
 				echo json_encode($msg);
 				die();
 			}

 		public function batch()
 			{
 				$this->_globals();
 				//$rs = $this->mArticle->Batch();
 					$i=0;
		  		while ($i<count($_POST["selected"]))
		  		{
		  			if($_POST["more"]=="0")
		  			{
		  				$sql = "DELETE FROM ".get_table("download")." WHERE id=".$_POST["selected"][$i];
		  			}
		  			else
		  			{
		  				$sql = "UPDATE ".get_table("download")." SET class_id='".$_POST["class_id"]."' WHERE id=".$_POST["selected"][$i];
		  			}
		  			$rs = $this->mDb->execute($sql);
		  			$i++;
		  		}
		 		$this->mLog->adminLog("批量移动/删除内容");
 				/*if($rs)
 				{
 					$msg["status"] = "true";
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";

 				}
 				echo json_encode($msg);*/
 				die();
 			}

 		public function add()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_CONTS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_CONTS","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}

			if($_GET["cateid"])
			{
				$this->result["log"]["class_id"] = $_GET["cateid"];
			}

			if($_GET["id"])
			{
				$this->result["log"] = $this->mArticle->getRow($_GET["id"]);
			}

			$this->result["catelist"] = $this->mArticle->cateDropList($this->result["log"]["class_id"]);

			$this->tplname = 'download_add';
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","Article"));
 			$this->result["statuslist"] = $this->mArticle->getStatusList();
 			$this->result["langlist"] = $this->mArticle->getlangList();
 			$this->result["sites"]["trains"] = "selected";
 			$this->result["sites"]["title"] = "资源下载";
 			$this->result["sites"]["url"] = encrypt("article");
 		}
 	}
?>
