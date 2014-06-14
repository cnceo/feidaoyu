<?
 /**
 * file manage class
 * @package magnify360
 * @author vince<vincent@gmail.com>
 * @create time May 9,2008
 * @last modify May 21,2008
 * @version 1.0
 */
  class files
  {

  	var $rootPath;
  	var $defaultPath;
  	var $tmpPath;
  	
  	function files()
  	{
  		global $rootPath,$defaultFileStore,$uploadDir;
  		$this->rootPath = $rootPath;
  		$this->defaultPath = $defaultFileStore;
  		$this->tmpPath = $uploadDir;
  	}


  	
  	function getFile($fileid)
	{
		if($fileinfo = $this->getFileInfo($this->rootPath.$fileid))
		{
			//print_r($fileinfo);
			//die();
			header("Pragma: public"); 
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false); 
			header("Content-type: ".$fileinfo["filemime"]);
			header("Content-Transfer-Encoding: Binary");
			header("Content-length: ".filesize($this->rootPath.$fileid));
			header("Content-disposition: attachment; filename=\"".$fileinfo["basename"]."\"");
			readfile($this->rootPath.$fileid);
		}else{
			$this->error ('access denied');
		}
	}

	function getDeflate($fileid)
		{
		if(file_exists($this->rootPath.$fileid))
		{
			$this->thumb($fileid);
		}else{
			$this->error ('access denied');
		}
	}


	function getFilePackage($fileids,$returnContent = false)
	{
		$fileids = explode(",",$fileids);
		include_once("createZip.inc.php");
		$createZip = new createZip;
		$fileCount = 0;
		foreach($fileids as $fileid)
			{
				if(file_exists($this->rootPath.$fileid))
					{
						$createZip -> addFile(file_get_contents($this->rootPath.$fileid) , basename($fileid));
						$fileCount++;
					}
			}
		
		if($fileCount > 0){
			if($returnContent != true){
				header("Content-Type: application/zip");
				header("Content-Transfer-Encoding: Binary");
				#header("Content-length: ".strlen($zipped));
				header("Content-disposition: attachment; filename=\"package.zip\"");
				echo $createZip -> getZippedfile();
			}else{
				return $createZip->getZippedfile();
			}
		}else{
			$this->error('no files zipped');
		}

	}

  	function getFolder($path)
  	{

  		if ($path =='' || $path =='/')
  		{
  			$str = "{\"bindings\": [ { \"displayname\":\"根目录\",\"scheme\":\"admin\",\"type\": \"directory\", \"name\": \"filestore\", \"path\": \"".$this->defaultPath."\",\"virtual\":\"true\" } ]}";
  		}
  		else
  		{
  			if ($handle = opendir($this->rootPath.$path)) 
				{
					$files = $folder = array();
					while (false !== ($file = readdir($handle))) 
					{
						if ($file!="." && $file!=".." &&$file!="template_c")
						{
							if(is_dir($this->rootPath.$path."/".$file))
							{
								$files[] ="{ \"type\": \"directory\", \"name\": \"$file\", \"path\": \"$path/$file\" }";
							}
							else
							{
								$fileinfo = $this->getFileInfo($this->rootPath.$path."/".$file);
								$files[] ="{ \"type\": \"file\", \"name\": \"$file\",\"date\":\"".$fileinfo["filemtime"]."\", \"id\": \"$path/$file\",\"flags\": \"normal\" }";
							}
						}
					}
					sort($files);
					$str = "{\"bindings\": [".implode(",",$files)."]}";
					closedir($handle);
				}
  		}
			echo $str;
  	}
  	
  	
  	function getMeta($path)
  	{
  		$fileinfo = $this->getFileInfo($this->rootPath.$path);
  		if (in_array(strtolower($fileinfo["extension"]), array("jpg", "jpeg", "gif", "png","bmp"))) 
  		{
  			$image = 1;
  		}
  		else
  		{
  			$image = 0;
  		}
		echo "{\"bindings\": [ { \"edit\": \"true\" },{ \"filename\": \"".$fileinfo["basename"]."\",\"path\": \"".$fileinfo["filepath"]."\",\"image\":$image,\"type\": \"".$fileinfo["filemime"]."\", \"date\": \"".$fileinfo["filemtime"]."\", \"downloads\": \"0\", \"description\": \"\", \"flags\": \"normal\", \"type\": \"".$fileinfo["filemime"]."\", \"size\": \"".$fileinfo["filesize"]."\" } ]}";	
  	}
  	
  	function getFolderMeta($path)
  	{
  		ob_start();
	  	$size =system("du -sh ".$this->rootPath.$path." | awk '{print $1}'", $retval);
	  	ob_end_clean();
  		echo "{\"bindings\": [ { \"name\": \"".basename($path)."\", \"size\": \"$size\" } ]}";
  	}
  	
  	
  	function getFileInfo($file)
  	{
  		if (file_exists($file))
  		{	
	  		$fileinfo = pathinfo($file);
	  		$fileinfo["filesize"] = $this->getSize($file);
	  		$fileinfo["filemtime"] = date('M d,Y h:i:s',filemtime($file)); 
	  		$fileinfo["filepath"] = str_replace($this->rootPath,'',$fileinfo["dirname"]);
	  		//ob_start();
	  		//$fileinfo["filemime"] = system ( trim( 'file -bi ' . escapeshellarg ( $file ) ) , $retval);;
	  		//ob_end_clean();
			$fileinfo["filemime"] = exec ( trim( 'file -bi ' . escapeshellarg ( $file ) ) , $retval);
	  		return $fileinfo;
  		}
  	}
  	
  	function setMeta($fileid,$filename)
  	{
  		$newname = dirname($this->rootPath.$fileid)."/".$filename;
  		$this->fileRename($this->rootPath.$fileid,$newname);
  	}

	function uploadAuth($path,$files)
	{
        if(is_dir($this->rootPath."/".$path))
			{
				if(!empty($files))
				{
					$files = explode("|",$files);
					foreach ($files as $file)
					{
						if (file_exists($this->rootPath."/".$path."/".$file))
						{
							echo "{\"bindings\": [{ \"auth\":\"false\",\"error\":\"This folder aleady contains a file named '".$file."'.\\n\\r would you like to replace the existing file?\" }]}";
							exit;
						}
					}
				}
				
				if(file_exists($this->tmpPath."/stats_".session_id().".txt"))
					unlink($this->tmpPath."/stats_".session_id().".txt");
				if(file_exists($this->tmpPath."/temp_".session_id()))
					unlink($this->tmpPath."/temp_".session_id());
				$_SESSION['uploadPath'] = $this->rootPath.$path;
				echo "{\"bindings\": [ { \"auth\":\"true\",\"sessionid\":\"".session_id()."\" } ]}";
			}
			else
			{
				echo "{\"bindings\": [{ \"auth\":\"false\",\"error\":\"bad directory\" }]}";
				exit;
			}
	}


	function uploadSmart()
	{
		if(!file_exists($this->tmpPath."/stats_".session_id().".txt"))
		{
				/*
				 $fp=fopen($this->tmpPath."/logs","a+");
			     fwrite ($fp,$this->tmpPath."/stats_".session_id().".txt\r\n");
			     fclose;
				 */
			echo "{\"bindings\": [{ \"percent\": 0, \"percentSec\": 0, \"speed\": \"0\", \"secondsLeft\": \"0\", \"done\": \"false\"}]}";
			exit;
		}
		$lines = file($this->tmpPath."/stats_".session_id().".txt");
		$percent = round(($lines[0]/100),3);
		$percentSec	= round($lines[1]/100,4);
		$speed = $this->filesize_format($lines[2]).'s';
		$secondsLeft = $this->secs_to_string(round($lines[3]));
		$size = $this->filesize_format($lines[4]).'s';
		
		if($percent == 1){
			// cleanup time
			if(isset($_SESSION['uploadPath']))
			{
				$path = $_SESSION['uploadPath'];
				$sessionid = session_id();
				$dh = opendir($this->tmpPath);
			    while (($file = readdir($dh)) !== false) {
	
			    	$sessionlen = strlen(session_id());
			    	if(substr($file,0,$sessionlen)==session_id()){
			    		$filename = substr($file,$sessionlen+1);
						$uploadfile=$filename;
						$i=1;
						while(file_exists($path.'/'.$uploadfile)){
						  $uploadfile = $i . '_' . $filename;
						  $i++;
				        }
	
						if(file_exists($this->tmpPath."/".$file) && !rename($this->tmpPath."/".$file,"$path/$uploadfile")){
							echo "Error";
						}
					}
					
			    }closedir($dh);
	/*
			if(file_exists($this->tmpPath."/stats_".session_id().".txt"))
			    	unlink($this->tmpPath."/stats_".session_id().".txt");
			    if(file_exists($this->tmpPath."/temp_".session_id()))
			    	unlink($this->tmpPath."/temp_".session_id());
	*/
			}
			$this->SyncFolder();
			$done = "true";
		}else{
			$done = "false";
		}
		echo "{\"bindings\": [ { \"percent\": $percent, \"size\": \"$size\",\"percentSec\": $percentSec, \"speed\": \"$speed\", \"secondsLeft\": \"$secondsLeft\", \"done\": \"$done\"} ]}";
	}
	
	
	function newFolder($name,$path)
	{
		if(!file_exists($this->rootPath.$path."/".$name))
		{
			/*
			exec("mkdir ".$this->rootPath.$path."/".$name , $status);
			echo "mkdir ".$this->rootPath.$path."/".$name;
			print_r($status);
			*/
			if(mkdir($this->rootPath.$path."/".$name))
			{
				$this->SyncFolder();
				echo "ok";
			}
			else
			{
				$this->error("oops somethings wrong");
			}
		}
		else
		{
			$this->error("new folder name already exists");
		}
	}
	
	function folderRename($path,$name,$newname)
	{
		  if(!file_exists($this->rootPath.$path."/".$newname))
		{
			if(rename($this->rootPath.$path."/".$name,$this->rootPath.$path."/".$newname))
			{
				$this->SyncFolder();
				echo "done";
			}else
			{
				 echo "error";
			}
		}else
		{
			$this->error("old name doesnt exist or new name already exists");
		}
	}
	
	
	function folderMove($name,$path,$newpath)
	{
		if(file_exists($this->rootPath.$newpath."/".$name))
		{
			$this->error('old name doesnt exist or new name already exists');
		}
		system('mv '.$this->rootPath.$path."/".$name."  ".$this->rootPath.$newpath, $retval);
		if (!$retval)
		{
			$this->SyncFolder();
			echo "done";
		}
		else
		{
			echo "move denied";
		}
	}
	
	
	function fileMove($fileid,$path)
	{
		if(file_exists($this->rootPath.$path."/".basename($fileid)))
		{
			$this->error('file move denied, the file doesnt exist');
		}
		system('mv '.$this->rootPath.$fileid."  ".$this->rootPath.$path, $retval);
		if (!$retval)
		{
			$this->SyncFolder();
			echo "done";
		}
		else
		{
			echo "file move denied";
		}
	}

