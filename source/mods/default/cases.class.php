<?php
 	class cases extends Controller
 	{
 		public function defshow()
 		{
			$this->_globals();

			$this->result["sites"]["pagetitle"] = "飞刀鱼主机，全球最低价";
			
		     $this->tplname = 'cases';

 		}

 	 		public function savePost()
 			{
 				$this->_globals();
 				$rs = $this->mBasic->savePost("message");
 				if($rs)
 				{
 					$msg["status"] = "true";
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 				}
 				echo json_encode($msg);
 				die();
 			}

 		private function _globals()
 		{
 			$this->loadModel(array("Basic","Article","Category","Ad","Site"));
 			$this->result["sites"]["vps"] = 'on';
 		}
 	}
?>