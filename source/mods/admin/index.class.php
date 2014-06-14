<?php
 	class index extends Controller 
 	{
 		public function defshow()
 		{
 			$this->checkLogin();
 			/*$this->result["sites"]["dashboard"] = "selected";
 			$this->result["sites"]["title"] = "首页";
 			$rs = $this->mOrd->getNewList();
 			$this->result["statuslist"] = $this->mOrd->getStatusList();
 			$log["order_total"] = $this->mDb->getone("SELECT COUNT(*) FROM ".get_table("orders")."");
 			$log["product_total"] = $this->mDb->getone("SELECT COUNT(*) FROM ".get_table("products")."");
 			$log["product_warn_quantity"] = $this->mDb->getone("SELECT COUNT(*) FROM ".get_table("products")." WHERE warn_quantity>=quantity");
 			$log["order_succeed"] = $this->mDb->getone("SELECT COUNT(*) FROM ".get_table("orders")." WHERE status=6");
 			
 			foreach ($rs as $key=>$val)
				{
					$rs[$key]["status"] = $this->result["statuslist"][$val["status"]];
				}
 			$this->result["log"] = $log;
 			$this->result["logs"] = $rs;*/
 			$this->result["sites"]["url"] = encrypt("index");
 			$this->tplname = 'index';
 		}
 	}
?>