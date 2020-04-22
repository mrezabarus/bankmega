<?
	require_once("../../config.php");
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<body topmargin="0" leftmargin="0">
<?
	$vacant=cmsDB();
	if(isset($_GET["upload"])){
		$dirpath = $ANOM_VARS["www_img_path"] . "vacant_approval/";
		$nama_file = "mpppos_id_".$_GET["mpppos_id"];
		if(is_dir($dirpath)){
			if (is_uploaded_file($_FILES["doc"]['tmp_name'])) {
				if(strtolower(listLast($_FILES["doc"]['name'],".")) == "jpg" || strtolower(listLast($_FILES["doc"]['name'],".")) == "gif" || strtolower(listLast($_FILES["doc"]['name'],".")) == "pdf" || strtolower(listLast($_FILES["doc"]['name'],".")) == "gif"){
					$nama_file = $nama_file . "." . listLast($_FILES["doc"]['name'],".");
					copy($_FILES["doc"]['tmp_name'], $dirpath.$nama_file);
					$vacant->query("update tbl_branch_mpp_apply set file_attached='".$nama_file."',real_filename='".$_FILES["doc"]['name']."' where mpppos_id=".$_GET["mpppos_id"]);
					echo "<script>alert('File Uploaded!');</script>";
				}else{
					$nama_file = "";
					echo "<script>alert('File Problem!');</script>";
				}
			}else{
				$nama_file = "";
				echo "<script>alert('Directory UnKnown!');</script>";
			}
		}
		echo "<script>location='".$_SERVER["SCRIPT_NAME"]."?mpppos_id=".$_GET["mpppos_id"]."';</script>";die();
		//die();
	}else{
		$vacant->query("select * from tbl_branch_mpp_apply where mpppos_id=".$_GET["mpppos_id"]);
		$vacant->next();
		if(strlen(trim($vacant->row("file_attached")))==0){
		
		}else{?>
			<script>
			function _pop(addr){
				PopWindow(addr,'WindowName', '800', '590', 'scrollbars=yes,location=no,status=yes')
			}
			</script>
			<SCRIPT language=JavaScript src="<?=$ANOM_VARS["www_js_url"]?>js_button.js" type=text/javascript></SCRIPT>
			<SCRIPT language=JavaScript src="<?=$ANOM_VARS["www_js_url"]?>jswarehouse.js" type=text/javascript></SCRIPT>

			<form name="frmdoc" action="<?=$_SERVER["SCRIPT_NAME"]?>?mpppos_id=<?=$_GET["mpppos_id"]?>&upload=yes" method=post enctype="multipart/form-data">
			<table border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td class=heading2 align="center"><font color="#ff0000"><a href="javascript:_pop('<?=$ANOM_VARS["www_img_url"]?>vacant_approval/<?=$vacant->row("file_attached")?>')">[See
	          Attachment]</a></font></td>
			  <td class=heading2 align="center">&nbsp;</td>
			  <td class=heading2 align="center">&nbsp;</td>
			  <td class=heading2 align="center">&nbsp;</td>
			  </tr>
			<tr>
				<td class=heading2 align="center">&nbsp;&nbsp;<font color="#ff0000">Update
				    Attach Files(.jpg,.gif,.pdf)</font>&nbsp;</td>
				<td class=heading2 align="center"><b>:</b></td>
				<td class=heading2 align="center">&nbsp;<input type="file" name="doc2" size="30"></td>
				<td class=heading2 align="center">&nbsp;<input type="Submit" value="Upload"></td>
			</tr>
			</table>
			</form>
<?
			die();
		}
	}
?>
<form name="frmdoc" action="<?=$_SERVER["SCRIPT_NAME"]?>?mpppos_id=<?=$_GET["mpppos_id"]?>&upload=yes" method=post enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td class=heading2 align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#ff0000">Attach Files(.jpg,.gif,.pdf)</font>&nbsp;</td>
	<td class=heading2 align="center"><b>:</b></td>
	<td class=heading2 align="center">&nbsp;<input type="file" name="doc" size="30"></td>
	<td class=heading2 align="center">&nbsp;<input type="Submit" value="Upload"></td>
</tr>
</table>
</form>
</body>