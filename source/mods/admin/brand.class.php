<?php
 	class brand extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
 			if($this->mPurview->adminCheck("PW_BRANT","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$r = $this->mBrand->getList();
			$this->result["logs"] = $r["logs"];
			$this->result["pages"] = $r["pages"];
 			$this->tplname = 'brand';
 			$this->mLog->adminLog("查看品牌列表");
 			
 		}
 		
 		
 		public function slist()
 		{
 			$this->_globals();
 			$sql ="SELECT * FROM ".get_table("brands");
 			if($_GET["keyword"])
 			{
 				$sql .=" WHERE cname  LIKE '%".$_GET["keyword"]."%'";
 			}
 			//echo $sql;
 			$rs = $this->mDb->getall($sql);
 			if($rs)
 			{
 				
	 			foreach ($rs as $val)
	 			{
	 				$str .="<option value=\"".$val["id"]."\">".$val["cname"]."</option>";
	 			}
 			}
 			else
 			{
 				$str = "<option value=\"\">无结果</option>";
 			}
 			echo $str;
 			die;
 		}
 		
		
		public function delete()
		{
			$this->_globals();
			$msg["status"] = "false";
			if($this->mPurview->adminCheck("PW_USERS","4")==false)
		 	{
		 		$msg["message"] = "Permission denied";
		 	}
		 	else
		 	{
				if($this->Del("brands",$_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除用户失败"); 
				 	$msg["message"] = "删除品牌失败";
				 }
				 else
				 {
					$this->mLog->adminLog("删除品牌成功"); 
					$msg["status"] = "true";
				 	$msg["message"] = "删除品牌成功";
				 }
		 	}
			 echo json_encode($msg);
			die();
		}
 		
 		public function savePost()
		{
			$this->_globals();
			$rs = $this->mBrand->savePost();
			if($rs)
			{
				$msg["status"] = "true";
				$msg["id"] = $this->mDb->Insert_ID();
				$this->mLog->adminLog("添加/编辑品牌成功"); 
			}
			else
			{
				$msg["false"] = "true";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/编辑品牌失败"); 
			}
			echo json_encode($msg);
			die();
		}
 		
 		public function add()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_BRANT","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_BRANT","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($_GET["id"])
			{
				$this->result["log"] = $this->mBrand->getRow($_GET["id"]);
			}
			$this->result["statuslist"] = array(
									1 => "启用",
									0 => "关闭");
			$this->tplname = 'brand_add';
			if($_GET["view"]=="small")
			{
				$this->result["header_small"] = 1;
				$this->tplname = 'brand_add_small';
			}
			$this->mLog->adminLog("添加/编辑品牌"); 
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","User","Brand"));
 			$this->result["sites"]["catalog"] = "selected";
 			$this->result["sites"]["title"] = "商品品牌";
 			$this->result["sites"]["url"] = encrypt("category");
 		}
 	}
?>