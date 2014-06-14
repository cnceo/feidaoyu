<?php
 	class down extends Controller 
 	{
 		protected $tpl;
 		
 		public function defshow()
 		{
 			$this->pageinfo();
 			include(_APP_PATH."libs/adodb/adodb-pager1.inc.php");
 			$this->result["sites"]["contents"] = "active";
	 			if($this->mPur->adminCheck("PW_CONTS","1")==false)
				{
					sysMsg("非法授权页面，请与管理员联系");
				}
				
				$r = $this->mArt->getList($_GET["cateid"]);
				 
				foreach ($r["logs"] as $key=>$val)
				{
					$r["logs"][$key]["status"] = $this->result["statuslist"][$val["status"]];
					$r["logs"][$key]["lang"] = $this->result["langlist"][$val["lang"]];
					$r["logs"][$key]["classname"] = $this->mArt->getCateName($val["class_id"]);
				}
				$this->result["catelist"] = $this->mArt->cateDropList($r["logs"]["pid"]);
 				$this->result["logs"] = $r["logs"];
 				$this->result["pages"] = $r["pages"];
	 			$this->tplname = 'down';
	 			$this->mLog->adminLog("查看下载列表");
 			
 		}
 		
 		public function del()
 			{
 				if($this->mPur->adminCheck("PW_CONTS","4")==false)
			 	{
			 		die("Permission denied");
			 	}
 				if($this->mArt->Del($_POST["id"]) == false)
				 {
					$this->mLog->adminLog("删除下载失败"); 
				 	echo "error";
				 }
				 else
				 {
					$this->mLog->adminLog("删除下载成功"); 
				 	echo "succeed";
				 }
 				die();
 			}
 		
 		public function savePost()
 			{
 				//$data=$_POST ;
				$this->pageinfo();
				
			 
 				$rs = $this->mArt->savePost();
 				if($rs)
 				{
 					$this->mLog->adminLog("添加/编辑下载成功"); 
					echo "<script language=\"javascript\">alert('操作成功！');window.history.back(-2);</script>";
 				}
 				else
 				{
 					$this->mLog->adminLog("添加/编辑下载失败"); 
					echo "<script language=\"javascript\">alert('保存错误，请联系管理员！');window.history.back(-1);</script>";
 				}
				 
				/*$doc_tmp=$_FILES["file"]["tmp_name"];
			    $doc_name=$_FILES["file"]["name"];
			    $type=substr($doc_name, strrpos($doc_name, ".")+1);		    //上传文件类型
				$rand=mt_rand(0000,9999);									//生成随机码
				$new_name="a".date('YmjGi').$rand.".".$type;				//生成新文件名
				$new_path="/uploads/down/".$new_name;	                    //上传目录 
				$infos=$this->mArt->getRow($_POST["id"]);
				$old_path=$infos["picpath"];
				if($type!=""){
				   $path=$new_path;    
						}
				else {
				   $path=$old_path;
				}
				$down=move_uploaded_file($doc_tmp,$new_path);  
				
 				if(!$_POST["id"])
				{
					$sql = "INSERT INTO ".get_table("articles")."(id,title,uid,class_id,picpath,status,lang,addtime) VALUES ('', '".$_POST['title']."', '".$_POST['uid']."', '".$_POST['class_id']."', '".$path."', '".$_POST['status']."', 'cn', '".time()."')";
					
				}
				else
				{
					$sql = "UPDATE ".get_table("articles")." SET  `title` = '".$_POST['title']."',`class_id` = '".$_POST['class_id']."',`uid` = '".$_POST['uid']."',`picpath` = '".$path."',`status` = '".$_POST['status']."' WHERE id=".$_POST["id"];
				}
				$rs = $this->mDb->execute($sql);
 				*/
 				 
 			}
 		public function batch()
 			{
 				$this->pageinfo();
 				$rs = $this->mArt->Batch();
		 		$this->mLog->adminLog("批量移动/删除下载内容");
 				/*if($rs)
 				{
 					$msg["status"] = "true";
 				}
 				else
 				{
 					$msg["false"] = "true";
 					$msg["message"] = "保存错误，请联系管理员";
 					
 				}
 				echo json_encode($msg);*/
 				die();
 			}
 			
 		public function add()
 		{
			if($this->mPur->adminCheck("PW_CONTS","2")==false)
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			if($this->mPur->adminCheck("PW_CONTS","3")==false && $_GET["id"])
			{
				sysMsg("非法授权页面，请与管理员联系");
			}
			$this->pageinfo();
			if($_GET["id"])
			{
			    $this->result["log"] = $this->mArt->getRow($_GET["id"]);
			}
			{
				$this->result["log"]["is_alone_sale"] = 1;
			}
			 
			$this->result["catelist"] = $this->mArt->cateDropList($this->result["log"]["class_id"],6);
			$this->result["cglist"] = $this->mClient->getGroupDropList("t");
			$this->tplname = 'down_add';
 		}

 		private function pageinfo()
 		{
 			$this->checkLogin();
 			$this->result["statuslist"] = $this->mArt->getStatusList();
 			$this->result["langlist"] = $this->mArt->getlangList();
 			$this->result["sites"]["arts"] = "selected";
 			$this->result["sites"]["title"] = "下载管理";
 			$this->result["sites"]["url"] = encrypt("downcate")."";
 		}
 	}
?>