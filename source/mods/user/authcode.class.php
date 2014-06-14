<?php
class authcode extends  AuthCodes 
{
	
	public function check()
	{
		if(md5(strtoupper($_GET['checkcode'])) == $_SESSION['auth_code']){
			   echo 1;
			}else{
				echo 0;
			}
			exit();
	}
	public function defshow()
	{
		
		/**
		 * 这个页面用于生成验证码图像
		 * 
		 * @author  coolhpy <coolhpy@163.com>
		 * @create  2006-6-17
		 * 
		 * 2006-7-9     增加 PHP5 的支持
		 */
		if(!$_SESSION["bg"]["r"])$_SESSION["bg"]["r"]=250;
		if(!$_SESSION["bg"]["g"])$_SESSION["bg"]["g"]=250;
		if(!$_SESSION["bg"]["b"])$_SESSION["bg"]["b"]=250;
		header("Cache-Control: no-cache, must-revalidate");
		// 定义验证码信息
		$arr['code'] = array(
		    'characters' => 'A-H,J-N,P-Z,1-9', 
		    'length' => 4,
		    'deflect' => true,
		    'multicolor' => false
		);
		$this->setCode($arr['code']);
		
		// 定义干扰信息
		$arr['molestation'] = array(
		    'type' => 'line', 
		    'density' => 'normal'
		);
		$this->setMolestation($arr['molestation']);
		
		// 定义图像信息. 设置图象类型请确认您的服务器是否支持您需要的类型
		$arr['image'] = array(
		    'type' => 'png', 
		    'width' => 70, 
		    'height' => 18
		);
		$this->setImage($arr['image']);
		
		// 定义字体信息
		$arr['font'] = array(
		    'space' => 3, 
		    'size' => 12, 
		    'file' => _APP_PATH."fonts/arial.ttf"
		);
		$this->setFont($arr['font']);
		
		// 定义背景色
		$arr['bg'] = array(
		    'r' => $_SESSION["bg"]["r"], 
		    'g' => $_SESSION["bg"]["g"], 
		    'b' => $_SESSION["bg"]["b"]
		);
		$this->setBgColor($arr['bg']);
		
		// 输出到浏览器
		$this->paint();
		
		// 输出到文件, 文件名中不需要扩展名
		//$auth_code->paint('./test');
		die();
	}
}
/**
 * 这个类用于生成验证码图像, 同时可以对用户输入的验证码进行验证
 * 
 * @author  coolhpy <coolhpy@163.com>
 * @create  2006-6-17
 * 
 * 2006-7-9     修正干扰象素的算法
 * 2006-10-22   修正了一些默认值。如果不设置验证码的位置，则默认为居中
 *              取消了对GIF的支持，因为 imagecreatetruecolor() 方法不支持
 */

class AuthCodes 
{
    /**
     * 验证码
     *  char:   字符
     *  angle:  字符偏移的角度 (-30 <= angle <= 30)
     *  color:  字符颜色
     * 
     * @var     array
     * @access  private
     */
    var $code = array();

    /**
     * 字体信息
     *  space:  字符间隔 (px)
     *  size:   字体大小 (px)
     *  left:   第一个字符距离图像最左边的象素 (px)
     *  top:    字符距离图像最上边的象素 (px)
     *  file:   字体文件的路径
     * 
     * @var     array
     * @access  private
     */
    var $font = array();

    /**
     * 图像信息
     *  type:   图像类型
     *  mime:   MIME 类型
     *  width:  图像的宽 (px)
     *  height: 图像高 (px)
     *  func:   创建图像的方法
     * 
     * @var     array
     * @access  private
     */
    var $image = array();

    /**
     * 干扰信息
     *  type:    干扰类型 (False 表示不使用)
     *  density: 干扰密度
     * 
     * @var     array
     * @access  private
     */
    var $molestation = array();

