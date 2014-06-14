<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @return string
 */
//function smarty_modifier_truncate($string, $length = 80, $etc = '...',
//                                  $break_words = false)
//{
//    if ($length == 0)
//        return '';
///*
//    if (strlen($string) > $length) {
//        $length -= strlen($etc);
//        if (!$break_words)
//            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
//
//        return substr($string, 0, $length).$etc;
//    } else
//        return $string;
//*/
//
//	if(strlen($string) > $length) {
//		for($i = 0; $i < $length; $i++) {
//			if(ord($string[$i]) > 127) {
//				$wordscut .= $string[$i].$string[$i + 1];
//				$i++;
//			} else {
//				$wordscut .= $string[$i];
//			}
//		}
//		return $wordscut.$etc;
//	}
//	return $string;
//
//}

function smarty_modifier_truncate($string, $sublen = 80, $code="UTF-8", $etc = '...', $break_words = false, $middle = false)
{
$start=0;

       if($code == 'UTF-8')
   {
       //如果有中文则减去中文的个数
       $cncount=cncount($string);
       if($cncount>($sublen/2))
       {
            $sublen=ceil($sublen/2);
       }
       else
       {
            $sublen=$sublen-$cncount;
       }
  
       $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
       preg_match_all($pa, $string, $t_string);

       if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
       return join('', array_slice($t_string[0], $start, $sublen));
   }
   else
   {
       $start = $start*2;
       $sublen = $sublen*2;
       $strlen = strlen($string);
       $tmpstr = '';

       for($i=0; $i<$strlen; $i++)
       {
           if($i>=$start && $i<($start+$sublen))
           {
               if(ord(substr($string, $i, 1))>129)
               {
                   $tmpstr.= substr($string, $i, 2);
               }
               else
               {
                   $tmpstr.= substr($string, $i, 1);
               }
           }
           if(ord(substr($string, $i, 1))>129) $i++;
       }
       if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";
       return $tmpstr;
   }

}


function cncount($str)
{
$len=strlen($str);
    $cncount=0;
  
    for($i=0;$i<$len;$i++)
   {
      $temp_str=substr($str,$i,1);
     
      if(ord($temp_str) > 127)
      {
          $cncount++;
      }
    }

    return ceil($cncount/3);
}




/* vim: set expandtab: */

?>