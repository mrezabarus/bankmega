<?
	require ("_config.php");
	if (!isset($filename)) {
?>
		<Table width="100%" height="90%">
			<tr>
				<td align="center" valign="middle"><a href="javascript:history.back();"><font face="arial,helvetica" size="2">File Manager Error : Missing Required Input!</font></a></td>
			</tr>
		</table>
<?
	}
	$invalid_filename = (count(explode("../",$filename))>1) || (count(explode("..\\",$filename))>1);
    if (ereg("MSIE ([0-9].[0-9]{1,2})", $HTTP_USER_AGENT, $log_version)) $Browser="IE";
    else if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) $Browser="OPERA";
    else if (ereg('Mozilla/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) $Browser="MOZILLA";
    else if (ereg('Konqueror/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) $Browser="KONQUEROR";
    else $Browser="OTHER";
	if (!$invalid_filename && @file_exists($RootPath.$filename)) {
  	$mime_type = ($Browser == "OPERA" || ($Browser == "IE" && $log_version[1] < 6)) ? "application/octetstream" : "application/octet-stream";
    if ($Browser == "IE") {
				header("Content-type: $mime_type");
				if ($log_version[1] < 6) 
        	header('Content-Disposition: attachment; filename="'.basename($RootPath.$filename).'"');
        else
        	header('Content-Disposition: inline; filename="'.basename($RootPath.$filename).'"');
        header('Expires: 0');
       	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
    } else {
				header("Content-type: $mime_type");
        header('Content-Disposition: attachment; filename="'.basename($RootPath.$filename).'"');
        header('Expires: 0');
        header('Pragma: no-cache');
    }
		echo @readfile ($RootPath.$filename,filesize($RootPath.$filename));
	} else {
?>
		<Table width="100%" height="90%">
			<tr>
				<td align="center" valign="middle"><a href="javascript:history.back();"><font face="arial,helvetica" size="2">File Manager Error : Invalid filename!</font></a></td>
			</tr>
		</table>
<? } ?>