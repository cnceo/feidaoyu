<?php
    /**
     * 会员中心
     *
     *
     */
 	class index extends Controller
 	{
 		public function defshow()
 		{
 			$this->_globals();
			$this->result["sites"]["pagetitle"] = "会员中心";
			$this->tplname = "index";
 		}



 		private function _globals()
 		{
 			$this->checkUserLogin();
 			$this->loadModel(array("Basic","User","Customer","Article"));
 			$this->result["sites"]["user"] = 'on';
 		}
 	}
?>