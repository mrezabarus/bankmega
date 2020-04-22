<?
	require ("_config.php");
	
	$path = _flm_post_param("PATH",false);
/*
	if ($path === false || !$_FLM["IS_MKDIR"]) {
		$path = _flm_post_param("PATH","");
		ErrMsg(1,$path);
		die();
	}
	*/
	$path = _flm_pathfix($path);
	/*
	if (!_flm_isvalid_dir($_FLM["ROOTPATH"].$path)) {
		ErrMsg(1);
		die();
	}*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Make New Sub Directory</title>
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
					<td class="flm_td_title1" align="left"><b>Make New Sub Directory</b></td>
				</tr>
			</table>
		</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
	<tr>
		<td bgcolor="#EFF3FC">
			<table cellspacing="6" border="0" cellpadding="0">
				<form action="qmkdir.php?<?=$_instanceurl?>" method="post">
				<input type="hidden" name="PATH" value="<?=htmlentities($path)?>">
				<tr>
					<td nowrap class="flm_td">Directory name</td>
					<td><input class="flm_text" type="input" style="width:350px" name="NEWDIR"></td>
				</tr>
				<tr>
					<td colspan="2"><input class="flm_button" type="submit" value=" Make Directory! "> <input class="flm_button" type="button" value="Back to File List!" onClick="location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>'"></td>
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
