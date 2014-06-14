<?php
  /* ini_set('error_reporting', E_ALL); //打开所有的错误级别
	ini_set('display_errors', 1); //显示错误*/

	$time1 =  getmicrotime();
	define("_START_", true);
	define("_APP_PATH", "../../source/"); // app file path
	require_once(_APP_PATH."Back.comm.php");
	$s = new App();
	$s->Run();
	//print_r($_GET);
	//echo getmicrotime()-$time1;
	function getmicrotime(){
	    list($usec, $sec) = explode(" ",microtime());
	    return ((float)$usec + (float)$sec);
	}
// 	if($_SERVER['REMOTE_ADDR']=="180.173.21.226")
// 	{
// 		foreach ($_POST as $key=>$value)
// 		{
// 			echo $key."||".$value."<br/>";
// 		}
// 	}
?>