    /**
     * 背景色 (RGB)
     *  r:  红色 (0 - 255)
     *  g:  绿色 (0 - 255)
     *  b:  蓝色 (0 - 255)
     * 
     * @var     array
     * @access  private
     */
    var $bg_color = array();

    /**
     * 默认前景色 (RGB)
     *  r:  红色 (0 - 255)
     *  g:  绿色 (0 - 255)
     *  b:  蓝色 (0 - 255)
     * 
     * @var     array
     * @access  private
     */
    var $fg_color = array();

    /**
     * Session 变量名
     * 
     * @var     string
     * @access  private
     */
    var $session = '';



    /**
     * 构造函数
     * 
     * @access  public
     */
    function AuthCodes() 
    {
		$this->setCode(null);
		$this->setMolestation(null);
		$this->setBgColor(null);
		$this->setImage(null);
		$this->setFont(null);	// code, image 两部分必须在 font 之前定义
		$this->setSession('');
    }

    /**
     * 设置验证码
     * 
     * @access  public
     * @param   array   字符信息
     *  characters   string  允许的字符
     *  length       int     验证码长度
     *  deflect      boolean 字符是否偏转
     *  multicolor   boolean 字符是否彩色
     * @return  void
     */
    function setCode($code) 
    {
        if (is_array($code)) 
        {
            if (!isset($code['characters']) || !is_string($code['characters'])) 
            {
                $code['characters'] = 'A-H,J-N,P-Z,1-9';
            }
            if (!(is_integer($code['length']) || $code['length']<=0)) 
            {
                $code['length'] = 4;
            }
            if (!is_bool($code['deflect'])) 
            {
                $code['deflect'] = true;
            }
            if (!is_bool($code['multicolor'])) 
            {
                $code['multicolor'] = false;
            }
        } else 
        {
            $code = array('characters'=>'A-H,J-N,P-Z,1-9', 'length'=>4, 
                          'deflect'=>true, 'multicolor'=>false);
        }

        $this->code = $code;
    }

    /**
     * 设置 session 变量名
     * 
     * @access  public
     * @param   string  session 变量名
     * @return  void
     */
    function setSession($session) 
    {
        if (isset($session) && !empty($session)) 
        {
            $this->session = $session;
        } else
        {
            $this->session = 'auth_code';
        }
    }

    /**
     * 设置背景色
     * 
     * @access  public
     * @param   array   RGB 颜色
     * @return  void
     */
    function setBgColor($color) 
    {
        if (is_array($color) && is_integer($color['r']) && 
            is_integer($color['g']) && is_integer($color['b']) && 
            ($color['r'] >= 0 && $color['r'] <= 255) && 
            ($color['g'] >= 0 && $color['g'] <= 255) && 
            ($color['b'] >= 0 && $color['b'] <= 255)) 
        {
            $this->bg_color = $color;
        } else 
        {
            $this->bg_color = array('r'=>255,'g'=>255,'b'=>255);
        }

        // 设置默认的前景色, 与背景色相反
        $fg_color = array(
            'r'=>255-$this->bg_color['r'], 
            'g'=>255-$this->bg_color['g'], 
            'b'=>255-$this->bg_color['b']
        );
        $this->setFgColor($fg_color);
    }

    /**
     * 设置干扰信息
     * 
     * @access  public
     * @param   array   干扰信息
     *  type    string  干扰类型 (选项: false, 'point', 'line')
     *  density string  干扰密度 (选项: 'normal', 'muchness', 'fewness')
     * @return  void
     */
    function setMolestation($molestation) 
    {
        if (is_array($molestation)) 
        {
            if (!isset($molestation['type']) || 
                ($molestation['type']!='point' && 
                 $molestation['type']!='line' && 
                 $molestation['type']!='both')) 
            {
                $molestation['type'] = 'point';
            }
            if (!is_STRING($molestation['density'])) 
            {
                $molestation['density'] = 'normal';
            }
            $this->molestation = $molestation;
        } else 
        {
            $this->molestation = array(
                'type'    => 'both',
                'density' => 'normal'
            );
        }
    }

