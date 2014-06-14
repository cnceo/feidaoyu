<?php
 	class parameter extends Controller 
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
			$r = $this->mProduct->getParameterList($_GET["cateid"]);
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
 			$this->tplname = 'parameter';
 			$this->mLog->adminLog("查看参数列表");
 			
 		}
 		
 		
 		public function poplist()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
 			if($this->mPurview->adminCheck("PW_PRODS","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->result["logs"] = $this->mProduct->getParameterListByCateID2($_GET["cateid"]);
			
			$this->result["header_small"] = 1;
 			$this->tplname = 'parameter_small';
 			$this->mLog->adminLog("查看参数列表");
 			
 		}
 		
 		
 		public function remove()
 			{
 				$this->_globals();
 				$msg["status"] = "false";
 				if($this->mPurview->adminCheck("PW_PRODS","4")==false)
			 	{
 					$msg["message"] = "Permission denied";
			 	}
 				if($this->mProduct->RemoveParameters($_POST["id"],$_POST["cid"]) == false)
				 {
					$this->mLog->adminLog("删除参数失败"); 
				 	$msg["message"] = "保存错误，请联系管理员";
				 }
				 else
				 {
					$this->mLog->adminLog("删除参数成功"); 
				 	$msg["status"] = "true";
				 }
				echo json_encode($msg);
 				die();
 			}
 		
 		public function batchremove()
 			{
 				$this->_globals();
 				$msg["status"] = "false";
 				if($this->mPurview->adminCheck("PW_PRODS","4")==false)
			 	{
 					$msg["message"] = "Permission denied";
			 	}
				 else
				 {
					$this->mProduct->batchRemoveParameters();
				 	$this->mLog->adminLog("删除参数成功"); 
				 	$msg["status"] = "true";
				 }
				echo json_encode($msg);
 				die();
 			}
 			
 		public function group()
 			{
 				$this->_globals();
 				$msg["status"] = "false";
 				if($this->mPurview->adminCheck("PW_PRODS","4")==false)
			 	{
 					$msg["message"] = "Permission denied";
			 	}
 				if($this->mProduct->setGroupParameter($_POST["gname"],$_POST["selected"],$_POST["cid"],$_POST["cateid"]) == false)
				 {
					$this->mLog->adminLog("删除参数组失败"); 
				 	$msg["message"] = "保存错误，请联系管理员";
				 }
				 else
				 {
					$this->mLog->adminLog("删除参数组成功"); 
				 	$msg["status"] = "true";
				 }
				echo json_encode($msg);
 				die();
 			}
 			
 	    public function seque()
 			{
 				
 				$this->_globals();
 				$msg["status"] = "false";
 				if($this->mPurview->adminCheck("PW_PRODS","4")==false)
			 	{
 					$msg["message"] = "Permission denied";
			 	}
 				if($this->mProduct->setParameterSeque($_POST["seque"],$_POST["cateid"]) == false)
				 {
					$this->mLog->adminLog("删除参数失败"); 
				 	$msg["message"] = "保存错误，请联系管理员";
				 }
				 else
				 {
					$this->mLog->adminLog("删除参数成功"); 
				 	$msg["status"] = "true";
				 }
				echo json_encode($msg);
 				die();
 			}
 			
 			
 		public function del()
 			{
 				$this->_globals();
 				if($this->mPurview->adminCheck("PW_PRODS","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mBasic->Del("parameters",$_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除参数失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除参数成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function slist()
 		{
 			$this->_globals();
 			$sql ="SELECT * FROM ".get_table("parameters");
 			if($_GET["keyword"])
 			{
 				$sql .=" WHERE name LIKE '%".$_GET["keyword"]."%'";
 			}
 			$rs = $this->mDb->getall($sql);
 			//$str = "<option value=\"\">请选择城市</option>";
 			foreach ($rs as $val)
 			{
 				$str .="<option value=\"".$val["id"]."\">".$val["name"]."</option>";
 			}
 			echo $str;
 			die;
 		}
 		
 		public function savePost()
 			{
 				$this->_globals();
 				$cateid = $_POST["cateid"];
 				unset($_POST["cateid"]);
 				if($_POST["id"])
 				{
 					$id = $_POST["id"];
 					$log = "修改".$_POST["name"];
 					if($cateid)
 					{
 						$sql = "SELECT * FROM sb_rules t1, sb_products t2 WHERE t1.pid = t2.id AND t2.class_id = $cateid AND t1.kid = $id";
 						$res = $this->mDb->getRow($sql);
 						if($res)
 						{
 							// chuli
 						}
 					}
 					else
 					{
	 					$rs = $this->mBasic->savePost("parameters");
 					}
 					
 				}
 				else
 				{
 					$log = "添加".$_POST["name"];
 					$rs = $this->mBasic->getID("parameters"," name='".$_POST["name"]."'");
 					//print_r($rs);
 					if(!$rs)
	 				{
	 					$rs = $this->mBasic->savePost("parameters");
	 					$id = $this->mDb->Insert_ID();
	 				}
	 				else
	 				{
	 					$id = $rs;
	 				}
 				}
 				if($rs)
 				{
 					$msg["status"] = "true";
 					$msg["id"] = $id;
 					$this->mLog->adminLog("$log参数成功");
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					$this->mLog->adminLog("$log参数失败");
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
				$this->result["log"] = $this->mProduct->getRow($_GET["id"],"parameters");
			}
			/*$this->result["catelist"] = array("1"=>"核心技术",
			                                  "2"=>"常规技术",
			                                  "3"=>"基本信息");*/
			$this->mLog->adminLog("添加编辑参数");
			$this->tplname = 'parameter_add';
			if($_GET["view"]=="small")
			{
				$this->result["header_small"] = 1;
				$this->tplname = 'parameter_add_small';
			}
 		}
 		
 		public function merge()
 		{
			$this->_globals();
 			$id = $this->mProduct->setMergeParameter($_POST["cname"],$_POST["selected"],$_POST["cateid"]);
			$msg["id"] = $id;
			$msg["cname"] = $_POST["cname"];
			echo json_encode($msg);
			die();
 		}
 		
 		public function listword()
 		{
 			$this->_globals();
 			$rs = $this->mProduct->getParameterByKeyword();
 			//echo json_encode($rs);
 			echo $rs;
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","User","Product","Category"));
 			$this->result["statuslist"] = $this->mProduct->getStatusList();
 			$this->result["unitlist"] = $this->mProduct->getUnitList();
 			$this->result["sites"]["catalog"] = "selected";
 			$this->result["sites"]["title"] = "参数";
 			$this->result["sites"]["url"] = encrypt("product");
 		}
 	}
?>