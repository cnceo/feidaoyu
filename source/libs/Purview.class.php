<?php

 class Purviews
 {
 	public $mDb;
 	
 	public function __construct()
	{
		//$this->mDb->debug = true;
	}
 	
 	public function adminCheck($section,$action)
 	{
 		if($_SESSION["login_admin"]["groupid"] != "0")
 		{
 			$sql = "SELECT actions FROM ".get_table("purviews")." WHERE utype='group' AND uid='".$_SESSION["login_admin"]["groupid"]."' AND section='$section'";
 		}
 		else
 		{
 			$sql = "SELECT actions FROM ".get_table("purviews")." WHERE utype='custom' AND uid='".$_SESSION["login_admin"]["id"]."' AND section='$section'";
 		}
 		$actions = $this->mDb->getone($sql);
 		if($actions)
 		{
 			 $actions = explode(",",$actions);
 			 if(in_array($action,$actions)==true)
 			 {
 			 	return true;
 			 }
 			 else 
 			 {
 			 	//return true; //关闭权限
 			 	return false;
 			 }
 		}
 		else
 		{
 			//return true;//关闭权限
 			return false;
 		}
 	}
 	
 	public function update($type,$id)
 	{
 		$this->delete($type,$id);
 		/*
 		while ($vul = current($_POST)) 
 		{
 			if (key($_POST) != "uid" && key($_POST) != "utype") 
 			{
 				$section = key($_POST);
 				if (is_array($vul))
	 			{
	 				$actions = implode(",",$vul);
	 			}
	 			else
	 			{
	 				$actions = $vul;
	 			}
	 			$sql = "INSERT INTO ".get_table("purviews")."(uid,utype,section,actions)VALUES('".$this->mUid."','".$this->mType."','$section','$actions')";
	 			$this->mDb->execute($sql);
 			}
 			next($_POST);
 		}
 		*/
 		foreach($_POST["rules"] as $key => $val)
 		{
 			if (is_array($val))
 			{
 				$actions = implode(",",$val);
 			}
 			else
 			{
 				$actions = $val;
 			}
 			$sql = "INSERT INTO ".get_table("purviews")."(uid,utype,section,actions)VALUES('".$id."','".$type."','$key','$actions')";
 			$this->mDb->execute($sql);
 		}
 	}
 	
 	public function edit($type,$id)
 	{
 		$sql = "SELECT * FROM ".get_table("purviews")." WHERE utype='$type' AND uid=".$id;
 		$rs = $this->mDb->getall($sql);
 		$r = array();
 		foreach($rs as $key => $val)
 		{
 			 if(stristr($val["actions"], ",") === false)
 			 {
 			 	$r[$val["section"]] = $val["actions"];
 			 }
 			 else
 			 {
 			 	$r[$val["section"]] = explode(",",$val["actions"]);
 			 }
 		}
 		return $r;
 	}
 	
 	public function delete($type,$id)
 	{
 		$sql = "DELETE FROM ".get_table("purviews")." WHERE utype='$type' AND uid=".$id;
 		$this->mDb->execute($sql);
 	}
 	
 }

?>