<?
	require("_config.php");
	require("_lib.php");
	if (!isset($path)) {
		$epath = "";
		$path = $RootPath;
	} else {
		$epath = $path;
		$path = $RootPath.$path;
	}
	if (!@is_dir($path)) {
		$epath = "";
		$path = $RootPath;
	}
	$handler = @dir($path);
	$filecount = 0;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>devCMS | File Manager | File List</title>
	<style>
		.flat {border:solid 1 black; font-family:verdana,helvetica; font-size:8pt;}
	</style>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
		<? if ($allow_upload) {?>
		function UploadFile() {
			document.frmFileList.action = "upload.php";
			document.frmFileList.submit();
		}
		<?} ?>

		<? if ($allow_mkdir) {?>
		function MKDir() {
			document.frmFileList.action = "mkdir.php";
			document.frmFileList.submit();
		}
		<?} ?>
		
		<? if ($allow_delete) {?>
  	function DeleteFile() {
			if (!IsOneChecked()) {
				alert("devCMS | File Manager Error : Please select 1 or more file(s) to delete!");
				return;
			}
			deletewin = null;
			document.frmFileList.action = "delete.php";
			document.frmFileList.submit();
		}
		<?} ?>
		
		<? if ($allow_rmdir) {?>
  	function RMDir() {
			document.frmFileList.action = "rmdir.php";
			document.frmFileList.submit();
		}
		<?} ?>
		
		function setCheck(state) {
			frmEL = document.frmFileList.elements;
			for (i=0;i<frmEL.length;i++) 
				if (frmEL[i].name=='chkFile[]') frmEL[i].checked = state;
		}
		
		function IsOneChecked() {
			frmEL = document.frmFileList.elements;
			for (i=0;i<frmEL.length;i++) {
				if (frmEL[i].name=='chkFile[]') 
					if (frmEL[i].checked) return true;
			}
			return false;
		}

  	function RefreshThisWin() {
			document.clear();
			document.write("<table width=100% height=80%><tr><td align=center valign=middle>");
			document.write("<font face=arial size=2>Loading List of File(s)...</font>");
			document.write("</td></tr></table>");
			document.close();
    	location="filelist.php?path=<?=urlencode($epath)?>&ref=<?=urlencode(date("mdYhis"))?>";
		}

		function act(val) {
			switch(val) {
				case "1" : RefreshThisWin(); break;
				<?if ($allow_upload) {?>
				case "2" : UploadFile(); break;
				<?}?>
				<?if ($allow_delete) {?>
				case "4" : DeleteFile(); break;
				<?}?>
				<?if ($allow_mkdir) {?>
				case "5" : MKDir(); break;
				<?}?>
				<?if ($allow_rmdir) {?>
				case "6" : RMDir(); break;
				<?}?>
				default : RefreshThisWin(); break;
			}
		}
  //-->
  </SCRIPT>
</head>

<body topmargin="4" leftmargin="4" marginheight="4" marginwidth="4">
<table cellpadding=0 cellspacing=0 border=0 width=100%>
	<form name="frmFileList" method="post" enctype="application/x-www-form-urlencoded">
	<input type="hidden" name="path" value="<?=$epath?>">
	<tr>
		<td bgcolor="#000000">
			<table cellpadding=4 cellspacing=1 border=0 width=100%>
				<tr>
					<td bgcolor="#DEDEDE" colspan="4" align="center">
						<table>
							<tr>
								<td><font face="arial,helvetica" size="2">Action</font></td>
								<td><select class="flat" name="cboAct_1">
									<option value="1">Refresh!
									<?if ($allow_upload) {?>
									<option value="2">Upload File
									<?}?>
									<?if ($allow_delete) {?>
									<option value="4">Delete File
									<?}?>
									<?if ($allow_mkdir) {?>
									<option value="5">Make New Sub-Directory!
									<?}?>
									<?if ($allow_rmdir) {?>
									<option value="6">Delete Directory!
									<?}?>
								</select></td>
								<td><input class="flat" type="button" value="Go!" onclick="act(this.form.cboAct_1.options[this.form.cboAct_1.selectedIndex].value);"></td>
							</tr>
						</table>
					</td>
				</tr>
<?
	echo "<tr bgcolor=#DEDEDE><td align=center><input type=Checkbox onclick=\"setCheck(this.checked)\"></td><td><b><font face=arial size=2>Filename</font></b></td><td align=right><b><font face=arial size=2>Size</font></b></td><td><b><font face=arial size=2>Date</font></b></td></tr>";
	if ($handler) {
		while (false !== ($entry = $handler->read())) {
			if (@is_file($path."/".$entry)) {
				$filecount++;
				echo "<tr bgcolor=#EEEEEE>";
				echo "<td align=center><input type=\"Checkbox\" name=\"chkFile[]\" value=\"".htmlentities($entry)."\"></td>";
				echo "<td nowrap><font face=arial size=2><a target=\"_blank\" href=\"getfile.php?filename=".rawurlencode($epath.$entry)."\">".TruncateFilename($entry,20)."</a></font></td>";
				echo "<td align=right nowrap><font face=arial size=2>".FileSizeKB($path."/".$entry)."KB</font></td>";
				echo "<td nowrap><font face=arial size=2>".FileLastModified($path."/".$entry)."</font></td>";
				echo "</tr>";
			}
		}
		clearstatcache();
		$handler->close();
	}
	if ($filecount==0) {
			echo "<tr bgcolor=#EEEEEE>";
			echo "<td colspan=4 align=center><font face=arial size=2>No file in this directory!</font></td>";
			echo "</tr>";
	}
?>
				<tr>
					<td bgcolor="#DEDEDE" colspan="4" align="center">
						<table>
							<tr>
								<td><font face="arial,helvetica" size="2">Action</font></td>
								<td><select class="flat" name="cboAct_2">
									<option value="1">Refresh!
									<?if ($allow_upload) {?>
									<option value="2">Upload File
									<?}?>
									<?if ($allow_delete) {?>
									<option value="4">Delete File
									<?}?>
									<?if ($allow_mkdir) {?>
									<option value="5">Make New Sub-Directory!
									<?}?>
									<?if ($allow_rmdir) {?>
									<option value="6">Delete Directory!
									<?}?>
								</select></td>
								<td><input class="flat" type="button" value="Go!" onclick="act(this.form.cboAct_2.options[this.form.cboAct_2.selectedIndex].value);"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	</form>
</table>

</body>
</html>