/*
	function folderDelete($folder)
	{
		
		$dh=opendir($this->rootPath.$folder);
		while ($file=readdir($dh)) 
			{
				if($file!="." && $file!="..") 
					{
						$fullpath = $this->rootPath.$folder."/".$file;
						if(!is_dir($fullpath)) 
							{
								unlink($fullpath);
							} 
							else 
							{
								deldir($fullpath);
							}
					}
			}
			
		closedir($dh);
		if(rmdir($this->rootPath.$folder)) 
			{
				echo "ok";
			}
			else
			{
				echo "oops somethings wrong";
			}
	}

	*/
	function folderDelete($folder)
	{
		
		system('rm -rf '.$this->rootPath.$folder, $retval);
		if (!$retval)
			{
				$this->SyncFolder();
				echo "ok";
			}
			else
			{
				echo "oops somethings wrong";
			}
	}

	function fileDelete($fileid)
	{
		if (unlink($this->rootPath.$fileid))
		{
			$this->SyncFolder();
			echo "done";
		}
		else
		{
			$this->error('file access denied');
		}
	}
	
	function fileRename($oldname,$newname)
	{
		  if(!file_exists($newname))
		{
			if(rename($oldname,$newname))
			{
				$this->SyncFolder();
				echo "done";
			}else
			{
				 echo "error";
			}
		}else
		{
			$this->error("old name doesnt exist or new name already exists");
		}
	}
  	
  	function getSize($file) 
  	{
		$bytes = array('B','KB','MB','GB','TB');
		$size = filesize($file);
		foreach($bytes as $val) 
		{
			if($size > 1024)
			{
		    	$size = $size / 1024;
			}
			else
			{
				break;
			}
		}
		return round($size, 2)." ".$val;
	}
	
	function error($message)
	{
		echo "{\"bindings\": [ {'error': \"$message\"} ]}";
		exit;
	}

	function filesize_format($size)
	{
		if( is_null($size) || $size === FALSE || $size == 0 )
		return $size;
		if( $size > 1024*1024*1024 )
			$size = sprintf( "%.1f GB", $size / (1024*1024*1024) );
		elseif( $size > 1024*1024 )
		    $size = sprintf( "%.1f MB", $size / (1024*1024) );
		elseif( $size > 1024 )
			$size = sprintf( "%.1f kB", $size / 1024 );
		elseif( $size < 0 )
			$size = '&nbsp;';
		else
			$size = sprintf( "%d B", $size );

  		return $size;
	}


	function secs_to_string ($secs, $long=false)
	{
		$initsecs = $secs;
	  // reset hours, mins, and secs we'll be using
		$hours = 0;
		$mins = 0;
		$secs = intval ($secs);
		$t = array(); // hold all 3 time periods to return as string
	  
	  // take care of mins and left-over secs
		if ($secs >= 60) 
		{
			$mins += (int) floor ($secs / 60);
			$secs = (int) $secs % 60;
		    
		// now handle hours and left-over mins    
			if ($mins >= 60) 
			{
				$hours += (int) floor ($mins / 60);
				$mins = $mins % 60;
			}
			// we're done! now save time periods into our array
			$t['hours'] = (intval($hours) < 10) ? "" . $hours : $hours;
			$t['mins'] = (intval($mins) < 10) ? "" . $mins : $mins;
		}
		
		// what's the final amount of secs?
		$t['secs'] = (intval ($secs) < 10) ? "" . $secs : $secs;
		
		// decide how we should name hours, mins, sec
		$str_hours = ($long) ? "hour" : "hour";
		$str_mins = ($long) ? "minute" : "min";
		$str_secs = ($long) ? "second" : "sec";
		
		// build the pretty time string in an ugly way
		$time_string = "";
		
		$time_string .= ($t['hours'] > 0) ? $t['hours'] . " $str_hours" . ((intval($t['hours']) == 1) ? " " : "s ") : "";
		$time_string .= ($t['mins']) ? $t['mins'] . " $str_mins" . ((intval($t['mins']) == 1) ? " " : "s ") : "";
		
		if($initsecs < 120)
		{
			$time_string .= ($t['secs']) ? $t['secs'] . " $str_secs" . ((intval($t['secs']) == 1) ? "" : "s ") : " ";
		}else{
			if($secs > 30)
			{
				$pre = ">";
			}
			else
			{
				$pre = "about";
			}
			$time_string = "$pre $time_string";
		}

		return empty($time_string) ? 0 : $time_string;
	}
	
	function SyncFolder() 
	{
		/*
		$sync = new SyncFiles($_SESSION["relay_client_id"]);
		$sync->module = 'client_files';
		$sync->CheckAllTargets();
		$sync->SyncAllModules();
		*/
	}
	

	function thumb($fileid,$maxwidth=450,$maxheight=320,$out=0)
	{
		$newfile = _IMG_PATH.$fileid;
		if($fileinfo = $this->getFileInfo($newfile))
		{
			header("Pragma: public"); 
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false); 
			header("Content-type: ".$fileinfo["filemime"]);
			header("Content-Transfer-Encoding: Binary");
			header("Content-length: ".filesize($newfile));
			header("Content-disposition: attachment; filename=\"".$fileinfo["basename"]."\"");
			readfile($newfile);
		}
		else
		{
			$data = getimagesize($this->rootPath.$fileid);
			$path = dirname($newfile);
			if(!is_dir($path))
		        {  
					$dirs = explode("/",$path);
					$path = $dirs[0];
					print_r($path);
					for($i = 1;$i < count($dirs);$i++) 
					{
						$path .= "/".$dirs[$i];
						if(!is_dir($path))
						mkdir($path,0777);
					}	
				}
				switch ($data[2]) 
				{
					case 1:
						$im = @ImageCreateFromGIF($this->rootPath.$fileid);
						break;
					case 2:
						$im = @imagecreatefromjpeg($this->rootPath.$fileid);
						break;
					case 3:
						$im = @ImageCreateFromPNG($this->rootPath.$fileid);
						break;
				}
			$width = imagesx($im); 
			$height = imagesy($im); 
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
					imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
				}else{ 
					$newim = imagecreate($newwidth, $newheight); 
					imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
				} 
				ImageJpeg ($newim,$newfile);
				if($out==0) 
				{
					ImageJpeg ($newim);
				}
			}else{ 
			ImageJpeg ($im,$newfile); 
			} 
		}
	}
  }
?>
