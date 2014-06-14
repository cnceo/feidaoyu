<?php

	class Groups
	{
		public $mDb;
	
		public function __construct()
		{
			//$this->mDb->debug = true;
		}
	
		public function cateList($table,$type=null)
		{
			$sql = "SELECT * FROM $table ";
			$rs = $this->mDb->getall($sql);
			if(!empty($type))
			{
				$cate = array();
				foreach ($rs as $val)
					{
						$cate[$val["id"]] = $val["catename"];
					}
				$rs = $cate;
			}
			return $rs;
		}
		
		public function getName($table,$id)
		{
			$sql = "SELECT catename FROM $table WHERE id=".$id;
			$rs = $this->mDb->getone($sql);
			return $rs;
		}
		
		public function getMax($table)
		{
			$sql = "SELECT max(id) FROM $table";
			$id = $this->mDb->getone($sql);
			return $id;
		}
		
		public function savePost($table)
		{
			if ($_POST["id"])
			 {
				 $sql = "UPDATE $table SET catename='".$_POST["catename"]."' WHERE id=".$_POST["id"];
			 }
			 else
			 {
				 $sql = "INSERT INTO $table (id,catename) VALUES(null,'".$_POST["catename"]."')";
			 }
			  $rs = $this->mDb->execute($sql);
			 if(!$rs)
			 {
				 return  "error";
			 }
			 else
			 {
				 return "succeed";
			 }
		}
	
		public function Del($table,$id)
		{
			$rs = $this->mDb->execute("DELETE FROM $table WHERE id=".$id);
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
			$sql = "SELECT * FROM $table WHERE id=".$id;
			$rs = $this->mDb->getrow($sql);
			return $rs;
		}
	
	}

?>