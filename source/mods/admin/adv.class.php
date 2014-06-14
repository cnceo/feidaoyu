<?php
 	class adv extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPurview->adminCheck("PW_ADS","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mAd->getAdvList();
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["lang"] = $this->result["langlist"][$val["lang"]];
				}
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'adv';
	 			$this->mLog->adminLog("查看广告列表列表");
 		}
 		
 		public function del()
 			{
 				$this->_globals();
 				if($this->mPurview->adminCheck("PW_ADS","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mAd->AdvDel($_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除广告列表失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除广告列表成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function savePost()
 			{
 				$this->_globals();
 				$rs = $this->mAd->saveAdvPost();
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
 			if($this->mPurview->adminCheck("PW_ADS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_ADS","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($_GET["id"])
			{
				$this->result["log"] = $this->mAd->getAdvRow($_GET["id"]);
			}
			$this->result["adtlist"] = $this->mAd->getTempletDrop();
			$this->result["statuslist"] = array(
									1 => "启用",
									0 => "关闭");
			$this->tplname = 'adv_add';
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Ad"));
 			//$this->result["langlist"] = $this->mArt->getlangList();
 			$this->result["sites"]["advs"] = "selected";
 			$this->result["sites"]["title"] = "广告列表";
 			$this->result["sites"]["url"] = encrypt("adv");
 		}
 	}
?>