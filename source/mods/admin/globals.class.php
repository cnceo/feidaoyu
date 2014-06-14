<?php
 	class globals extends Controller 
 	{
 		public function show()
 		{
 			$this->checkLogin();
 			if($this->mPur->adminCheck("SYS_BASIC","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
 			if($this->mAction=="save")
 			{
 				$this->mLog->adminLog("更新全局设置"); 
 				$this->save();
 			}
 			$this->result["log"]["url"] = _URL_;
 			$this->result["log"]["dbhost"] = _DB_HOST;
 			$this->result["log"]["dbuser"] = _DB_USER;
 			$this->result["log"]["dbpass"] = _DB_PASS;
 			$this->result["log"]["dbname"] = _DB_NAME;
 			$this->result["log"]["dbtype"] = _DB_TYPE;
 			$this->result["log"]["dbchar"] = _DB_CHAR;
 			$this->result["log"]["dbdebug"] = _DB_DEBUG;
 			$this->result["log"]["pages"] = _PAGES;
 			$this->result["log"]["lang"] = _LANG;
 			$this->result["log"]["css"] = _CSS_PATH;
 			$this->result["log"]["file"] = _FILE_PATH;
 			$this->result["log"]["cache"] = _CAC_PATH;
 			$this->result["log"]["tpl"] = _TPL_PATH;
 			
 			$this->result["urls"] = array(
									"" => ".htaccess",
									"/index.php" => "index.php",
									"/?" => "?"
									);
									
 			$this->result["sites"]["system"] = "active";
 			$this->result["caches"] = array(
									0 => "开启",
									1 => "禁用"
									);
 			$this->tplname = 'globals';
 			$this->mLog->adminLog("查看全局设置"); 
 			$this->Display();
 		}
 		
 		private function save()
 		{
 			$str = "<?php
 			";
 			foreach($_POST as $key => $val)
	 		{
	 			$str .="define('$key', '$val');
	 			";
	 		}
 			$str .= "?>";
 			$fp=fopen(_APP_PATH."configs/config.php","wb");
			fwrite ($fp,$str);
			fclose($fp);
			$this->create();
 			die();
 		}
 		private function create()
 		{
 			$path = getcwd();
 			$str="Options +FollowSymLinks
RewriteEngine On
RewriteBase /
RewriteRule ^/$  /index.php?type=default&model=index [L]
RewriteRule ^{0,1}$ /index.php?type=admin&model=index [L]
RewriteRule ^([^\/\.]+)\/{0,1}$ /index.php?type=admin&model=$1 [L]
RewriteRule ^user/([^\/\.]+)\/{0,1}$ /index.php?type=user&model=$1 [L]
RewriteRule ^user/([^\/\.]+)\/([^\/\.]+)/([^\/\.]+)/{0,1}$ /index.php?type=user&model=$1&$2=$3 [L]
RewriteRule ^eorr/([^\/\.]+)\/{0,1}$ /index.php?type=eorr&model=$1 [L]
RewriteRule ^([^\/\.]+)\/([^\/\.]+)/([^\/\.]+)/{0,1}$ /index.php?type=admin&model=$1&$2=$3 [L]
RewriteRule ^([^\/\.]+)\/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/{0,1}$ /index.php?type=admin&model=$1&$2=$3&$4= [L]
RewriteRule ^([^\/\.]+)\/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/{0,1}$ /index.php?type=admin&model=$1&$2=$3&$4=$5 [L]
RewriteRule ^([^\/\.]+)\/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/{0,1}$ /index.php?type=admin&model=$1&$2=$3&$4=$5&$6= [L]
RewriteRule ^([^\/\.]+)\/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/{0,1}$ /index.php?type=admin&model=$1&$2=$3&$4=$5&$6=$7 [L]
RewriteRule ^([^\/\.]+)\/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/([^\/\.]+)/{0,1}$ /index.php?type=admin&model=$1&$2=$3&$4=$5&$6=$7&$8=$9 [L]
RewriteRule ^([^\/\.]+)\/{0,1}$ /index.php?type=default&model=index&lang=$1 [L]
RewriteRule ^([^\/\.]+)/([^\/\.]+)\/{0,1}$ /index.php?type=article&model=index&lang=$1&cate=$2 [L]
RewriteRule ^([^\/\.]+)\/{0,1}$ /index.php?type=$1&model=index [L]
RewriteRule ^([^\/\.]+)/([^\/\.]+)/([^\/\.]+).html  /index.php?lang=$1&type=article&model=detail&cate=$2&id=$3 [L]
 			";
 			if($_POST["_URL_"])
 			{
 				system("rm -rf $path/.htaccess");
 			}
 			else
 			{
	 			$fp=fopen($path."/.htaccess","wb");
				fwrite ($fp,$str);
				fclose($fp);
 			}
 		}
 	}
?>