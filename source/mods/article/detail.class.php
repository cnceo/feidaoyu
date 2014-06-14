<?php
 	class detail extends Controller
 	{
 		public function defshow()
 		{
 			$this->_globals();
			//查询成功案例
 			//echo $_GET["id"];
 			$this->result["log"]= $this->mBasic->getRow("articles",$_GET["id"]);
 			if(!$this->result["log"] or $this->result["log"]['status']==0)$this->loadEorr();
			//下一个
 			$this->result["log1"]= $this->mDb->getrow("SELECT *  FROM ".get_table("articles")." WHERE id > ".$_GET["id"]." AND class_id = '46'");
 			//上一个
 			$this->result["log2"]= $this->mDb->getrow("SELECT *  FROM ".get_table("articles")." WHERE id < ".$_GET["id"]." AND class_id = '46'");
 			$this->result["sites"]["pagetitle"] = $this->result["log"]["title"];
            $this->result["aboutlogs"] = $this->mBasic->getNavList("articles"," class_id = '46' AND id != '".$_GET["id"]."'",3);
            //读取行业新闻
		     $this->result["news"] = $this->mArticle->getNavList(54,6);
		      //读取广告
		     $this->result["teacher"] =$this->mAd->getAd("teacher");      
   		    $this->tplname = 'artile_detail';
 		}


 		private function _globals()
 		{
 			$this->loadModel(array("Basic","Article","Ad"));
 			$this->result["sites"]["cases"] = 'ca_current';
 		}
 	}
?>