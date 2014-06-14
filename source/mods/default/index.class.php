<?php

 	class index extends Controller
 	{
 		public function defshow()
 		{
			$this->_globals();
			//unset($_SESSION["shopcart"]);
			//print_r($_SESSION);
			$this->result["sites"]["pagetitle"] = "飞刀鱼主机，全球最低价";
			$r["logs"] = $this->mBasic->getNavList("products"," status = 1",2);//读取主机产品
			foreach ($r["logs"] as $key=>$val)
			{
				$r["logs"][$key]["classname"] = $this->mBasic->getName("categorys",$val["class_id"],"ename");
			}
			$this->result["hostpro"] = $r["logs"];
		    $this->tplname = 'index';

 		}

/* /*  		public function rename()
 		{
 			$root = "/data/wwwroot/vhost/";
 			rename($root."www.caoyuexin.cn.feidaoyu.com",$root."caoyuexin.feidaoyu.com");

 		} */

/*  		public function deepScanDir($dir)
 		{
 			$fileArr = array();
 			$dirArr = array();
 			$dir = rtrim($dir, '//');
 			if(is_dir($dir)){
 				$dirHandle = opendir($dir);
 				while(false !== ($fileName = readdir($dirHandle))){
 					$subFile = $dir . DIRECTORY_SEPARATOR . $fileName;
 					if(is_file($subFile)){
 						$fileArr[] = $subFile;
 					} elseif (is_dir($subFile) && str_replace('.', '', $fileName)!=''){
 						$dirArr[] = $subFile;
 						$arr = $this->deepScanDir($subFile);
 						$dirArr = array_merge($dirArr, $arr['dir']);
 						$fileArr = array_merge($fileArr, $arr['file']);
 					}
 				}
 				closedir($dirHandle);
 			}
 			return array('dir'=>$dirArr, 'file'=>$fileArr);
 		}

 		public function pe()
 		{
 			$dir = '/data/wwwroot/vhost/';
 			$arr = $this->deepScanDir($dir);
 			print_r($arr);
 		} */

 		private function _globals()
 		{
 			$this->loadModel(array("Basic"));
 			$this->result["sites"]["home"] = 'on';
 		}
 	}
?>