    /**
     * 设置字体信息
     * 
     * @access  public
     * @param   array   字体信息
     *  space   int     字符间隔 (px)
     *  size    int     字体大小 (px)
     *  left    int     第一个字符距离图像最左边的象素 (px)
     *  top     int     字符距离图像最上边的象素 (px)
     *  file    string  字体文件的路径
     * @return  void
     */
    function setFont($font) 
    {
        if (is_array($font))
        {
            if (!is_integer($font['space']) || $font['space']<0)
            {
                $font['space'] = 5;
            }
            if (!is_integer($font['size']) || $font['size']<0)
            {
                $font['size'] = 12;
            }
            if (!is_integer($font['left']) || $font['left']<0 || 
                $font['left']>$this->image['width']) 
            {
			    $font['left'] = $this->image['width'] - 
                                ($font['size'] + $font['sapce']) 
                                * $this->code['length'] - $font['size'];
            }
            if (!is_integer($font['top']) || $font['top']<0 || 
                $font['top']>$this->image['height']) 
            {
                $font['top'] = ($this->image['height'] - $font['size']) / 2
                               + $font['size'];
            }
            if (!file_exists($font['file'])) 
            {
                $font['file'] = _APP_PATH."fonts/arial.ttf";
            }
            $this->font = $font;
        } else
        {
            $this->font = array('space'=>5, 'size'=>12, 
                                'top'=>($this->image['height']-5), 
                                'file'=>_APP_PATH."fonts/arial.ttf");
			$this->font['left'] = $this->image['width'] - 
                                  ($this->font['size'] + $this->font['sapce']) 
                                  * $this->code['length'] - $this->font['size'];
			$this->font['top'] = ($this->image['height'] - $this->font['size']) / 2
                                 + $this->font['size'];
        }
    }

    /**
     * 设置图像信息
     * 
     * @access  public
     * @param   array   图像信息
     *  type    string  图像类型 (选项: 'png', 'wbmp', 'jpg')
     *  width   int     图像宽 (px)
     *  height  int     图像高 (px)
     * @return  void
     */
    function setImage($image) 
    {
        if (is_array($image)) 
        {
            if (!is_integer($image['width']) || $image['width'] <= 0) 
            {
                $image['width'] = 70;
            }
            if (!is_integer($image['height']) || $image['height'] <= 0) 
            {
                $image['height'] = 25;
            }
            $this->image = $image;
            $information = $this->getImageType($image['type']);
            if (is_array($information)) 
            {
                $this->image['mime'] = $information['mime'];
                $this->image['func'] = $information['func'];
            } else 
            {
                $this->image['type'] = 'png';
                $information = $this->getImageType('png');
                $this->image['mime'] = $information['mime'];
                $this->image['func'] = $information['func'];
            }
        } else 
        {
            $information = $this->getImageType('png');
            $this->image = array(
                'type'=>'png', 
                'mime'=>$information['mime'], 
                'func'=>$information['func'], 
                'width'=>70, 
                'height'=>25);
        }
    }

