<?php
 	class express extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			if($this->mPur->adminCheck("PW_EXPR","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->result["logs"] = $this->mOrd->getExpressList();
 			$this->tplname = 'express';
 			$this->mLog->adminLog("查看快递管理列表");
 		}
 		
 		public function del()
		{
			if($this->mPur->adminCheck("PW_EXPR","4")==false)
		 	{
		 		die("Permission denied");
		 	}
				if($this->mOrd->ExpressDel($_POST["id"]) == false)
			 {
				$this->mLog->adminLog("删除快递管理失败"); 
			 	echo "error";
			 }
			 else
			 {
				$this->mLog->adminLog("删除快递管理成功"); 
			 	echo "succeed";
			 }
			die();
		}
 		
 		public function savePost()
		{
			$this->pageinfo();
			$rs = $this->mOrd->saveExpressPost();
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/编辑管理成功"); 
			}
			else
			{
				$msg["false"] = "true";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/编辑管理失败");  
			}
			echo json_encode($msg);
			die();
		}
 		
 		public function add()
 		{
			if($this->mPur->adminCheck("PW_EXPR","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPur->adminCheck("PW_EXPR","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			if($_GET["id"])
			{
				$this->result["log"] = $this->mOrd->getExpressRow($_GET["id"]);
				$this->result["rules"] = $this->result["log"]["rules"];
			}
			$this->result["itemlist"] = array(
									"total" => "订单总价（元）",
									"weight" => "订单重量（千克）");
			$this->result["rulelist"] = array(
									"<" => "<",
									"<=" => "<=",
									"=" => "=",
									">=" => ">=",
									">" => ">");
															
			$this->result["statuslist"] = array(
									0 => "NO",
									1 => "YES");
			$this->tplname = 'express_add';
			$this->mLog->adminLog("添加/编辑管理"); 
 		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["customer"] = "selected";
 			$this->result["sites"]["title"] = "快递";
 			$this->result["sites"]["url"] = encrypt("express");
 		}
 	}
?>