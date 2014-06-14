<?php
	require_once(dirname(dirname(__FILE__))."/configs/config.php");
	require_once("MainController.class.php");
	defined('_START_') or header("Location: /"._URL_."/eorr/sorry/");
	session_start();
	
   /**
   * @package   Seasoft
   * @Author by Vince Shen<vinceshen@live.com>
   * @version  v2.0
   */
	class App
	{
		
		/**
		 * private
		 */
		 protected $mType = null;
		 protected $mAction = null;
		 protected $mModel = null;
		 
		 /**
		 * Enter description here...
		 *
		 * @return Controller
		 */
		
		public function __construct()
		{
			if(!isset($_GET["m"]))
			{
				$_GET["m"] = "index";
			}
			else
			{
				$_GET["m"] = decrypt($_GET["m"]);
			}
			if(!isset($_GET["a"]))$_GET["a"] = "defshow";
			if(!isset($_GET["type"])) 
			{
				$this->mType = "admin";
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
				$m->Display();
				} else {
				echo "mods/".$this->mType."/".$this->mModel.".class.php";
				//header("Location: "._URL_."/eorr/sorry/");
			}
		}
		
	}
?>