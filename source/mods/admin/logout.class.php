<?php
 	class logout extends Controller 
 	{
 		public function defshow()
 		{
 			unset($_SESSION["login_".$this->mType]);
 			header("Location: ?m=".encrypt("login"));
 		}
 	}
?>