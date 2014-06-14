<?php
 	class index extends Controller
 	{
 		public function defshow()
 		{
 			$this->_globals();
 			$this->result["log"] = $this->mArticle->getCateRowByName($_GET["cate"]);
/* 			if (@include _APP_PATH."mods/customs/".$_GET["cate"].".php")
			{}
			else
			{
	 			$this->result["log"] = $this->mArticle->getCateRowByName($_GET["cate"]);
				if(!$this->result["log"])
				{
					$this->loadEorr();
				}
				else
				{
					$this->result["logs_left"] = $this->mCategory->getCateList($this->result["log"]["pid"]);
					if ($this->result["log"]["vtype"]=="1")
					{
						$this->result["log"] = $this->mArticle->getRowBycate($this->result["log"]["id"],$_GET["lang"]);
						//print_r($this->result["log"]);
						//$this->result["logs_left1"] = $this->mArticle->getNavList($this->result["log"]["classid"],10,$_GET["lang"]," ASC ");
						$this->tplname = "customs/".$this->result["log"]["tid"];
						if($_GET["lang"]=="cn")
						{

							$this->result["sites"]["pagetitle"] = $this->result["log"]["title"]." -- ".$this->result["sites"]["sitename"];
						}
						else
						{
							$this->result["sites"]["pagetitle"] = $this->result["log"]["title"]." -- ".$this->result["sites"]["siteename"];
						}
					}
					else
					{
						include(_APP_PATH."libs/adodb/adodb-pager2.inc.php");
						$r = $this->mArticle->getList($this->result["log"]["id"],0,$_GET["lang"]);
						$this->result["logs"] =  $r["logs"];
						foreach($this->result["logs"] as $key => $val)
						{
							$volume[$key]['sequence'] = $val['sequence'];
							$volume[$key]['addtime'] = $val['addtime'];
							//$volume[$key] = $val['sequence'];
						}
						array_multisort($volume, SORT_DESC, $this->result["logs"]);
						$this->result["pages"] =  $r["pages"];
						if($_GET["lang"]=="cn")
						{
							$this->tplname = "customs/".$this->result["log"]["tid"];
							$this->result["sites"]["pagetitle"] = $this->result["log"]["catename"]." -- ".$this->result["sites"]["sitename"];
							$this->result["sites"]["description"] =$this->result["log"]["description"]." ".$this->result["sites"]["description"];
							$this->result["sites"]["keywords"] = $this->result["log"]["keywords"]." ".$this->result["sites"]["keywords"];
						}
						else
						{
								$this->tplname = "customs/".$this->result["log"]["etid"];
								$this->result["sites"]["pagetitle"] = $this->result["log"]["ename"]." -- ".$this->result["sites"]["siteename"];
								$this->result["sites"]["description"] =$this->result["log"]["edescription"]." ".$this->result["sites"]["description"];
								$this->result["sites"]["keywords"] = $this->result["log"]["ekeywords"]." ".$this->result["sites"]["keywords"];
						}
					}
			    }
			    $this->result["logs_right"] = $this->mArticle->getNavList(4,30,$_GET["lang"]);
			    $this->result["sites"]["current"] = $_GET["cate"];
			    $this->result["prodcate"] = $this->mCategory->cateTwoListPrent($this->result["log"]["pid"]);
			    $get_id = $this->result["log"]["classid"];
			    if($this->result["log"]["pid"]!="0")
			    {
				    $cur = $this->mCategory->getPukey($this->result["log"]["pid"]);
			    	$this->result["sites"][$cur] = "on";
			    	$this->result["sites"]["parent"] = $this->mCategory->getUnikey($this->result["log"]["pid"]);
				    $this->result["log"]["parent"] = $this->mCategory->getName($this->result["log"]["pid"]);
				    $get_id = $this->result["log"]["pid"];
			    }else
			    {
			    	$this->result["sites"][$_GET["cate"]] = "on";
			    }

				//$t["logs"] = $this->mArticle->getNavList($get_id,10,$_GET["lang"]);
				//print_r($t["logs"]);
				$t["logs"] = $this->mArticle->getNavList($get_id,10,$_GET["lang"]);
				$cate = $this->mCategory->getPidList($get_id);
				foreach ($cate as $key => $val)
				{
					$str = null;
					$childs = $this->mArticle->getNavList($val["id"],10,$_GET["lang"],"DESC","sequence");
					foreach ($childs as $vul)
					{
						$str .= "<li ";
						if ($_GET["cate"]==$vul["unikey"])
						{
							$str .= " class=\"nav_on\" ";
						}
						$str .= " ><a href=\""._URL_."/".$_GET["lang"]."/".$vul["unikey"]."/".$vul["addtime"].".html\" class=\"link14\">".$vul["title"]."</a></li>";
					}
					$cate[$key]["childs"] = $str;
				}
				$t["logs"] = array_merge($cate,$t["logs"]);
				$this->result["logs_left1"] = $t["logs"];
				unset($volume);
				foreach($this->result["logs_left1"] as $key => $val)
				{
					$this->result["logs_left1"][$key]["utype"] = $this->tpl->mType[$this->result["logs_left1"][$key]["ttype"]];
					$volume[$key] = $val['sequence'];
				}
				array_multisort($volume, SORT_DESC, $this->result["logs_left1"]);

			}*/
			 $this->result["sites"][$_GET["cate"]] = 'current';
 			 $this->result["sites"]["pagetitle"] = "关于我们--".$this->result["sites"]["sitename"];
 			 echo $this->result["log"]["tplname"];
 			 $this->tplname = $this->result["log"]["tplname"];
 		}

		private function _globals()
 		{
 			$this->loadModel(array("Basic","User","Article","Category"));
 		}
 	}
?>