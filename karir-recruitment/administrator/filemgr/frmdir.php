<?
	require ("_config.php");
	
	$path = _flm_post_param("PATH",false);
	$path = _flm_pathfix($path);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Delete Directory</title>
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
					<td class="flm_td_title1" align="left"><b>Delete Directory</b></td>
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
				<form action="qrmdir.php?<?=$_instanceurl?>" method="post">
				<input type="hidden" name="PATH" value="<?=htmlentities($path)?>">
				<tr>
					<td class="flm_td" align="center" nowrap><br />&nbsp;&nbsp;&nbsp;Are you sure you want to delete&nbsp;&nbsp;&nbsp;<br />&nbsp;&nbsp;&nbsp;/<?=htmlentities($path)?>&nbsp;?&nbsp;&nbsp;&nbsp;<br /><br /><br /></td>
				</tr>
				<tr>
					<td align="center"><input class="flm_button" type="submit" value="Delete Directory!"> <input class="flm_button" type="button" value=" Back to File List! " onClick="location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>'"></td>
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
