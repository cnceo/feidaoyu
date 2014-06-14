<?php
//print_r($_GET);

/* ini_set('error_reporting', E_ALL); //打开所有的错误级别
	ini_set('display_errors', 1); //显示错误 */
	define("_START_", true);
	define("_APP_PATH", "../source/"); // app file path
	require_once(_APP_PATH."Front.comm.php");
	$s = new App();
	$s->Run();
?>