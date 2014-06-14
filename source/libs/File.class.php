<?php

/**
 *      vince shen
 */

   class Files
   {
   	   var $savePath; 
   	   var $newName;
   	   var $ext;
   	   var $mDb;
   	   var $mUid;
   	   var $mUtype;
   	   public function __construct()
   	    {
   	    	$this->savePath = _FILE_PATH;
   	    	//echo "sdfsdfsd".$this->mUid;
   	    	//session_start();
   	    }
   	    
   	    public function upfile()
   	    {
   	    	//$_POST['folder'] = substr($_POST['folder'],1);
   	    	$tempFile = $_FILES['Filedata']['tmp_name'];
			$this->getFileName();
			$this->getExt($_FILES['Filedata']['name']);
			$this->mkpath($this->savePath.$_POST['folder']);
			move_uploaded_file($tempFile,$this->savePath.$_POST['folder'].'/'.$this->newName.".".$this->ext);
			$file = $_POST['folder'] . '/' . $this->newName.".".$this->ext;
			$filesize = filesize($this->savePath.$file);
			if (in_array($this->ext,array("jpg","gif","png","bmp")))
			{
				list($width, $height) = getimagesize($this->savePath.$file);
				$this->thumb($_POST['folder'] . '/' . $this->newName.".".$this->ext,840,2000,".thumb.jpg");
				$this->SaveToDb($file,$width,$filesize,1,$this->mUid,$this->mUtype,1);

			}else
			{
				$this->SaveToDb($file,0,$filesize,0,$this->mUid,$this->mUtype,0);

			}
			return  $file;
   	    }
   	    
   	    public function cropImage()
   	    {
   	    	$_POST["imageSource"] = str_replace(IMG_HOST,"",$_POST["imageSource"]);
   	    	$pWidth = $_POST["imageW"];
			$pHeight =  $_POST["imageH"];

			$this->getExt($_POST["imageSource"]);
			$function = $this->returnCorrectFunction();  
			$image = $function($this->savePath.$_POST["imageSource"]);
			$width = imagesx($image);    
			$height = imagesy($image);
			$mWidth = $width/$pWidth;
			$mHeight = $height/$pHeight;
			
			if($_POST["imageRotate"]){
			    $angle = 360 - $_POST["imageRotate"];
			    $image = imagerotate($image,$angle,0);
			    $pWidth = imagesx($image)/$mWidth;
			    $pHeight = imagesy($image)/$mHeight;
			}
			if($pWidth > $_POST["viewPortW"]){
			    $src_x = abs(abs($_POST["imageX"]) - abs(($_POST["imageW"] - $pWidth) / 2));
			    $dst_x = 0;
			}else{
			    $src_x = 0;
			    $dst_x = $_POST["imageX"] + (($_POST["imageW"] - $pWidth) / 2); 
			}
			if($pHeight > $_POST["viewPortH"]){
			    $src_y = abs($_POST["imageY"] - abs(($_POST["imageH"] - $pHeight) / 2));
			    $dst_y = 0;
			}else{
			    $src_y = 0;
			    $dst_y = $_POST["imageY"] + (($_POST["imageH"] - $pHeight) / 2); 
			}
			$viewport = imagecreatetruecolor($_POST["viewPortW"]*$mWidth ,$_POST["viewPortH"]*$mHeight);
			$this->setTransparency($image,$viewport); 
			imagecopy($viewport, $image, $dst_x*$mWidth, $dst_y*$mHeight, $src_x*$mWidth, $src_y*$mHeight, $pWidth*$mWidth, $pHeight*$mHeight);
			imagedestroy($image);
			$selector = imagecreatetruecolor($_POST["selectorW"]*$mWidth,$_POST["selectorH"]*$mHeight);
			$this->setTransparency($viewport,$selector,$this->ext);
			imagecopy($selector, $viewport, 0, 0, $_POST["selectorX"]*$mWidth, $_POST["selectorY"]*$mHeight,$_POST["viewPortW"]*$mWidth,$_POST["viewPortH"]*$mHeight);
			$filename = basename($_POST["imageSource"]);
			$filepath = dirname($_POST["imageSource"]);
			$file = $filepath."/".$filename.".crop.jpg";
			$this->parseImage($selector,$this->savePath.$file);
			imagedestroy($viewport);
			//Return value
			return $file;
   	    }
   	    
   	    public function thumb($imgfile,$maxwidth=139,$maxheight=139,$p)
		{
			$this->getExt($imgfile);
			$function = $this->returnCorrectFunction();  
			$image = $function($this->savePath.$imgfile);
			$width = imagesx($image);    
			$height = imagesy($image); 
			$filename = basename($imgfile);
			$filename = str_replace(".crop.jpg","",$filename);
			$filepath = dirname($imgfile);
			if($p==".thumb.jpg")
			{
				$file = $imgfile.".thumb.jpg";
			}
			else
			{
				$file = $filepath."/".$filename.".".$maxwidth."x".$maxheight.".jpg";
			}
			//header("Content-type: image/jpeg");
			if(($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight))
			{ 
				if($maxwidth && $width > $maxwidth)
				{ 
					$widthratio = $maxwidth/$width; 
					$RESIZEWIDTH=true; 
				} 
				if($maxheight && $height > $maxheight)
				{ 
					$heightratio = $maxheight/$height; 
					$RESIZEHEIGHT=true; 
				} 
				if($RESIZEWIDTH && $RESIZEHEIGHT)
				{ 
					if($widthratio < $heightratio)
					{ 
						$ratio = $widthratio; 
					}else{ 
						$ratio = $heightratio; 
					} 
				}elseif($RESIZEWIDTH)
				{ 
					$ratio = $widthratio; 
				}elseif($RESIZEHEIGHT)
				{ 
					$ratio = $heightratio; 
				} 
				$newwidth = $width * $ratio; 
				$newheight = $height * $ratio; 
				if(function_exists("imagecopyresampled"))
				{ 
					$newim = imagecreatetruecolor($newwidth, $newheight); 
					imagecopyresampled($newim, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
				}else{ 
					$newim = imagecreate($newwidth, $newheight); 
					imagecopyresized($newim, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
				} 
				ImageJpeg ($newim,$this->savePath.$file,100);
				
			}else{ 
			ImageJpeg ($image,$this->savePath.$file,100); 
			} 
		}
   	    
   	    private function getExt($name)
   	    {
   	    	$this->ext = strtolower(substr(strrchr($name,'.'),1));
   	    }
   	    
   	    private function getFileName()
   	    {
   	    	$this->newName = date('His').strtolower($this->random(16));
   	    }
   	    
   	    private function mkpath($path,$mode = 0777) 
		{
			$path = str_replace("\\","_|",$path);
			$path = str_replace("/","_|",$path);
			$path = str_replace("__","_|",$path);
			$dirs = explode("_|",$path);
			$path = $dirs[0];
			for($i = 1;$i < count($dirs);$i++) 
			{
				$path .= "/".$dirs[$i];
				if(!is_dir($path))
				{
					mkdir($path,$mode);
					@touch($path.'/index.html');
				}
			}
		}
	
		private function random($length, $numeric = 0) 
		{
		    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
		    if($numeric) {
		        $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
		    } else {
		        $hash = '';
		        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		        $max = strlen($chars) - 1;
		        for($i = 0; $i < $length; $i++) {
		            $hash .= $chars[mt_rand(0, $max)];
		        }
		    }
		    return $hash;
		}
   
		private function returnCorrectFunction(){
		    $function = "";
		    switch($this->ext){
		        case "png":
		            $function = "imagecreatefrompng"; 
		            break;
		        case "jpeg":
		            $function = "imagecreatefromjpeg"; 
		            break;
		        case "jpg":
		            $function = "imagecreatefromjpeg";  
		            break;
		        case "gif":
		            $function = "imagecreatefromgif"; 
		            break;
		    }
		    return $function;
		}
		
		private function parseImage($img,$file = null){
		    switch($this->ext){
		        case "png":
		            imagepng($img,($file != null ? $file : '')); 
		            break;
		        case "jpeg":
		            imagejpeg($img,($file ? $file : ''),100); 
		            break;
		        case "jpg":
		            imagejpeg($img,($file ? $file : ''),100);
		            break;
		        case "gif":
		            imagegif($img,($file ? $file : ''));
		            break;
		    }
		}
		
		private function setTransparency($imgSrc,$imgDest){
		   
		        if($this->ext == "png" || $this->ext == "gif"){
		            $trnprt_indx = imagecolortransparent($imgSrc);
		            // If we have a specific transparent color
		            if ($trnprt_indx >= 0) {
		                // Get the original image's transparent color's RGB values
		                $trnprt_color    = imagecolorsforindex($imgSrc, $trnprt_indx);
		                // Allocate the same color in the new image resource
		                $trnprt_indx    = imagecolorallocate($imgDest, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
		                // Completely fill the background of the new image with allocated color.
		                imagefill($imgDest, 0, 0, $trnprt_indx);
		                // Set the background color for new image to transparent
		                imagecolortransparent($imgDest, $trnprt_indx);
		            } 
		            // Always make a transparent background color for PNGs that don't have one allocated already
		            elseif ($this->ext == "png") {
		               // Turn off transparency blending (temporarily)
		               imagealphablending($imgDest, true);
		               // Create a new transparent color for image
		               $color = imagecolorallocatealpha($imgDest, 0, 0, 0, 127);
		               // Completely fill the background of the new image with allocated color.
		               imagefill($imgDest, 0, 0, $color);
		               // Restore transparency blending
		               imagesavealpha($imgDest, true);
		            }
		            
		        }
		}
		
    public function SaveToDb($file,$width,$filesize,$isimage,$uid,$utype,$thumb)
		{
			$sql = "INSERT INTO ".get_table("attachments")." (width,dateline,filename,filetype,filesize,attachment,isimage,uid,utype,thumb)
			VALUES ('$width', '".time()."', '".basename($file)."', 'pplication/octet-stream', '$filesize', '$file', '$isimage', '$uid','$utype', '$thumb')";
			$this->mDb->execute($sql);
		}
		
	/**
 		 * 
 		 * 用户上传图片
 		 * @param array $uid 用户id
 		 */
 		
 	 public function getFilebyUid($uid,$utpye,$isimage=1)
		{
			$sql = "SELECT * FROM  ".get_table("attachments")." WHERE pid=0 AND uid=$uid AND utype='$utpye' AND isimage=$isimage ORDER by id DESC";
			$pager    = new Page;
			$get_page = is_numeric($_GET["page"]) ? $get_page : 1;
	  		$pagesize = $_GET["pagesize"] ? $_GET["pagesize"] : 24;
			$pager->Page($key='', $pagesize, $groupsize=0, $current=$get_page);
			$pager->execute($this->mDb,$sql); 
			$pages['link']  = $pager->pageLinks();
			$pages['frontlink']  = $pager->searchlinks();
			$pages['fromto']  = $pager->fromto();
			$pages['total'] = $pager->getTotalpage();
			$pages['current'] = $pager->getCurrent();
			$pages['totalnum'] = $pager->getTotalnum();
			$pages['jump'] = $pager->jump();
			$pages['pagenum'] = $pagesize;
			$rs  = $pager->getResult();
			$r["logs"] = $rs;
			$r["pages"] = $pages;
			return $r;
		}
		
	public function delete($id)
		{
			$sql = "DELETE FROM ".get_table("attachments")." WHERE id=".$id;
			$this->mDb->execute($sql);
		}
		
   }
?>