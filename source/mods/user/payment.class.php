<?php
 	class payment extends Controller
 	{
 		public function defshow()
 		{
 			$this->_globals();
 			$this->result["log"] = $this->mDb->getrow("SELECT * FROM ".get_table("orderprodlist")." WHERE order_id='".$_GET["order_id"]."' AND uid=".$_SESSION["login_user"]["id"]);
 			$this->tplname = "payment";
 		}

 		private function _globals()
 		{
 			$this->checkUserLogin();
 			$this->loadModel(array());
 		}
 	}
?>