    /**
     * 绘制图像
     * 
     * @access  public
     * @param   string  文件名, 留空表示输出到浏览器
     * @return  void
     */
    function paint($filename='') 
    {
        // 创建图像
        $im = imagecreatetruecolor($this->image['width'], 
                                   $this->image['height']);

        // 设置图像背景
        $bg_color = imagecolorallocate($im, $this->bg_color['r'], 
                                       $this->bg_color['g'], 
                                       $this->bg_color['b']);
        imagefilledrectangle($im, 0, 0, $this->image['width'], 
                             $this->image['height'], $bg_color);

        // 生成验证码相关信息
        $code = $this->generateCode();

        // 生成的验证码
        $the_code = '';

        // 向图像中写入字符
        $num = count($code);
        $current_left = $this->font['left'];
        $current_top  = $this->font['top'];

        for ($i=0; $i<$num; $i++) 
        {
           // $font_color = imagecolorallocate($im, rand(0,255),rand(0,255),rand(0,255));
          $font_color = imagecolorallocate($im, $code[$i]['color']['r'], 
                                             $code[$i]['color']['g'], 
                                             $code[$i]['color']['b']);
            imagettftext($im, $this->font['size'], $code[$i]['angle'], 
                         $current_left, $current_top, $font_color, 
                         $this->font['file'], iconv("gbk", "utf-8", $code[$i]['char']));
            $current_left += $this->font['size'] + $this->font['space'];

            $the_code .= $code[$i]['char'];
        }

        // 初始化 session
        // 如果 session 未启用, 则开启它
        if (empty($_SESSION['SID'])) @session_start();

        // 用 md5() 给密码加密, 写入 session
        $_SESSION[$this->session] = md5($the_code);
        $_SESSION[$this->session.'_none_case'] = md5(strtolower($the_code));
        //setcookie($this->session, md5($the_code), time()+60*5, "/");
       // setcookie($this->session.'_none_case', md5($the_code), time()+60*5, "/");
        //echo $this->session;

        // 绘制图像干扰
        $this->paintMolestation($im);

        // 输出
        if (isset($filename) && $filename!='') 
        {
            $this->image['func']($im, $filename.$this->image['type']);
        } else 
        {
            header("Cache-Control: no-cache, must-revalidate");
            header("Content-type: ".$this->image['mime']);
            $this->image['func']($im);
        }
        imagedestroy($im);
    }

    /**
     * 验证用户输入的验证码
     * 
     * @param   string  用户输入的字符串
     * @param   boolean 是否区分大小写
     * @return  boolean 正确返回 true
     */
    function validate($input, $is_match_case=true) 
    {
    	if ($is_match_case) 
        {
            //return (strcmp($_SESSION[$this->session], md5($input)) == 0);
        	return (strcmp($_COOKIE[$this->session], md5($input)) == 0);
        } else 
        {
            return (strcmp($_COOKIE[$this->session.'_none_case'], 
                           md5(strtolower($input))) == 0);
        }
    }



    /**
     * 设置前景色
     * 
     * @access  private
     * @param   array   RGB 颜色
     * @return  void
     */
    function setFgColor($color) 
    {
        if (is_array($color) && is_integer($color['r']) && 
            is_integer($color['g']) && is_integer($color['b']) && 
            ($color['r'] >= 0 && $color['r'] <= 255) && 
            ($color['g'] >= 0 && $color['g'] <= 255) && 
            ($color['b'] >= 0 && $color['b'] <= 255)) 
        {
            $this->fg_color = $color;
        } else 
        {
            $this->fg_color = array('r'=>0, 'g'=>0, 'b'=>0);
        }
    }

    /**
     * 生成随机验证码
     * 
     * @access  private
     * @return  array   生成的验证码
     */
    function generateCode() 
    {
        // 创建允许的字符串
        $array_allow = array();
        $characters = explode(',', $this->code['characters']);
        $num = count($characters);
        for ($i=0; $i<$num; $i++) 
        {
            if (substr_count($characters[$i], '-') > 0) 
            {
                $character_range = explode('-', $characters[$i]);
                for ($j=ord($character_range[0]); $j<=ord($character_range[1]);
                     $j++) 
                {
                    $array_allow[] = chr($j);
                }
            } else 
            {
                $array_allow[] = $array_allow[$i];
            }
        }
        $index = 0;
        while (list($key, $val) = each($array_allow)) 
        {
            $array_allow_tmp[$index] = $val;
            $index ++;
        }
        $array_allow = $array_allow_tmp;

        // 生成随机字符串
        mt_srand((double)microtime() * 1000000);
        $code = array();
        $index = 0;
        $i = 0;
        while ($i < $this->code['length']) 
        {
            $index = mt_rand(0, count($array_allow) - 1);
            $code[$i]['char'] = $array_allow[$index];
            if ($this->code['deflect']) 
            {
                $code[$i]['angle'] = mt_rand(-30, 30);
            } else
            {
                $code[$i]['angle'] = 0;
            }
            if ($this->code['multicolor']) 
            {
                $code[$i]['color']['r'] = mt_rand(0, 255);
                $code[$i]['color']['g'] = mt_rand(0, 255);
                $code[$i]['color']['b'] = mt_rand(0, 255);
            } else
            {
                $code[$i]['color']['r'] = $this->fg_color['r'];
                $code[$i]['color']['g'] = $this->fg_color['g'];
                $code[$i]['color']['b'] = $this->fg_color['b'];
            }
            $i++;
        }

        return $code;
    }

