<?php

 	class logout extends Controller
 	{
 		public function defshow()
 		{
 			$this->checkUserLogin();
 			unset($_SESSION["login_user"]);
 			Header("Location: /user/login.html");
 		}
 	}
?>