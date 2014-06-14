<?
/* 	ini_set('error_reporting', E_ALL); //打开所有的错误级别
	ini_set('display_errors', 1); //显示错误 */
	require_once("../../configs/initdb.php");
	$data = unserialize($_POST["data"]);
	$sql = "SELECT * FROM sb_vps_log WHERE domain = '".$data["domain"]."'";
	$rs = $db->getone($sql);
	if($rs)
	{
		die("y");
	}else{
		die("n");
	}

?>