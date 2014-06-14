<?php
 	class purview extends Controller 
 	{
 		public function show()
 		{
 			$this->checkLogin();
 			//$this->mDb->debug = true;
 			if($this->mPur->adminCheck("EYE_PURV","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
 			if($this->mAction=="save")
 			{
 				$this->mPur->update("group",$_POST["uid"]);
 				die();
 			}
 			$this->result["pw"] = $this->mPur->edit("group",$_GET["uid"]);
			$this->result["pw"]["uid"] = $_GET["uid"];
			$this->result["pw"]["utype"] = $_GET["t"];
			if($_GET["t"]=="group")
			{
				$this->result["groupname"] = $this->mGro->getName("groups",$_GET["uid"]);
			}
 			$this->result["pw"]["radios"] = array(
					1 => "许可",
					0 => "不许可");
			
			$this->result["pw"]["checkboxes"] = array(
					1 => "浏览",
					2 => "新加",
					3 => "编辑",
					4 => "删除");
 			$this->result["sites"]["contents"] = "active";
	 		$this->tplname = 'purview';
 			$this->Display();
 		}
 	}
?>