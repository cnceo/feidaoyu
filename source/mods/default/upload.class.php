<?php
  class upload extends Controller 
 	{
 		protected $tpl;
 		public  $mFile;
 		public function defshow()
 		{
 			$this->_globals();
 			if($_FILES || $_POST)
 			{
 				if (!empty($_FILES))
 				{
					if(@$_REQUEST['SESSION_ID'])$this->mFile->mUid = $_REQUEST['SESSION_ID'];//解决flash/uploadify上传时session丢失的问题
 					$file = $this->mFile->upfile();
					die($file);
				}
				if(!empty($_POST))
				{
					if($_POST["thumb"])
					{
						$imgfile = str_replace(IMG_HOST,"",$_POST["imageSource"]);
						$this->mFile->thumb($imgfile,100,100);
						$this->mFile->thumb($imgfile,140,140);
						$this->mFile->thumb($imgfile,280,280);
						$this->mFile->thumb($imgfile,460,460);
					}
					else
					{
						$imgfile = $this->mFile->cropImage();
						$this->mFile->thumb($imgfile,100,100);
						$this->mFile->thumb($imgfile,140,140);
						$this->mFile->thumb($imgfile,280,280);
						$this->mFile->thumb($imgfile,460,460);
					}
					
					die($imgfile);
				}
			   die();
 			}
 			$this->result["path"] = "/".date("Ym").'/'.date("d");
 		}
 		
 		public function crop()
 		{
 			$this->checkUserLogin();
 			$this->_globals();
			$sourcefile = dirname(dirname(dirname(dirname(__FILE__))))."/uploads".$_GET["fileurl"];
			$this->result["file"]["date"] = date("Y-m-d H:i:s",filemtime($sourcefile));
			$this->result["file"]["size"] = formatsize(filesize($sourcefile));
			//echo $sourcefile;
			list($this->result["file"]["width"], $this->result["file"]["height"]) = getimagesize($sourcefile);
 			
 		}
 		
 		public function view()
 		{
 			$this->checkUserLogin();
 			$this->_globals();
 		}
 		
 		public function multiimg()
 		{
 			$this->checkUserLogin();
 			$this->_globals();
 			$this->result["path"] = "/".date("Ym").'/'.date("d");
 		}
 		
 		public function delatt()
 		{
 			$this->checkUserLogin();
 			$this->_globals();
 			//print_r($_POST);
 			$this->mFile->delete($_POST["id"]);
 			die();
 		}
 		
 		public function purview()
 		{
 			$this->checkUserLogin();
 			$this->_globals();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$r = $this->mFile->getFilebyUid($this->mFile->mUid,$this->mFile->mUtype);
 			$this->result["logs"] = $r["logs"];
 			$this->result["pages"] = $r["pages"];
 		}
 		
 		public function video() 
 		{
			$this->checkUserLogin();
			$this->_globals();
			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$r = $this->mFile->getFilebyUid($this->mFile->mUid,$this->mFile->mUtype,'0');
 			$this->result["logs"] = $r["logs"];
 			$this->result["pages"] = $r["pages"];
 			$this->_globals();
		
		}
 		
 		private function _globals()
 		{
 			$this->loadModel(array("Purview","Basic","User","File"));
			$this->mFile->mUid = $_SESSION["login_user"]["id"];
			$this->mFile->mUtype = "user";
 			if($_GET["fileurl"])
 			{
	 			$this->result["file"]["path"] = dirname($_GET["fileurl"]);
				$this->result["file"]["name"] = basename($_GET["fileurl"]);
				$this->result["file"]["url"] = $_GET["fileurl"];
 			}
 			$this->result["session_id"] = $this->mFile->mUid;
			$this->result["SERVER_NAME"]=$_SERVER['SERVER_NAME'];
 			$this->tplname = "upload";
 		}
 		
 	}
?>