<?php
 	class ask extends Controller
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
				$r = $this->mAsk->getList();
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["status"] = $this->result["statuslist"][$val["is_done"]];
					$r["logs"][$key]["classname"] = $this->mAsk->getCateName($val["class_id"]);
				}
				$this->result["catelist"] = $this->mAsk->cateDropList();
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'ask';
	 			$this->mLog->adminLog("查看内容列表");

 		}

 		public function del()
 			{
 				$this->_globals();
 				if($this->mPurview->adminCheck("PW_CONTS","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mAsk->Del($_POST["id"]) == false)
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



 		public function batch()
 			{
 				$this->_globals();
 				$rs = $this->mAsk->Batch();
		 		$this->mLog->adminLog("批量移动/删除问答内容");
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

 		 public function check()
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
				$this->result["log"] = $this->mBasic->getRow("asks",$_GET["id"]);
				echo $this->result["log"]["uname"] = $this->mBasic->getName("customers","truename",$this->result["log"]["uid"]);
			}

			$this->result["catelist"] = $this->mAsk->cateDropList($this->result["log"]["class_id"]);

			$this->tplname = 'ask_check';
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","Article","Ask"));
 			$this->result["statuslist"] = $this->mAsk->getStatusList();
 			$this->result["recommendlist"] = $this->mAsk->getrecommendList();
 			$this->result["sites"]["trains"] = "selected";
 			$this->result["sites"]["title"] = "问答";
 			$this->result["sites"]["url"] = encrypt("article");
 		}
 	}
?>
