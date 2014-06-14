<?php
 	class adt extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPurview->adminCheck("PW_ADT","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mAd->getTempletList();
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["lang"] = $this->result["langlist"][$val["lang"]];
				}
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'adt';
	 			$this->mLog->adminLog("查看广告位置列表");
 			
 		}
 		
 		public function del()
 			{
 				if($this->mPurview->adminCheck("PW_ADT","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mAd->TempletDel($_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除广告位置失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除广告位置成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function savePost()
 			{
 				$this->_globals();
 				$rs = $this->mAd->saveTempletPost();
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
 		
 		public function add()
 		{
			$this->_globals();
			if($this->mPurview->adminCheck("PW_ADT","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_ADT","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
 			if($_GET["id"])
			{
				$this->result["log"] = $this->mAd->getTempletRow($_GET["id"]);
			}
			$this->result["statuslist"] = array(
									1 => "启用",
									0 => "关闭");
			$this->tplname = 'adt_add';
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Ad"));
 			$this->result["sites"]["advs"] = "selected";
 			$this->result["sites"]["title"] = "广告位置";
 			$this->result["sites"]["url"] = encrypt("adt");
 		}
 	}
?>