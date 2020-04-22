<?
	function _flm_isvalid_mime($val = "") {
		global $_FLM;
		$result = true;
		$val = strtolower($val);
		if (trim($_FLM["MIME_ALLOW"]) != "" || trim($_FLM["MIME_DENY"]) != "") {
			if (trim($_FLM["MIME_ALLOW"]) == "") $result = !in_array($val,explode(",",strtolower($_FLM["MIME_DENY"])));
			elseif (trim($_FLM["MIME_DENY"]) == "") $result = in_array($val,explode(",",strtolower($_FLM["MIME_ALLOW"])));
			else $result = in_array($val,explode(",",strtolower($_FLM["MIME_ALLOW"]))) && !in_array($val,explode(",",strtolower($_FLM["MIME_DENY"])));
		}
		return $result;
	}

	function _flm_isvalid_ext($val = "") {
		global $_FLM;
		$result = true;
		$val = strtolower($val);
		if (trim($_FLM["EXT_ALLOW"]) != "" || trim($_FLM["EXT_DENY"]) != "") {
			if (trim($_FLM["EXT_ALLOW"]) == "") $result = !in_array($val,explode(",",strtolower($_FLM["EXT_DENY"])));
			elseif (trim($_FLM["EXT_DENY"]) == "") $result = in_array($val,explode(",",strtolower($_FLM["EXT_ALLOW"])));
			else $result = in_array($val,explode(",",strtolower($_FLM["EXT_ALLOW"]))) && !in_array($val,explode(",",strtolower($_FLM["EXT_DENY"])));
		}
		return $result;
	}

	function _flm_isvalid_file($val = "") {
		global $_FLM;
		$result = true;
		$val = strtolower($val);
		if (trim($_FLM["FILE_ALLOW"]) != "" || trim($_FLM["FILE_DENY"]) != "") {
			if (trim($_FLM["FILE_ALLOW"]) == "") $result = !in_array($val,explode("|",strtolower($_FLM["FILE_DENY"])));
			elseif (trim($_FLM["FILE_DENY"]) == "") $result = in_array($val,explode("|",strtolower($_FLM["FILE_ALLOW"])));
			else $result = in_array($val,explode("|",strtolower($_FLM["FILE_ALLOW"]))) && !in_array($val,explode("|",strtolower($_FLM["FILE_DENY"])));
		}
		return $result;
	}
	
	function _flm_pathfix($val = "") {
		global $_FLM;
		$val = trim($val);
		$val = str_replace("\\","/",$val);
		$arrval = explode("../",$val);
		$val = implode("",$arrval);
		$val = trim($val) == ".."?"":$val;
		return $val;
	}

	function _flm_isvalid_dir($val = "") {
		global $_FLM;
		$result = true;
		$val = strtolower($val);
		if (trim($_FLM["DIR_ALLOW"]) != "" || trim($_FLM["DIR_DENY"]) != "") {
			if (trim($_FLM["DIR_ALLOW"]) == "") $result = !in_array($val,explode("|",strtolower($_FLM["DIR_DENY"])));
			elseif (trim($_FLM["DIR_DENY"]) == "") $result = in_array($val,explode("|",strtolower($_FLM["DIR_ALLOW"])));
			else $result = in_array($val,explode("|",strtolower($_FLM["DIR_ALLOW"]))) && !in_array($val,explode("|",strtolower($_FLM["DIR_DENY"])));
		}
		return $result;
	}

	function _flm_post_param($name = "",$value = "") {
		global $_POST;
		if (isset($_POST[$name])) {
			if (get_magic_quotes_gpc()) {
				if (is_array($_POST[$name])) {
					$retArr = array();
					foreach ($_POST[$name] as $el) array_push($retArr,stripslashes($el));
					return $retArr;
				} else return stripslashes($_POST[$name]);
			} else
					return $_POST[$name];
		}
		else return $value;
	}

	function _flm_file_param($name = "") {
		global $_FILES;
		if (isset($_FILES[$name])) return $_FILES[$name];
		else return array();
	}

	function _flm_get_param($name = "",$value = "") {
		global $_GET;
		if (isset($_GET[$name])) {
			if (get_magic_quotes_gpc()) {
				if (is_array($_GET[$name])) {
					$retArr = array();
					foreach ($_GET[$name] as $el) array_push($retArr,stripslashes($el));
					return $retArr;
				} else return stripslashes($_GET[$name]);
			} else
					return $_GET[$name];
		}
		else return $value;
	}

	function _flm_jsformat($str = "") {
		$str = str_replace(chr(92),"\\\\",$str);
		$str = str_replace(chr(12),"\\f",$str);
		$str = str_replace(chr(8),"\\b",$str);
		$str = str_replace(chr(13)&chr(10),"\\r",$str);
		$str = str_replace(chr(9),"\\t",$str);
		$str = str_replace(chr(39),"\\'",$str);
		$str = str_replace(chr(34),"\\\"",$str);
		return $str;
	}
	
	function _flm_isdirhaschild($path) {
		$result = false;
		$path = substr($path,-1) == "/"?$path:$path."/";
		$d = @dir($path);
		if ($d)
			while (($el = $d->read()) !== false && !$result) 
				if (@is_dir($path.$el) && ($el != "." && $el != "..")) $result = true;
		@clearstatcache();
		return $result;
	}

	function _flm_invalidfname($FileName="") {
		$is_invalid = (trim($FileName)=="") || is_integer(strpos($FileName,"\\")) || is_integer(strpos($FileName,"/")) || 
									is_integer(strpos($FileName,":")) || is_integer(strpos($FileName,"*")) || is_integer(strpos($FileName,"?")) ||
									is_integer(strpos($FileName,">")) || is_integer(strpos($FileName,"<")) || is_integer(strpos($FileName,"|")) ||
									is_integer(strpos($FileName,"\"")) || is_integer(strpos($FileName,"\'"));
		return $is_invalid;
	}

	function _flm_fsize($filename) {
		$size = 0;
		if (@is_file($filename)) $size = @filesize($filename);
		clearstatcache();
		$size = _flm_fsizer($size);
		return $size;
	}
	
	function _flm_fsizer($size = 0) {
		$size1 = $size/(1024*1000*1000);
		$size2 = $size/(1024*1000);
		$size3 = ceil($size/1024);
		if ($size1>1) {
			$size = number_format($size1,2)."GB";
		} elseif ($size2>1) {
			$size = number_format($size2,2)."MB";
		} else {
			$size = number_format($size3)."KB";
		}
		return $size;
	}

	function _flm_fext($filename) {
		$finfo = pathinfo($filename);
		$ext = "";
		if (isset($finfo["extension"])) $ext = $finfo["extension"];
		return strtoupper($ext);
	}

	function _flm_truncfname($filename = "",$length = 0) {
		if ($length <= 0) return $filename;
		$arrFN = explode(".",$filename);
		if (count($arrFN) > 1) {
			$ext = array_pop($arrFN);
			$filename = implode(".",$arrFN);
			if (strlen($filename)>$length+3) 
				return substr($filename,0,$length)."...".$ext;
			else 
				return $filename.".".$ext;
		} elseif (strlen($filename)>$length+3) 
			return substr($filename,0,$length)."...";
		else 
			return $filename;
	}

	function _flm_dirtree($path,$currpath = "",$depth = 0, $result = array()) {
		global $_FLM;
		$appath = $_FLM["ROOTPATH"].$currpath;
		$d = @dir($appath);
		if ($d) {
			while (($el = $d->read()) !== false)
				if (@is_dir($appath.$el."/") && (trim($el) != "." && trim($el) != "..") && _flm_isvalid_dir($appath.$el)) {
					$curri = count($result);
					$result[$curri] = array();
					$result[$curri]["name"] = $el;
					$result[$curri]["path"] = $appath.$el;
					$result[$curri]["relativepath"] = $currpath.$el."/";
					$result[$curri]["parentpath"] = $currpath;
					$result[$curri]["haschild"] = _flm_isdirhaschild($appath.$el."/");
					$result[$curri]["depth"] = $depth;
					$result[$curri]["oppath"] = false;
					if (substr($path,0,strlen($result[$curri]["relativepath"])) == $result[$curri]["relativepath"]) {
						$result[$curri]["oppath"] = true;
						$result = _flm_dirtree($path,$result[$curri]["relativepath"],$depth + 1, $result);
					}
				}
			@$d->close();
		}
		@clearstatcache();
		return $result;
	}

	function ErrMsg($num = 0,$path = "") {
		global $_FLM;
		global $_instanceurl;
		if ($path == "")
			$lnk = "target=\"_parent\" href=\"index.php?".$_instanceurl."\"";
		else 
			$lnk = "target=\"_self\" href=\"filelist.php?PATH=".rawurlencode($path)."&".$_instanceurl."\"";
		$errmsg = array();
		$errmsg[1] = "<Table width=\"100%\" height=\"90%\"><tr><td align=\"center\" valign=\"middle\"><a ".$lnk."><font face=\"arial\" size=\"2\">".$_FLM["TITLE"]." : Error, Missing Required Input or Function is Disabled by Administrator!</font></a></td></tr></table>";
		$errmsg[2] = "<Table width=\"100%\" height=\"90%\"><tr><td align=\"center\" valign=\"middle\"><a ".$lnk."><font face=\"arial\" size=\"2\">".$_FLM["TITLE"]." : Error, Cannot find specified file!</font></a></td></tr></table>";
		if (array_key_exists($num,$errmsg)) { ?><?=$errmsg[$num]?><? }
	}
?>
