<?php
 	class askcate extends Controller
 	{
 		protected $tpl;

 		public function defshow()
 		{
 			$this->_globals();
 			if($this->mPurview->adminCheck("PW_CONTC","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->result["logs"] = $this->mAsk->cateList();
 			$this->tplname = 'askcate';
 			$this->mLog->adminLog("查看内容分类列表");

 		}

 		public function del()
 			{
 				$this->_globals();
 				if($this->mPurview->adminCheck("PW_CONTC","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mBasic->Del("ask_cates",$_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除内容分类失败");
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除内容分类成功");
				 	echo "succeed";
				 }
 				die();
 			}

 		public function savePost()
 			{
 				$this->_globals();
 				$rs = $this->mBasic->savePost("ask_cates");
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("添加/编辑内容分类成功");
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("添加/编辑内容分类失败");
 				}
 				echo json_encode($msg);
 				die();
 			}

 		public function add()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_CONTC","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_CONTC","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($_GET["id"])
			{
				$this->result["log"] = $this->mAsk->getCateRow($_GET["id"]);
			}
			if ($_GET["pid"])$this->result["log"]["pid"] = $_GET["pid"];
			$this->result["statuslist"] = array(
									1 => "启用",
									0 => "关闭");
			$this->result["plist"] = $this->mAsk->cateDropList($this->result["log"]["pid"]);
			$this->tplname = 'askcate_add';
			$this->mLog->adminLog("添加/编辑内容分类");
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","Article","Ask"));
 			$this->result["sites"]["trains"] = "selected";
 			$this->result["sites"]["title"] = "问答分类";
 			$this->result["sites"]["url"] = encrypt("articlecate");
 		}
 	}
?>