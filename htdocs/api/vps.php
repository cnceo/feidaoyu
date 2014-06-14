<?
	/*ini_set('error_reporting', E_ALL); //打开所有的错误级别
	ini_set('display_errors', 1); //显示错误*/
	require_once("../../configs/initdb.php");
   	$root = "/data/wwwroot/vhost/";
   	//$db->debug=1;
   	$data = unserialize($_POST["data"]);
	if($data["domain"])
	{
		$path = $root.$data["domain"].".feidaoyu.com";
		mkpath($path."/htdocs");
		$user = $data["domain"].random(2);
		$password = random(6);
		$start = date("Y-m-d");
		$end = date("Y-m-d",strtotime($data["year"]."year"));
		$vpsid = $data["vpsid"];
		$sql = "INSERT INTO `ftpuser` VALUES (null, '$user','$vpsid', '$password', 5500, 5500, '$path', '/sbin/nologin', 10, '$start 00:00:00', '$end 00:00:00');";
		$db->execute($sql);
		$fp = fopen("$path/htdocs/index.html","a+");
	   	fwrite($fp,"Hello world! by feidaoyu.com");
	   	fclose($fp);
	   	system("chmod -R 777 $path");
	   	$sql = "CREATE DATABASE `$user` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
	   	$db->execute($sql);
	   	$sql = "GRANT ALL PRIVILEGES ON $user.* TO $user@localhost IDENTIFIED BY '$password';";
	   	$db->execute($sql);
	   	$rs["domain"] = $data["domain"].".feidaoyu.com";
	   	$rs["user"] = $user;
	   	$rs["password"] = $password;
	   	$rs["dbhost"] = "localhost";
	   	$rs["dbname"] = $user;
	   	$rs["dbuser"] = $user;
	   	$rs["dbpasswd"] = $password;
	   	$rs["phpmyadmin"] = "http://db.feidaoyu.com/phpmyadmin";
	   	$rs["start"] = $start;
	   	$rs["end"] = $end;
	   	$str = serialize($rs);
		die($str);
	}

	function mkpath($path,$mode = 0777)
	{
		$path = str_replace("\\","_|",$path);
		$path = str_replace("/","_|",$path);
		$path = str_replace("__","_|",$path);
		$dirs = explode("_|",$path);
		$path = $dirs[0];
		for($i = 1;$i < count($dirs);$i++)
		{
			$path .= "/".$dirs[$i];
			if(!is_dir($path))
			mkdir($path,$mode);
		}
	}

	function random($length=6)
	{
		$str = "0123456789abcdefghijklmnopqrstuvwxyz";   //   输出字符集
		$len = strlen($str)-1;
		for($i=0 ; $i<$length; $i++)
		{
		    $s .=  $str[rand(0,$len)];
		}
		return $s;
   }
?>
