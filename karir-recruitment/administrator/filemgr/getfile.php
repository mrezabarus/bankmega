<?
	require ("_config.php");
	$filename = _flm_get_param("filename","");
	$pinfo = pathinfo($filename);
	if ($pinfo["dirname"] == ".") $pinfo["dirname"] = "";
	if ($filename == "" || !$_FLM["IS_DOWNLOAD"]) {
		$path = _flm_post_param("PATH",$pinfo["dirname"]);
		ErrMsg(1,$path);
		die();
	}
	
	$path = _flm_pathfix($pinfo["dirname"]);

	if (!_flm_isvalid_dir($_FLM["ROOTPATH"].$path)) {
		ErrMsg(1);
		die();
	}

	$invalid_filename = (count(explode("../",$filename))>1) || (count(explode("..\\",$filename))>1);

	if (ereg("MSIE ([0-9].[0-9]{1,2})", $_SERVER["HTTP_USER_AGENT"], $log_version)) $Browser="IE";
	else if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $_SERVER["HTTP_USER_AGENT"], $log_version)) $Browser="OPERA";
	else if (ereg('Mozilla/([0-9].[0-9]{1,2})', $_SERVER["HTTP_USER_AGENT"], $log_version)) $Browser="MOZILLA";
	else if (ereg('Konqueror/([0-9].[0-9]{1,2})', $_SERVER["HTTP_USER_AGENT"], $log_version)) $Browser="KONQUEROR";
	else $Browser="OTHER";

	if (!$invalid_filename && @file_exists($_FLM["ROOTPATH"].$filename)) {
  	$mime_type = ($Browser == "OPERA" || ($Browser == "IE" && $log_version[1] < 6)) ? "application/octetstream" : "application/octet-stream";
    if ($Browser == "IE") {
			header("Content-type: $mime_type");
			if ($log_version[1] < 6) 
			header('Content-Disposition: attachment; filename="'.rawurlencode(basename($_FLM["ROOTPATH"].$filename)).'"');
			else
			header('Content-Disposition: inline; filename="'.rawurlencode(basename($_FLM["ROOTPATH"].$filename)).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
    } else {
			header("Content-type: $mime_type");
			header('Content-Disposition: attachment; filename="'.rawurlencode(basename($_FLM["ROOTPATH"].$filename)).'"');
			header('Expires: 0');
			header('Pragma: no-cache');
    }
		@readfile ($_FLM["ROOTPATH"].$filename);
		@clearstatcache();
	} else {
?>
<Table width="100%" height="90%">
	<tr>
		<td align="center" valign="middle"><a href="javascript:history.back();"><font face="arial" size="2"><?=$_FLM["TITLE"]?> : Error, Invalid filename!</font></a></td>
	</tr>
</table>
<? } ?>