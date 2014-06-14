<?php
 	class import extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			if($this->mPur->adminCheck("PW_PRODU","1")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			$this->result["catelist"] = $this->mProd->getDropList("t","  WHERE status=1");
			$this->mLog->adminLog("商品批量导入");
			$this->tplname = 'import';
 		}
 		

 		public function savePost()
		{
			ini_set("max_execution_time", "18000");
			$this->pageinfo();
			$str = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";
			$rs = $this->mProd->batchImport();
			if($rs["nofile"]>0)
			{
				$str .=  "<script>alert('错误:请选择上传文件');history.go(-1);</script>";
			}
			else
			{
				$str .=  "<script>alert('导入结束！其中成功:".$rs["sucess"].",错误:".$rs["error"]."');window.location= '?m=".encrypt("product")."';</script>";
			}
			echo $str;
			die();
		}
		
 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["sites"]["catalog"] = "selected";
 			$this->result["sites"]["title"] = "批量导入";
 			$this->result["sites"]["url"] = encrypt("category");
 		}
 	}
?>