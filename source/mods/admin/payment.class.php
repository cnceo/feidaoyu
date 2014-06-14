<?php
 	class payment extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			if($this->mPur->adminCheck("PW_PAYS","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->result["logs"] = $this->mOrd->getPaymentList();
 			$this->tplname = 'payment';
 			$this->mLog->adminLog("查看支付方式管理列表");
 		}
 		
 		public function del()
		{
			if($this->mPur->adminCheck("PW_PAYS","4")==false)
		 	{
		 		die("Permission denied");
		 	}
			if($this->mOrd->PaymentDel($_POST["id"]) == false)
			 {
				$this->mLog->adminLog("删除支付方式失败"); 
			 	echo "error";
			 }
			 else
			 {
				$this->mLog->adminLog("删除支付方式成功"); 
			 	echo "succeed";
			 }
			die();
		}
 		
 		public function savePost()
		{
			$this->pageinfo();
			$rs = $this->mOrd->savePaymentPost();
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/编辑支付方式成功"); 
			}
			else
			{
				$msg["false"] = "true";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/编辑支付方式失败"); 
			}
			echo json_encode($msg);
			die();
		}
 		
 		public function add()
 		{
			if($this->mPur->adminCheck("PW_PAYS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPur->adminCheck("PW_PAYS","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			if($_GET["id"])
			{
				$this->result["log"] = $this->mOrd->getPaymentRow($_GET["id"]);
				$this->result["rules"] = $this->result["log"]["rules"];
			}
			$this->result["itemlist"] = array(
									"total" => "订单总价（元）",
									"weight" => "订单重量（千克）");
			$this->result["rulelist"] = array(
									"<" => "<",
									"=" => "=",
									">" => ">");
															
			$this->result["statuslist"] = array(
								    0 => "NO",
									1 => "YES"
									);
			$this->tplname = 'payment_add';
			$this->mLog->adminLog("添加/编辑支付方式"); 
 		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["customer"] = "selected";
 			$this->result["sites"]["title"] = "支付方式";
 			$this->result["sites"]["url"] = encrypt("payment");
 		}
 	}
?>