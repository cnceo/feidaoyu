<?php
	require_once(dirname(dirname(__FILE__))."/configs/config.php");
	require_once("MainController.class.php");
	defined('_START_') or header("Location: /"._URL_."/eorr/sorry/");
	session_start();
	
   /**
   * @package   Seasoft
   * @Author by Vince Shen<vinceshen@live.com>
   * @version  v1.0
   */
	class App
	{
		
		/**
		 * private
		 */
		 protected $mType = null;
		 protected $mAction = null;
		 protected $mModel = null;
		 
		
		public function __construct()
		{
			preg_match('/^([a-z\-]+)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
			switch ($matches[1])
			{
				case 'zh-cn' :
				case 'zh-tw' :
				     $_GET["lang"]="cn"; 
				     break;
				case 'jp' :
				      $_GET["lang"]="jp";  
				     break;
				default: 
				     //$_GET["lang"]="en";
				     $_GET["lang"]="cn";
				     break;
			}
			if(!isset($_GET["m"]))$_GET["m"] = "index";
			if(!isset($_GET["a"]))$_GET["a"] = "defshow";
			if(!isset($_GET["type"])) 
			{
				$this->mType = "default";
			}
			else
			{
				$this->mType = $_GET["type"];
			}
			$this->mModel = $_GET["m"];
			if(isset($_GET["a"]))$this->mAction = $_GET["a"];
		}
		
		public function Run()
		{
			if (@include "mods/".$this->mType."/".$this->mModel.".class.php")
			{
				$m = new $this->mModel;
				$m->mType = $this->mType;
				$m->mModel = $this->mModel;
				$m->mAction = $this->mAction;
				$this->result = $m->$_GET["a"]();
				//$m->helpContent();
				$m->Display();
				} else {
				echo "mods/".$this->mType."/".$this->mModel.".class.php";
				//header("Location: "._URL_."/eorr/sorry/");
			}
		}
		
	}
?>