<?php
	class DBAdmins
	{
		public $mDb;
		public $mPath;
		public function getList($type=null)
		{
			$sql = "SELECT * FROM ".get_table("backuplist")." ORDER BY addtime DESC LIMIT 30";
			$rs = $this->mDb->getall($sql);
			if(!empty($type))
			{
				$cate = array();
				foreach ($rs as $val)
					{
						$cate[$val["id"]] = $val["filename"];
					}
				$rs = $cate;
			}
			return $rs;
		}
		
		public function build()
		{
			if(!file_exists($this->mPath))
	        {  
			 	mkpath($this->mPath);	
			}
			$filename = date("Ymdhis").".sql";
			/*echo "mysqldump -h "._DB_HOST." -u "._DB_USER." -p"._DB_PASS." "._DB_NAME." > ".$this->mPath.$filename;
			die();*/
			system("mysqldump -h "._DB_HOST." -u "._DB_USER." -p"._DB_PASS." "._DB_NAME." --skip-lock-tables > ".$this->mPath."/".$filename);
			$sql = "INSERT INTO ".get_table("backuplist")." SET filename='$filename',path='".$this->mPath."'";
			$this->mDb->execute($sql);
			return $filename;
		}
		
		function revert()
		{
			$this->build();
			$sql ="SELECT * FROM ".get_table("backuplist")." WHERE id=".$_POST["dataid"];
			$rs = $this->mDb->getrow($sql);
			$path = $rs["path"].$rs["filename"];
			system("mysql -h "._DB_HOST." -u "._DB_USER." -p"._DB_PASS." "._DB_NAME." < ".$this->mPath."/".$rs["filename"]);
		}
		
		function getfile($filename)
		{
			header('Content-Description: File Transfer');   
			header('Content-Type: application/octet-stream');   
			header('Content-Disposition: attachment; filename='.$filename);   
			header('Content-Transfer-Encoding: binary');   
			header('Expires: 0');   
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');   
			header('Pragma: public');   
			header('Content-Length: ' . $filesize);   
			ob_clean();   
			flush();   
			readfile($this->mPath."/".$filename);   
			die();
		}
	}
?>