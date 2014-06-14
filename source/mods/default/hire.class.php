<?php
 	class hire extends Controller
 	{
 		public function defshow()
 		{
			$this->_globals();
			$this->result["sites"]["pagetitle"] = "租用与托管";
		     $this->tplname = 'hire';

 		}

 		private function _globals()
 		{
 			$this->loadModel(array());
 			$this->result["sites"]["hire"] = 'on';
 		}
 	}
?>