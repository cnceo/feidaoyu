<?php
 	class group extends Controller 
 	{
 		protected $tpl;
 		public function show()
 		{
 			$this->checkLogin();
 			//$this->mDb->debug = true;
 			if($this->mPur->adminCheck("EYE_GROUP","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
 			if($this->mAction=="save")
 			{
 				echo $this->mGro->savePost("groups");
 				$this->mLog->adminLog("添加/编辑用户组"); 
 				die();
 			}
 			if($this->mAction=="del")
 			{
 				if($this->mGro->Del("groups",$_POST["id"]) == false)
				 {
					 echo "error";
				 }
				 else
				 {
					 echo "succeed";
				 }
 				die();
 			}
 			$this->mLog->adminLog("查看用户组"); 
 			$this->result["sites"]["contents"] = "active";
 			$this->result["logs"] = $this->mGro->cateList("groups");
	 		$this->tplname = 'group';
 			$this->Display();
 		}
 	}
?>