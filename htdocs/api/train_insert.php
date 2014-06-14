<?
/* 	ini_set('error_reporting', E_ALL); //打开所有的错误级别
	ini_set('display_errors', 1); //显示错误 */
	require_once("../../configs/initdb.php");
	//$db->debug=1;
	$vpsdata = unserialize($_POST["vpsdata"]);
	$sql = "INSERT INTO `sb_vps_log` VALUES (null,0,0,0,'".$vpsdata["start"]."','".$vpsdata["end"]."',2, 1,null,'".$vpsdata["domain"]."','".$vpsdata["user"]."','".$vpsdata["password"]."','".$vpsdata["dbhost"]."','".$vpsdata["dbname"]."','".$vpsdata["dbuser"]."','".$vpsdata["dbpasswd"]."','".$vpsdata["phpmyadmin"]."',4);";
	$db->execute($sql);
?>