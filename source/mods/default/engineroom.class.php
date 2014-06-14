<?php
 	class engineroom extends Controller
 	{
 		public function defshow()
 		{
			$this->_globals();
			$this->result["sites"]["pagetitle"] = "机房介绍";
		     $this->tplname = 'engineroom';

 		}

 		private function _globals()
 		{
 			$this->loadModel(array());
 			$this->result["sites"]["engineroom"] = 'on';
 		}
 	}
?>