<?php
 	class msg extends Controller
 	{
 		protected $tpl;

 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPurview->adminCheck("PW_PRODS","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mBasic->getList("message");
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["status"] = $this->result["statuslist"][$val["status"]];
				}
				//$this->result["catelist"] = $this->mCate->cateDropList($_GET["cateid"]);
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'msg';
	 			$this->mLog->adminLog("查看成功案例列表");

 		}

 		public function savePost()
		{
			$this->_globals();
			/*print_r($_POST);
			die();*/
			$rs = $this->mBasic->savePost("message");
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/修改成功案例成功");
			}
			else
			{
				$msg["status"] = "true";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/修改商品成功案例失败");
			}
			echo json_encode($msg);
			die();
		}

 		public function add()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_PRODS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_PRODS","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}

			if($_GET["id"])
			{
				$this->result["log"] = $this->getRow("message",$_GET["id"]);
			}
			else
			{
				$this->result["log"]["status"] = 1;
			}
			$this->mLog->adminLog("添加编辑商品");
			//echo "dddd";
			$this->tplname = 'msg_add';
 		}

 	 	public function del()
		{
			$this->_globals();
			if($this->mPurview->adminCheck("PW_PRODS","4")==false)
		 	{
		 		die("Permission denied");
		 	}
			if($this->mBasic->Del("message",$_POST["id"]))
			 {
				$this->mLog->adminLog("删除成功案例成功");
			 	echo "succeed";
			 }
			 else
			 {
			 	$this->mLog->adminLog("删除成功案例失败");
			 	echo "error";
			 }
			die();
		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic"));
 			$this->result["sites"]["msg"] = "selected";
 			$this->result["sites"]["title"] = "留言列表";
 			//$this->result["sites"]["url"] = encrypt("product");
 		}
 	}
?>



