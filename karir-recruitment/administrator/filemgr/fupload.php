<?
	require ("_config.php");
	
	$path = _flm_post_param("PATH",false);
	$numupl = is_numeric(_flm_post_param("NUMUPL",5))?_flm_post_param("NUMUPL",5):5;
	
	$path = _flm_pathfix($path);
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Upload File(s)</title>
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
					<td class="flm_td_title1" align="left"><b>Upload File(s)</b></td>
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
				<form action="fupload.php?<?=$_instanceurl?>" method="post">
				<input type="hidden" name="PATH" value="<?=htmlentities($path)?>">
				<tr>
					<td nowrap class="flm_td">File Count</td>
					<td><select class="flm_combo" name="NUMUPL" onChange="this.form.submit();">
						<option value="5" <?=$numupl==5?"selected":""?>>5
						<option value="10" <?=$numupl==10?"selected":""?>>10
					</select></td>
				</tr>
				</form>
				<form action="qupload.php?<?=$_instanceurl?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="PATH" value="<?=htmlentities($path)?>">
				<? for ($i = 0; $i < $numupl; $i++) { ?>
				<tr>
					<td nowrap class="flm_td">File - <?=$i+1?></td>
					<td><input class="flm_text" type="file" style="width:400px" name="upload_file[]"></td>
				</tr>
				<? } ?>
				<tr>
					<td colspan="2"><input class="flm_button" type="submit" value="   Upload File!   "> <input class="flm_button" type="button" value="Back to File List!" onClick="location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>'"></td>
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
