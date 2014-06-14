<?php
	require_once("libs/Database.class.php");
	require_once("libs/Log.class.php");
	require_once ("libs/smarty/Smarty.class.php");
	require_once ("utils/Functions.inc.php");

	/**
	 * Enter description here...
	 *
	 */
	class Controller
	{
		/**
		 * private
		 */
		 public $mType = null;
		 public $mAction = null;
		 public $mModel = null;
		 public $mSite = null;
		 public $mLog = null;
		 protected $mTpl = null; //tpl  object

		/**
		 * Enter description here...
		 *
		 * @return Controller
		 */

		public function __construct()
		{
			$this->getDefaultDbLink();
			$this->getLog();     //加载日志模块
			$this->loadSites();   //加入站点信心

		}


		/**
		 * 输出内容
		 *
		 */
		public function Display()
		{
			$this->getSmarty();
		 	$this->AssignToSmarty($this->result);
		 	/*if($this->mType!="admin")
		 	{
		 		$this->mTpl->display($this->mType."/".$this->tplname.".tpl");
		 	}
		 	else
		 	{
		 		$this->mTpl->display($this->tplname.".tpl");
		 	}*/
		 	$this->mTpl->display($this->mType."/".$this->tplname.".tpl");
		}

		private function AssignToSmarty($param=array() )
		{
			#assign value to smarty Object.
			if(is_array($param))
			{
				foreach($param as $key => $val)
				{
					$this->mTpl->assign($key,$val);
				}
			}
		}

		/**
		 * 数据库连接
		 *
		 * @return Object
		 */
		private function getDefaultDbLink()
		{
			global $_DB;
			if (!$this->mDb)
			{
				$this->mDb = NewADOConnection(_DB_TYPE);
				$this->mDb->Connect(_DB_HOST, _DB_USER,_DB_PASS, _DB_NAME);
				$this->mDb->debug=(_DB_DEBUG)?"1":"0";
				$this->mDb->query("SET CHARACTER SET "._DB_CHAR);
				//$this->mDb = new Databases();
				//print_r($this->mDb);
			}
		}

		/**
		 * Log
		 *
		 * @return Object
		 */
		private function getLog()
		{
			if (!$this->mLog)
			{
				$this->mLog = new Logs();
				$this->mLog->mDb = $this->mDb;
			}
		}

		/**
		 * Smarty
		 *
		 * @return Object
		 */
		private function getSmarty()
		{
			if (!$this->mTpl)
			{
				$tpl = new Smarty();
				$tpl->template_dir = _TPL_PATH;
				$tpl->compile_dir = _TPL_PATH . "/compile/";
				$tpl->config_dir = _TPL_PATH . "/configs/";
				$tpl->cache_dir = _TPL_PATH . "/cache/";
				$tpl->left_delimiter = '{{';
				$tpl->right_delimiter = '}}';
				$this->mTpl = $tpl;
			}
		}

		public  function loadModel($arr)
		{
			foreach ($arr as $key)
			{
				require_once("libs/$key.class.php");
				$modelName = "m".$key;
				$calssName = $key."s";
				$this->$modelName = new $calssName();
				$this->$modelName->mDb = $this->mDb;
				$this->$modelName->mLog = $this->mLog;
			}
		}

		public function Del($table,$id)
	  	{
	  		$sql = "DELETE FROM ".get_table($table)." WHERE id=".$id;
	  		$rs = $this->mDb->execute($sql);
	  		if(!$rs)
			 {
			 	return false;
			 }
			 else
			 {
			 	return true;
			 }
	  	}

		public function getRow($table,$id)
	  	{
	  		$sql = "SELECT *  FROM ".get_table($table);
	  		if($id)$sql.=" WHERE id=".$id;
	  		$rs = $this->mDb->getrow($sql);
	  		return $rs;
	  	}

	  	public function Update($table,$id,$set)
		{
			$sql = "UPDATE ".get_table($table)." SET $set WHERE id=$id";
	 		$rs = $this->mDb->execute($sql);
		}

		private function loadSites()
		{
			$this->result["sites"] = $this->getRow("sites",1);
			$this->result["sites"]["badwords"] = explode(" ",$this->result["sites"]["badwords"]);
			if($this->mType!="admin")
			{
				$this->cartcount();
			}
		}

		private function loadPages()
		{
			$_GET["pagesize"]=empty($_GET['pagesize'])?_PAGES:$_GET['pagesize'];
			$this->result["sites"]["pagesize"] = array(10=>10,20=>20,30=>30,50=>50,100=>100,200=>200);
			$this->result["sites"]["currentps"] = $_GET["pagesize"];
		}

		public function loadEorr()
		{
			if(_URL_)
			{
				header("Location: /"._URL_."/eorr/sorry/");
			}
			else
			{
				header("Location: /eorr/sorry/");
			}
		}

		public function cartcount()
		{
			$this->result["cartcount"] = count($_SESSION["shopcart"]);
		}

		public function checkLogin()
		{
			if(!$_SESSION["login_".$this->mType])
			{
				header("Location: ?type=".$this->mType."&m=".encrypt("login"));
			}
			else
			{
				$this->result["login_".$this->mType] = $_SESSION["login_".$this->mType];
			}
		}

/*		public function helpContent()
		{
			$this->result["aboutlist"] = $this->mArt->getNavList(1,5,"cn","ASC");
			$this->result["newuserlist"] = $this->mArt->getNavList(2,5,"cn","ASC");
			$this->result["paylist"] = $this->mArt->getNavList(3,5,"cn","ASC");
			$this->result["shipplist"] = $this->mArt->getNavList(4,5,"cn","ASC");
			$this->result["saleslist"] = $this->mArt->getNavList(5,5,"cn","ASC");
		}*/

		public function checkUserLogin()
		{
			if(!$_SESSION["login_user"])
			{
				header("Location: /user/login.html?baseurl=".urlencode($_SERVER["REQUEST_URI"]));exit();
							}
			else
			{
				$this->result["login_user"] = $_SESSION["login_user"];
			}
		}
	}

?>
