<?
	require("_config.php");

	$path = _flm_post_param("PATH",false);
	$filecount = _flm_post_param("FILECOUNT",0);
	$files = array();

	for ($i = 1; $i <= $filecount; $i++) {
		if (trim(_flm_post_param("FILEID_".$i,"")) != "")
			$files[count($files)] = _flm_post_param("FILEID_".$i,"");
	}

/*
	if (count($files) < 1 || $path === false || !$_FLM["IS_EDIT"]) {
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
	$currFile = _flm_post_param("CURRFILE","");
	
	if (!isset($_POST["CURRFILE"])) {
		foreach ($files as $el) {
			$el = stripslashes($el);
			$currFile = $el;
			break;
		}
	}
	
	if (is_file($_FLM["ROOTPATH"].$path.$currFile)) {
		$fp = @fopen ($_FLM["ROOTPATH"].$path.$currFile, "r");
		if (!$fp) {
			ErrMsg(2,$path);
			die();
		}
		$filebuffer = @fread ($fp, filesize($_FLM["ROOTPATH"].$path.$currFile));
		@fclose ($fp);
		clearstatcache();
	} else {
		ErrMsg(2,$path);
		die();
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?=$_FLM["TITLE"]?> | Edit File(s)</title>
	<LINK REL="StyleSheet" HREF="../css/flmgr.css" type="text/css">
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
	<!--
			OldFileContent = "";
			OldEditFileIndex = 0;
			function BackToFileList() {
				frm = document.frmEdit;
				if (frm.FCONTENT.value!=OldFileContent) {
					if (confirm('<?=$_FLM["TITLE"]?> : This file content has changed!\nAre you sure you want to abandon the change?')) 
						location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>';
					else 
						return;
				} else 
					location = 'filelist.php?PATH=<?=rawurlencode($path)?>&<?=$_instanceurl?>&SEED=<?=mktime()?>';
			}
			
			function ChangeEditFile() {
				frm = document.frmEdit;
				cancelchange = false;
				if (frm.FCONTENT.value!=OldFileContent) 
					if (!confirm('<?=$_FLM["TITLE"]?> : This file content has changed!\nAre you sure you want to abandon the change?')) cancelchange = true;
				if (!cancelchange) {
					frm.action = "fedit.php?<?=$_instanceurl?>";
					frm.submit();
				} else frm.CURRFILE.selectedIndex = OldEditFileIndex;
			}
	//-->
	</SCRIPT>
</head>

<body topmargin="2" leftmargin="2" marginheight="2" marginwidth="2">
<table cellpadding="0" cellspacing="1" border="0">
	<form name="frmEdit" action="qedit.php?<?=$_instanceurl?>" method="post">
	<input type="Hidden" name="PATH" value="<?=htmlentities($path)?>">
	<input type="hidden" name="FILECOUNT" value="<?=count($files)?>">
	<?
		$i = 0;
		foreach ($files as $el) {
			$el = stripslashes($el);
			$i++;
			?><input type="Hidden" name="FILEID_<?=$i?>" value="<?=htmlentities($el)?>"><?
		}
	?>
  <tr>
    <td bgcolor="#CCCCCC"><img border="0" src="<?=$_FLM_IMGURL?>b.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td class="flm_td_title1">
			<table cellpadding="2">
				<tr>
					<td class="flm_td_title1"><b>Edit File</b></td>
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
					<td class="flm_td">File(s) to Edit</td>
				</tr>
				<tr>
					<td><select class="flm_combo" name="CURRFILE" onChange="ChangeEditFile()" width="565" style="width:564px">
					<? 
						foreach ($files as $el) {
							$el = stripslashes($el);
							?><option value="<?=htmlentities($el)?>"<?=$el==$currFile?" selected":""?>>-&nbsp;<?=htmlentities(_flm_truncfname($el,60))?>&nbsp;<? 
						}
					?>
					</select></td>
				</tr>
				<tr>
					<td class="flm_td">Current File : <a href="getfile.php?filename=<?=rawurlencode($path.$currFile)?>&<?=$_instanceurl?>"><?=htmlentities(_flm_truncfname($currFile,60))?></a></td>
				</tr>
				<tr>
					<td class="flm_td">File Content</td>
				</tr>
				<tr>
					<td><textarea class="flm_textarea" name="FCONTENT" rows="21" cols="68" wrap="off"><?=htmlentities($filebuffer)?></textarea></td>
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
<? @clearstatcache(); ?>
</body>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
	frm = document.frmEdit;
	OldFileContent = frm.FCONTENT.value;
	OldEditFileIndex = frm.CURRFILE.selectedIndex;
//-->
</SCRIPT>
</HTML>
