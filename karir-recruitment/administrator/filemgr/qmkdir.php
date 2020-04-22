<?
	require("_config.php");

	$path = _flm_post_param("PATH",false);
	$path = _flm_pathfix($path);
	$newdir = _flm_post_param("NEWDIR","");

	$result = "Directory succesfuly created!";
	
	$is_invalidname = !_flm_isvalid_dir($_FLM["ROOTPATH"].$path.$newdir) || _flm_invalidfname($newdir) || @is_dir($_FLM["ROOTPATH"].$path.$newdir);
	
	if ($is_invalidname) $result = "<font color=red>Invalid Directory Name or Directory Name already Exists!</font>";
	else {
		$rs = @mkdir($_FLM["ROOTPATH"].$path.$newdir,0755);
		if (!$rs) $result = "<font color=red>Unknown error occured while creating directory!</font>";
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<link rel="STYLESHEET" type="text/css" href="../css/flmgr.css">
</head>

<body topmargin="2" leftmargin="2" marginheight="2" marginwidth="2">
<table cellpadding="0" cellspacing="1" border="0">
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td class="flm_td_title1">
			<table cellpadding="2" width="100%">
				<tr>
					<td class="flm_td_title1" align="left"><b>Make New Sub Directory - Result</b></td>
				</tr>
			</table>
		</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
	<tr>
		<td bgcolor="#EFF3FC">
			<table cellspacing="6" border="0" cellpadding="4">
				<form action="fmkdir.php?<?=$_instanceurl?>" method="post">
				<input type="hidden" name="PATH" value="<?=htmlentities($path)?>">
				<tr>
					<td class="flm_td">Directory name</td>
					<td class="flm_td">:</td>
					<td class="flm_td">/<?=$path.$newdir?></td>
				</tr>
				<tr>
					<td class="flm_td">Creation Status</td>
					<td class="flm_td">:</td>
					<td class="flm_td"><?=$result?></td>
				</tr>
				<tr>
					<td colspan="3"><input class="flm_button" type="submit" value="Make More Directory!"> <input class="flm_button" type="button" value="   Back to File List!   " onClick="location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>'"></td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
</table>
<? clearstatcache(); ?>
</body>
</html>
