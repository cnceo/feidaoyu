<?
    require_once(dirname(__FILE__)."/config.php");
	require_once(dirname(dirname(__FILE__))."/source/libs/adodb/adodb.inc.php");
	$db = NewADOConnection(_DB_TYPE);
	$db->Connect(_DB_HOST, _DB_USER,_DB_PASS, _DB_NAME);
	//$db->debug=1;
	$db->query("SET CHARACTER SET "._DB_CHAR);
?>