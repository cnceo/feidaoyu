<?php
 	class solution extends Controller 
 	{
 		public function defshow()
 		{
 			$this->checkLogin();
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->mPurview->adminCheck("PW_SETUP","1");
 			$r= $this->mBasic->getList("solution");
 		    foreach ($r["logs"] as $key=>$val)
			{
				$r["logs"][$key]["status_name"] = $this->result["statuslist"][$val["status"]];
			}
			$this->result["logs"]=$r["logs"];
			$this->result["pages"] = $r["pages"];
 			$this->tplname = 'solution';
 			$this->mLog->adminLog("查看产品与解决方案");
 		}
 		
 		public function savePost()
 		{
 			$this->_globals();
 			$rs = $this->mBasic->savePost("solution");
			if($rs)
			{
				$msg["status"] = "true";
			}
			else
			{
				$msg["false"] = "false";
				$msg["message"] = "保存错误，请联系管理员";
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
				$this->result["log"] = $this->getRow("solution",$_GET["id"]);
			}
			else
			{
				$this->result["log"]["status"] = 1;
			}
			$this->mLog->adminLog("添加编辑商品");
			$this->tplname = 'solution_add';
 		}
 		
 		public function del()
		{
			$this->_globals();
			
			if($this->mPurview->adminCheck("PW_PRODS","4")==false)
		 	{
		 		die("Permission denied");
		 	}
			if(!($this->mBasic->Del("solution",$_POST["id"])))
			 {
				$this->mLog->adminLog("删除成功案例失败");
			 	echo "error";
			 }
			 else
			 {
				$this->mLog->adminLog("删除成功案例成功");
			 	echo "succeed";
			 }
			 
			die();
		}
		
 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic"));
 			$this->result["statuslist"] = array(
 					              0 =>"待审核",
 					              1 =>"审核通过",
 					              2 =>"审核拒绝");
 			$this->result["sites"]["sales"] = "selected";
 			$this->result["sites"]["title"] = "产品与解决方案";
 			$this->result["sites"]["url"] = encrypt("product");
 		}
 	}
?>