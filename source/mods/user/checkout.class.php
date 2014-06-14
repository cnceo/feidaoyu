<?php
    /**
     * 结算*
     *
     */
 	class checkout extends Controller
 	{
 		public function defshow()
 		{
 			$this->_globals();
 			$this->result["log"] = $this->mOrder->getOrderinfo($_GET["order_id"]);
 			$this->result["sites"]["pagetitle"] = "订单中心";
 			$this->tplname = "checkout";
 		}

 	    private function _globals()
 		{
 			$this->checkUserLogin();
 			$this->loadModel(array("Order"));
 		}
 	}
?>