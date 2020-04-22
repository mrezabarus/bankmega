<?
	require("_config.php");

	$path = _flm_post_param("PATH",false);
    /*
	if ($path === false || !$_FLM["IS_CREATEFL"]) {
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
	}
	*/


	$fname = _flm_post_param("FNAME","");
	$fcontent = _flm_post_param("FCONTENT","");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> : Create File</title>
	<LINK REL="StyleSheet" HREF="../css/flmgr.css" type="text/css">
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
	<!--
			OldFileContent = "";
			function BackToFileList() {
				frm = document.frmMkFL;
				if (frm.FCONTENT.value!=OldFileContent) {
					if (confirm('<?=_flm_jsformat($_FLM["TITLE"])?> : This file content has changed!\nAre you sure you want to abandon the change?')) 
						location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>';
					else 
						return;
				} else location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>';
			}
	//-->
	</SCRIPT>
</head>

<body topmargin="2" leftmargin="2" marginheight="2" marginwidth="2">
<table cellpadding="0" cellspacing="1" border="0">
	<form name="frmMkFL" action="qmkfl.php?<?=$_instanceurl?>" method="post">
	<input type="hidden" name="PATH" value="<?=htmlentities($path)?>">
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td class="flm_td_title1">
			<table cellpadding="2">
				<tr>
					<td class="flm_td_title1"><b>Create New File</b></td>
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
				<tr>
					<td class="flm_td">File Name</td>
				</tr>
				<tr>
					<td><input type="text" class="flm_text" name="FNAME" size="70" style="width:560" maxlength="200" value="<?=htmlentities($fname)?>"></td>
				</tr>
				<tr>
					<td class="flm_td">File Content</td>
				</tr>
				<tr>
					<td><textarea class="flm_textarea" name="FCONTENT" rows="21" cols="68" wrap="off"><?=htmlentities($fcontent)?></textarea></td>
				</tr>
				<tr>
					<td><input class="flm_button" type="submit" value="    Save File!    "> <input class="flm_button" type="button" value="Back to File List!" onClick="BackToFileList();"></td>
				</tr>
			</table>
		</td>
	</tr>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
	</form>
</table>
<? clearstatcache(); ?>
</body>
</html>
