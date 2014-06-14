<?php
	class Reports
	{
		public $mDb;
		
		public function getList()
	  	{
	  		$sql = " SELECT t1.*,t2.admin AS username FROM reports t1, admins t2 WHERE t1.uid =t2.id ORDER BY id DESC";
	  		$pager    = new Page;
	  		$get_page = is_numeric($_GET["page"]) ? $get_page : 1;
			$pager->Page($key='', $size=_PAGE_SIZE, $groupsize=0, $current=$get_page);
			$pager->execute($this->mDb,$sql); 
			$pages['link']  = $pager->searchlinks();
			$pages['fromto']  = $pager->fromto();
			$pages['total'] = $pager->getTotalpage();
			$pages['current'] = $pager->getCurrent();
			$pages['totalnum'] = $pager->getTotalnum();
			$pages['jump'] = $pager->jump();
			$pages['pagenum'] = $size;
			$rs  = $pager->getResult();
			$r["logs"] = $rs;
			$r["pages"] = $pages;
			return $r;
	  	}
	  	
	  	public function getRow($id)
	  	{
	  		$sql = "SELECT * FROM reports WHERE id=".$id;
	  		$rs = $this->mDb->getrow($sql);
	  		return $rs;
	  	}
	  	
	  	public function Del($id)
	  	{
	  		$sql = "DELETE FROM reports WHERE id=".$id;
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
	}
?>