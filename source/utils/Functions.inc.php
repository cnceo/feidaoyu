<?php
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

	function sb_addslashes($str)
	{
		$str = str_replace("'", "‘", $str);
		return $str;
	}

	function formatNumber($str,$len)
	{
		$len2 = strlen($str);
		for($i=0;$i<($len-$len2);$i++)
		{
			$t .='0';
		}
		$str = $t.$str;
		return $str;
	}

	function formatPrice($munber)
	{
		return number_format($munber/100, 2, '.', ',');
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

   function formatsize($size)
   {
		$prec=3;
		$size = round(abs($size));
		$units = array(0=>" B ", 1=>" KB", 2=>" MB", 3=>" GB", 4=>" TB");
		if ($size==0) return str_repeat(" ", $prec)."0".$units[0];
		$unit = min(4, floor(log($size)/log(2)/10));
		$size = $size * pow(2, -10*$unit);
		$digi = $prec - 1 - floor(log($size)/log(10));
		$size = round($size * pow(10, $digi)) * pow(10, -$digi);
		return $size.$units[$unit];
   }

    function get_table($table)
    {
    	return "sb_".$table;
    }
	function formattime($t)
	{
		$t = explode("GMT",$t);
		return strtotime( $t[0]);
	}

	function _isset($a)
	{
		if(isset($a)) return 1;
		else return 0;
	}

/*	function keyed($txt,$encrypt_key)
	{
		$encrypt_key = md5($encrypt_key);
		$ctr=0;
		$tmp = "";
		for ($i=0;$i<strlen($txt);$i++)
		{
		if ($ctr==strlen($encrypt_key)) $ctr=0;
		$tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1);
		$ctr++;
		}
		return $tmp;
	}

	function encrypt($txt,$key=HS_KEY)
	{
		srand((double)microtime()*1000000);
		$encrypt_key = md5(rand(0,32000));
		$ctr=0;
		$tmp = "";
		for ($i=0;$i<strlen($txt);$i++)
		{
		if ($ctr==strlen($encrypt_key)) $ctr=0;
		$tmp.= substr($encrypt_key,$ctr,1) .
		(substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1));
		$ctr++;
		}
		return keyed($tmp,$key);
	}*/

/*   function encrypt($txt,$key=HS_KEY)
   {
	   srand((double)microtime() * 1000000);
	   $encrypt_key = md5(rand(0,32000));
	   $ctr = 0;
	   $tmp = '';
	   for($i = 0;$i<strlen($txt);$i++) {
	    $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
	    $tmp .= $encrypt_key[$ctr].($txt[$i]^$encrypt_key[$ctr++]);
	   }
	   return base64_encode(__key($tmp,$key));
   }

  function decrypt($txt,$key=HS_KEY)
  {
	   $txt = __key(base64_decode($txt),$key);
	   $tmp = '';
	   for($i = 0;$i < strlen($txt); $i++) {
	    $md5 = $txt[$i];
	    $tmp .= $txt[++$i] ^ $md5;
	   }
	   return $tmp;
	}

	function __key($txt,$encrypt_key)
	{
		$encrypt_key = md5($encrypt_key);
		$ctr = 0;
		$tmp = '';
		for($i = 0; $i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
		}
		return $tmp;
	}*/

function encrypt($txt)
{
	return base64_encode(HS_KEY.$txt);
}
function decrypt($txt)
{
	$str =  base64_decode($txt);
	return str_replace(HS_KEY,"",$str);
}
function sysMsg($text,$url="history.go(-1);")
	{
		$str = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";
		$str .=  "<script>alert('$text');$url</script>";
		die($str);
	}

 function getNumList($from,$end,$sort)
	{
		$arr = array();
		if($sort =="DESC")
		{
			for ($i=$end;$i>$from;$i--)
			{
				$arr[$i] = $i;
			}
		}
		else
		{
			for ($i=$from;$i<$end;$i++)
			{
				$arr[$i] = $i;
			}
		}

		return $arr;
	}

  function discount($price1,$price2)
  {
  	$discount = $price1*100/$price2;
  	return $discount;
  }

  function leavHr($endtime)
  {
  	$time = (strtotime($endtime)-time());
  	if ($time >= 86400 ) {
		$day = floor($time/86400);
		$time = $time-$day*86400;
		$str = $day.'天';
		$str .= floor($time/3600).'小时';
	}else
	{
		$str = floor($time/3600).'小时';
	}
  	return $str;
  }

    function createKey($str)
	{
		$str = md5($str);
		$str = substr($str,7,25);
		return $str;
	}

	function diffDate($date1,$date2)
	{
		if(strtotime($date1) > strtotime($date2))
		{
			$ymd = $date2;
			$date2 = $date1;
			$date1 = $ymd;
		}

		list($y1,$m1,$d1) = explode('-',$date1);
		list($y2,$m2,$d2) = explode('-',$date2);

		$y = $m = $d = $_m = 0;
		$math = ($y2-$y1)*12+$m2-$m1;
		$y = round($math/12);
		$m = intval($math%12);
		$d = (mktime(0,0,0,$m2,$d2,$y2) - mktime(0,0,0,$m2,$d1,$y2))/86400;

		if($d < 0)
		{
			$m -= 1;
			$d += date('j',mktime(0,0,0,$m2,0,$y2));
		}
		$m < 0 && $y -= 1;

		//return array($y,$m,$d);
		$str = "";
		if($y)$str=$y."年";
		if($m)$str=$m."月";
		if($d)$str=$d."天";
		return $str;
	}
?>