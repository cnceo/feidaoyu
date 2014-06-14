<?php
 	class customer extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPurview->adminCheck("PW_CLIENTS","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				$r = $this->mCustomer->getList();
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["status"] = $this->result["statuslist"][$val["status"]];
					$r["logs"][$key]["customer_group_id"] = $this->result["cglist"][$val["customer_group_id"]];
				}
				$this->result["catelist"] = $this->mCustomer->getGroupDropList("t");
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'customer';
	 			$this->mLog->adminLog("查看客户列表");
 			
 		}
 		
 		public function del()
 			{
 				$this->_globals();
 				if($this->mPurview->adminCheck("PW_CLIENTS","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mCustomer->Del($_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除客户失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除客户成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function savePost()
 			{
 				$this->_globals();
 				$rs = $this->mCustomer->savePost();
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$this->mLog->adminLog("添加/编辑客户成功"); 
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("添加/编辑客户失败");
 				}
 				echo json_encode($msg);
 				die();
 			}
 		public function batch()
 			{
 				print_r($_POST);
 				$this->_globals();
 				$rs = $this->mCustomer->Batch();
		 		$this->mLog->adminLog("批量移动/删除客户");
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
 			if($this->mPurview->adminCheck("PW_CLIENTS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_CLIENTS","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			
			if($_GET["id"])
			{
				$this->result["log"] = $this->mCustomer->getRow($_GET["id"]);
			}
			{
				$this->result["log"]["is_alone_sale"] = 1;
			}
			$this->result["monthlist"] = getNumList(1,13);
 			$this->result["daylist"] = getNumList(1,32);
 			$this->result["provincelist"] = $this->mBasic->getCityDorpList(0,"t");
 			$this->result["citylist"] = $this->mBasic->getCityDorpList($this->result["log"]["province"],"t");
 			$this->result["countylist"] = $this->mBasic->getCityDorpList($this->result["log"]["city"],"t");
			$this->tplname = 'customer_add';
			$this->mLog->adminLog("添加/编辑客户");
 		}
 		
 		public function detail()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_CLIENTS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->result["log"] = $this->mCustomer->getRow($_GET["uid"]);
			$this->result["log"]["customer_group_id"] = $this->result["cglist"][$this->result["log"]["customer_group_id"]];
			$this->result["log"]["status"] = $this->result["statuslist"][$this->result["log"]["status"]];
			$this->result["log"]["province"] = $this->mBasic->getCitybyId($this->result["log"]["province"]);
 			$this->result["log"]["city"] = $this->mBasic->getCitybyId($this->result["log"]["city"]);
 			$this->result["log"]["county"] = $this->mBasic->getCitybyId($this->result["log"]["county"]);
			$this->result["monthlist"] = getNumList(1,13);
 			$this->result["daylist"] = getNumList(1,32);
 			$this->result["provincelist"] = $this->mBasic->getCityDorpList(0,"t");
 			$this->result["citylist"] = $this->mBasic->getCityDorpList($this->result["log"]["province"],"t");
 			$this->result["countylist"] = $this->mBasic->getCityDorpList($this->result["log"]["city"],"t");
			$this->tplname = 'customer_detail';
 		}
 		
 		public function buys()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_CLIENTS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
			$r = $this->mBasic->getList();
			foreach ($r["logs"] as $key=>$val)
			{
				$r["logs"][$key]["status"] = $this->result["statuslist"][$val["status"]];
			}
			$this->result["catelist"] = $this->mCate->cateDropList();
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
			$this->tplname = 'customer_buys';
 		}
 		
 		public function points()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_CLIENTS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			
			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
			$r = $this->mCustomer->getPointList($_GET["uid"]);
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] =  $r["pages"];
			$this->result["catelist"] = $this->mCate->cateDropList();
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
			$this->tplname = 'customer_points';
 		}
 		
 		public function comment()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_CLIENTS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			
			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
			$r = $this->mProd->getCommmentListbyUid($_GET["uid"]);
			$this->result["catelist"] = $this->mCate->cateDropList();
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
			$this->tplname = 'customer_comment';
 		}
 		
 		public function check()
 		{
 			$this->_globals();
 			if($_GET["email"])$msg = $this->mCustomer->checkField("email",$_GET["email"],$_GET["id"]);
 			if($_GET["mobile"])$msg = $this->mCustomer->checkField("mobile",$_GET["mobile"],$_GET["id"]);
 			if($_GET["username"])$msg = $this->mCustomer->checkField("username",$_GET["username"],$_GET["id"]);
 			if($msg=="")echo "1";
 			die();
 		}
 		
 		public function citylist()
 		{
 			$this->_globals();
 			$rs = $this->mBasic->getCateListByID("parameters",$_GET["pid"]);
 			$str = "<option value=\"\">请选择城市</option>";
 			foreach ($rs as $val)
 			{
 				$str .="<option value=\"".$val["id"]."\">".$val["name"]."</option>";
 			}
 			echo $str;
 			die();
 		}
 		
 		public function countylist()
 		{
 			$this->_globals();
 			$rs = $this->mBasic->getCateListByID("parameters",$_GET["pid"]);
 			$str = "<option value=\"\">请选择区县</option>";
 			foreach ($rs as $val)
 			{
 				$str .="<option value=\"".$val["id"]."\">".$val["name"]."</option>";
 			}
 			echo $str;
 			die();
 		}
 		
 		public function linelist()
 		{
 			$this->_globals();
 			$rs = $this->mBasic->getCateListByID("parameters",$_GET["pid"]);
 			$str = "<option value=\"\">请选择线路</option>";
 			foreach ($rs as $val)
 			{
 				$str .="<option value=\"".$val["id"]."\">".$val["name"]."</option>";
 			}
 			echo $str;
 			die();
 		}
 		
 		public function stationlist()
 		{
 			$this->_globals();
 			$rs = $this->mBasic->getCateListByID("parameters",$_GET["pid"]);
 			$str = "<option value=\"\">请选择站点</option>";
 			foreach ($rs as $val)
 			{
 				$str .="<option value=\"".$val["id"]."\">".$val["name"]."</option>";
 			}
 			echo $str;
 			die();
 		}
 		
 		public function districtlist()
 		{
 			$this->_globals();
 			$rs = $this->mBasic->getCateListByID("parameters",$_GET["pid"]);
 			$str = "<option value=\"\">请选择商圈</option>";
 			foreach ($rs as $val)
 			{
 				$str .="<option value=\"".$val["id"]."\">".$val["name"]."</option>";
 			}
 			echo $str;
 			die();
 		}
 		
 		public function catelist()
 		{
 			$this->loadModel(array("Category"));
 			$rs = $this->mCategory->getCateList($_GET["pid"]);
 			$str = "<option value=\"\">请选择子类</option>";
 			foreach ($rs as $val)
 			{
 				$str .="<option value=\"".$val["id"]."\">".$val["cname"]."</option>";
 			}
 			echo $str;
 			die();
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","Customer"));
 			$this->result["statuslist"] = array(
									1 => "已认证",
									0 => "未认证");
			$this->result["cglist"] = $this->mCustomer->getGroupDropList("t");
 			$this->result["sites"]["customer"] = "selected";
 			$this->result["sites"]["title"] = "客户";
 			$this->result["sites"]["url"] = encrypt("customer");
 		}
 	}
?>