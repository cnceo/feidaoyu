<?
	class Sites
	{
		public $mDb;
		public function __construct()
		{
			$this->mDb->debug = true;
		}
		
		public function get()
		{
			$sql = "SELECT * FROM ".get_table("sites")." WHERE id=1";
			 $rs = $this->mDb->getrow($sql);
			return $rs;
		}
		
		public function kf()
		{
			$sql = "SELECT kfname1,kfname2,kfname3,kfname4,kfname5,kfno1,kfno2,kfno3,kfno4,kfno5 FROM ".get_table("sites")." ";
			 $rs = $this->mDb->getrow($sql);
			return $rs;
		}
		
		public function savePost()
		{
			foreach($_POST as $key => $val)
	 		{
	 			$sql[] = $key." = '$val'";
	 		}
	 		$sql = implode(",",$sql);
	 		$sql = "UPDATE ".get_table("sites")." SET $sql WHERE id=1";
			$rs = $this->mDb->execute($sql);
			$this->building();
			return $rs;
		}
		
		protected function building()
		{
			$rs = $this->get();
			$str = "<?php \$sites=unserialize('".serialize($rs)."') ?>";
			$fp=fopen(_CAC_PATH."sys.php","wb");
			fwrite ($fp,$str);
			fclose($fp);
		}
		
		public function load()
		{
			if(!@file_exists(_CAC_PATH."sys.php"))
			{
				$this->building();
				$this->load();
			}
			else
			{
				include(_CAC_PATH."sys.php");
				return $sites;
			}
		}
	}
?>