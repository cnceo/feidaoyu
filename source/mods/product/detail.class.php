<?php
    /**
     * 产品内页*
     */
 	class detail extends Controller
 	{
 		public function defshow()
 		{
 			$this->_globals();
 			$this->result["log"] = $this->mProduct->getRow($_GET["id"]);
 			$this->result["hotvps"] = $this->mBasic->getNavList("products"," status = 1",5);
 			$this->tplname = "detail";
 			$this->result["sites"]["pagetitle"] = $this->result["log"]["cprodname"]. "--".$this->result["sites"]["sitename"];
 		}

 	    private function _globals()
 		{
 			$this->loadModel(array("Product","Basic"));
 			$this->result["yearlist"] = array(
 					1 => "1年",
 					3 => "3年",
 					5 => "5年"
 			);
 		}
 	}
?>