<?php
 	class cache extends Controller 
 	{
 		public function show()
 		{
 			$this->checkLogin();
 			if($this->mPur->adminCheck("SYS_BASIC","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
 			if($this->mAction=="save")
 			{
 				$this->mLog->adminLog("更新缓存设置");
 				$this->save();
 			}
 			$this->result["sites"] = $this->mSite->get();
 			$this->result["sites"]["system"] = "active";
 			$this->result["caches"] = array(
									0 => "开启",
									1 => "禁用"
									);
 			$this->tplname = 'cache';
 			$this->mLog->adminLog("查看缓存设置");
 			$this->Display();
 		}
 		
 		private function save()
 		{
 			$this->mSite->update();
 			die();
 		}
 	}
?>