<?php
 	class category extends Controller
 	{
 		protected $tpl;

 		public function defshow()
 		{
 			$this->_globals();
 			if($this->mPurview->adminCheck("PW_PRODC","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$id = 0;
			if($_GET["cateid"])$id=$_GET["cateid"];
			$this->result["logs"] = $this->mCategory->getCateList($id);
		/*foreach ($this->result["logs"] as $key =>$val)
			{
				$cateid = $this->mCategory->getCateChildId($val["id"]);
				$this->result["logs"][$key]["prodnum"] = $this->mProduct->getCateTotal($cateid);
			}*/
 			$this->tplname = 'category';
 			$this->mLog->adminLog("查看分类列表");

 		}

 		public function update()
 		{
 			$this->_globals();
			$rs = $this->mCategory->saveUpdate();
			die();
 		}

 		public function del()
		{
			$this->_globals();
			$msg["status"] = "false";
			if($this->mPurview->adminCheck("PW_PRODC","4")==false)
		 	{
		 		die("Permission denied");
		 	}
				if($this->mCategory->Del($_POST["id"]) == false)
			 {
				$this->mLog->adminLog("删除分类失败");
			 	$msg["message"] = "操作失败，请联系管理员";
			 }
			 else
			 {
				$msg["status"] = "true";
			 	$this->mLog->adminLog("删除分类成功");
			 	$msg["message"] = "操作成功";
			 }
			echo json_encode($msg);
			die();
		}

 		public function savePost()
		{
			$this->_globals();
			$rs = $this->mCategory->savePost();
			if($rs)
			{
				$msg["status"] = "true";
				$this->mLog->adminLog("添加/编辑分类成功");
			}
			else
			{
				$msg["status"] = "false";
				$msg["message"] = "保存错误，请联系管理员";
				$this->mLog->adminLog("添加/编辑分类失败");
			}
			echo json_encode($msg);
			die();
		}

 		public function add()
 		{
			$this->_globals();
 			if($this->mPurview->adminCheck("PW_PRODC","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPurview->adminCheck("PW_PRODC","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}

			if($_GET["id"])
			{
				$this->result["log"] = $this->mCategory->getRow($_GET["id"]);
			}
/* 			if($this->result["log"]["brands"])
			{
				$this->result["selectbrandlist"] = $this->mBrand->getDropList("t"," WHERE id IN(".$this->result["log"]["brands"].")");
				$this->result["brandlist"] = $this->mBrand->getDropList("t"," WHERE id NOT IN(".$this->result["log"]["brands"].")");
			}
			else
			{
				$this->result["brandlist"] = $this->mBrand->getDropList("t");
			} */

			/* if($this->result["log"]["parameters"])
			{
				$this->result["selectparameterlist"] = $this->mProduct->getParameterListByID($this->result["log"]["parameters"],null,"t");
			}
			if($this->result["log"]["parameters1"])
			{
				$this->result["selectparameter1list"] = $this->mProduct->getParameterListByID($this->result["log"]["parameters1"],null,"t");
			}
			if($this->result["log"]["parameters2"])
			{
				$this->result["selectparameter2list"] = $this->mProduct->getParameterListByID($this->result["log"]["parameters2"],null,"t");
			} */

			if($this->result["log"]["pid"])
			{
				$this->result["sites"]["navigation"] = $this->mCategory->getCateParentList($this->result["log"]["pid"]);
				$this->result["sites"]["navigation"] = array_reverse($this->result["sites"]["navigation"]);
			}
			//print_r($this->result["sites"]["navigation"]);
			/*if($this->result["log"]["parameters"])
			{
				$this->result["selectparameterlist"] = $this->mUni->getDropList("parameters","t"," WHERE id IN(".$this->result["log"]["parameters"].")");
				$this->result["parameterlist"] = $this->mUni->getDropList("parameters","t"," WHERE id NOT IN(".$this->result["log"]["parameters"].")");
			}
			else
			{*/
				/*$sql = "SELECT t1.* FROM sb_parameters t1, sb_rules t2 WHERE t1.id = t2.kid AND t2.pid IN ( SELECT id FROM sb_products WHERE class_id =".$_GET["id"].")";
				//echo $sql;
				$rs = $this->mDb->getall($sql);
				//print_r($rs);
				if($rs)
				{
					$cate = array();
					foreach ($rs as $val)
						{
							$cate[$val["id"]] = $val["name"];
						}
					//$rs = $cate;
				}*/
				//print_r($cate);
			/* 	$this->result["parameterlist"] = $this->mProduct->getParameterListByCateID($_GET["id"],$selectd,"t"); */
			//}

			if ($_GET["pid"])$this->result["log"]["pid"] = $_GET["pid"];
			$this->result["statuslist"] = array(
									1 => "启用",
									0 => "关闭");
			$this->result["plist"] = $this->mCategory->cateDropList($this->result["log"]["pid"]);
			$this->tplname = 'category_add';
			$this->mLog->adminLog("添加/编辑分类");
 		}

 		private function _globals()
 		{
 			$this->checkLogin();
 			$this->loadModel(array("Purview","Basic","User","Category","Brand","Product"));
 			$this->mCategory->mTable = "categorys";
 			$this->result["sites"]["catalog"] = "selected";
 			$this->result["sites"]["title"] = "分类";
 			$this->result["sites"]["url"] = encrypt("category");
 		}
 	}
?>