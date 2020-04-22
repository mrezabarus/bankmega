<?

	function str_trunc($str,$len) {
		if ($len<=3) return $str;
		if (strlen($str)>$len-3) {
			return @substr($str,0,$len-3)."...";
		} else return $str;
	}
	
	function DirHasChild($path) {
		$_haschild = false;
		$handler = @dir($path);
		if ($handler) {
			while (false !== ($entry = $handler->read())) {
				$ppath = strcmp(substr($path,strlen($path)-1,1),"/")==0?$path.$entry:$path."/".$entry;
				if (@is_dir($ppath) && !(strcmp(trim($entry),".")==0 || strcmp(trim($entry),"..")==0)) {
					$_haschild = true;
					break;
				}
			}
			$handler->close();
			clearstatcache();
		}
		return $_haschild;
	}

	function IsInPath($currpath,$path) {
		$currpathlen = strlen($currpath);
		$pathlen = strlen($path);
		if ($currpathlen>$pathlen)
			return false;
		else 
			return (strcmp(substr($path,0,$currpathlen),$currpath) == 0);
	}
	
	function FileSizeKB($filename) {
		$size = 0;
		if (@is_file($filename)) $size = @filesize($filename);
		clearstatcache();
		$size = ceil($size/1024);
		return $size;
	}

	function FileLastModified($filename) {
		$lm = "N/A";
		if (@is_file($filename)) {
			$lmtime = @filemtime($filename);
			$lm = date("m/d/Y h:i A",$lmtime);
		}
		clearstatcache();
		return $lm;
	}
	
	function upperpath($path) {
		$arr_path = explode("/",$path);
		$result = "";
		for ($i=0;$i<(count($arr_path)-2);$i++) 
			if ($arr_path[$i]!="") $result .= $arr_path[$i]."/";
		return $result;
	}

	function TruncateFilename($filename,$len) {
		$newfilename = $filename;
		$arrfname = split("[.]",$filename);
		if ($arrfname!=false) {
			if (count($arrfname)>1) {
				$newfilename = "";
				for ($i=0;$i<count($arrfname)-1;$i++) $newfilename .= $arrfname[$i];
				if (strlen($newfilename)>$len) {
					$newfilename = substr($newfilename,0,$len)."..";
				}
				$newfilename .= ".".$arrfname[count($arrfname)-1];
			} else if (strlen($arrfname[0])>$len) {
				$newfilename = substr($arrfname[0],0,$len)."...";
			}
		} else if (strlen($newfilename)>$len) $newfilename = substr($filename,0,$len)."...";
		return $newfilename;
	}
?>