    /**
     * 获取图像类型
     * 
     * @access  private
     * @param   string  扩展名
     * @return  [mixed] 错误时返回 false
     */
    function getImageType($extension) 
    {
        switch (strtolower($extension)) 
        {
            case 'png':
                $information['mime'] = image_type_to_mime_type(IMAGETYPE_PNG);
                $information['func'] = 'imagepng';
                break;
            case 'wbmp':
                $information['mime'] = image_type_to_mime_type(IMAGETYPE_WBMP);
                $information['func'] = 'imagewbmp';
                break;
            case 'jpg':
            case 'jpeg':
            case 'jpe':
                $information['mime'] = image_type_to_mime_type(IMAGETYPE_JPEG);
                $information['func'] = 'imagejpeg';
                break;
            default:
                $information = false;
        }
        return $information;
    }

    /**
     * 绘制图像干扰
     * 
     * @access  private
     * @param   resource 图像资源
     * @return  void
     */
    function paintMolestation(&$im) 
    {
        // 总象素
        $num_of_pels = ceil($this->image['width']*$this->image['height']/5);
        switch ($this->molestation['density']) 
        {
            case 'fewness':
                $density = $num_of_pels / 3;
                break;
            case 'muchness':
                $density = $num_of_pels / 3 * 2;
                break;
            case 'normal':
                $density = $num_of_pels / 2;
            default:
        }

        switch ($this->molestation['type']) 
        {
            case 'point':
                $this->paintPoints($im, $density);
                break;
            case 'line':
                $density = $density / 20;
                $this->paintLines($im, $density);
                break;
            case 'both':
                $density = $density / 2;
                $this->paintPoints($im, $density);
                $density = $density / 20;
                $this->paintLines($im, $density);
                break;
            default:
                break;
        }
    }

    /**
     * 画点
     * 
     * @access  private
     * @param   resource 图像资源
     * @param   int      点的数量
     * @return  void
     */
    function paintPoints(&$im, $quantity) 
    {
        mt_srand((double)microtime()*1000000);

        for ($i=0; $i<=$quantity; $i++) 
        {
            $randcolor = imagecolorallocate($im, mt_rand(0,255), 
                                            mt_rand(0,255), mt_rand(0,255));
            imagesetpixel($im, mt_rand(0, $this->image['width']), 
                          mt_rand(0, $this->image['height']), $randcolor);
        }
    }

    /**
     * 画线
     * 
     * @access  private
     * @param   resource 图像资源
     * @param   int      线的数量
     * @return  void
     */
    function paintLines(&$im, $quantity) 
    {
        mt_srand((double)microtime()*1000000);

        for ($i=0; $i<=$quantity; $i++) 
        {
            $randcolor = imagecolorallocate($im, mt_rand(0,255), 
                                            mt_rand(0,255), mt_rand(0,255));
			$x1 = mt_rand(0, $this->image['width']);
			$y1 = mt_rand(0, $this->image['height']);
			$x2 = $x1 + mt_rand(-30, 30);
			$y2 = $y1 + mt_rand(-30, 30);
            imageline($im, $x1, $y1, $x2, $y2, $randcolor);
        }
    }

}
?>
