<? 
	require_once("../config.inc.php");
	
	if(isset($_GET["savenew"])){
		$qMaxID = cmsDB();
		$strSQL = "SELECT MAX(train_uid) AS max_id FROM tbl_training";
		$qMaxID->query($strSQL);
		$qMaxID->next();
		$max_id = $qMaxID->row("max_id") + 1;
		
		$idate = date("Y-m-d h:i:s");
		$ititle = trim(postParam("ITITLE",""));
		$train_id = 'training_'.$max_id;
		$nomor_id = $max_id;
		$kelompok = trim(postParam("kelompok",""));
		$strSQL = "INSERT INTO tbl_training (template_id,train_id,nomor_id,idate,ikeyword,ititle,kelompok,date_created,date_modified) ";
		$strSQL .= "VALUES ('training','".$train_id."','".$nomor_id."','".$idate."','-',";
		$strSQL .= "'".$ititle."','".$kelompok."','".$idate."','".$idate."')";
		$mega_db->query($strSQL);
		echo "<script>alert('Record Saved');location='index.php?ref=".mktime()."';</script>";
		die();
	}
	
	if(isset($_GET["saveedit"])){
		$idate = date("Y-m-d h:i:s");
		$ititle = trim(postParam("ITITLE",""));
		$kelompok = trim(postParam("kelompok",""));
		$strSQL = "update tbl_training set ititle='".$ititle."',kelompok='".$kelompok."',date_modified='".$idate."' where train_uid=" . $_GET["auid"];
		$mega_db->query($strSQL);
		//echo $strSQL;
		echo "<script>alert('Record Updated');location='index.php?ref=".mktime()."';</script>";
		die();
	}
	
	if(isset($_GET["delete"])){
		$strSQL = "delete from tbl_training where train_uid= ".$_GET["auid"];
		$mega_db->query($strSQL);
		echo "<script>alert('Record Deleted');location='index.php?ref=".mktime()."';</script>";
		die();
	}
	
	$strSQL = "select * from tbl_training where template_id='training' order by train_uid desc";
	$mega_db->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link href="../css/admin.css" rel="stylesheet" type="text/css">
<title><?=$FJR_VARS["admin_title"]?></title>
<script language="javascript" type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,media,searchreplace,print,contextmenu,paste,directionality,fullscreen",
	theme_advanced_buttons1_add_before : "save,newdocument,separator",
	theme_advanced_buttons1_add_before : "forecolor,backcolor",
	//theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,fontselect,fontsizeselect",
	theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
	theme_advanced_buttons3_add_before : "tablecontrols,separator",
	//theme_advanced_buttons3_add : "emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	content_css : "example_word.css",
	plugi2n_insertdate_dateFormat : "%Y-%m-%d",
	plugi2n_insertdate_timeFormat : "%H:%M:%S",
//		external_link_list_url : "example_link_list.js",
//		external_image_list_url : "example_image_list.js",
//		media_external_list_url : "example_media_list.js",
	file_browser_callback : "fileBrowserCallBack",
	paste_use_dialog : false,
	theme_advanced_resizing : true,
	theme_advanced_resize_horizontal : false,
	theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
	paste_auto_cleanup_on_paste : true,
	paste_convert_headers_to_strong : false,
	paste_strip_class_attributes : "all",
	paste_remove_spans : false,
	paste_remove_styles : false		
	});

	function fileBrowserCallBack(field_name, url, type, win) {
		// This is where you insert your custom filebrowser logic
		alert("Filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);

		// Insert new URL, this would normaly be done in a popup
		win.document.forms[0].elements[field_name].value = "someurl.htm";
	}
</script>
  </head>
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="5" background="../images/depan.jpg"><b><font color="#FFFFFF">Training Group</font></b></td>
  </tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td width="20" align="right"><b>No.</b></td>
	  <td><b>Nama</b></td>
	  <td><b>Kelompok</b></td>
	  <td><strong>Date/Time Update</strong></td>
  </tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<? if ($mega_db->recordCount() == 0) { ?>
	<tr>
		<td colspan="4" align="center">Belum ada training</td>
	</tr>
	
	<? } else {
		  if(isset($_GET["edit"])){
			$train_id = $_GET["auid"];
			$editDB= cmsDB();
			$strSQL = "select * from tbl_training where train_uid=".$train_id;
			$editDB->query($strSQL);
			$editDB->next();
		?>
			<tr>
					<td colspan="4">
					<form name="frmAdd" action="index.php?saveedit=yes&auid=<?=$train_id?>" method="post" onSubmit="return Check()">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
							  <td colspan="3"><table width="0%" border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                  <td><b>Update Trainer</b></td>
                                  <td><b>:</b></td>
                                  <td><input type="text" name="ITITLE" size="40" maxlength="255" class="text" value="<?=$editDB->row("ititle")?>"></td>
                                </tr>
                                <tr>
                                  <td><b>Update Kelompok*</b></td>
                                  <td><b>:</b></td>
                                  <td><input type="text" name="kelompok" size="40" maxlength="255" class="text" value="<?=$editDB->row("kelompok")?>"></td>
                                </tr>
                              </table></td>
							</tr>
							<tr>
							  <td colspan="3">&nbsp;</td>
							</tr>
						<tr>
								<td colspan="3">&nbsp;
								<input type="submit" class="button" value="Update">&nbsp;
								<input type="button" class="button" value="Delete" onClick="location='index.php?delete=yes&auid=<?=$train_id?>&seed=<?=mktime()?>'"> 
								<input type="button" class="button" value="Cancel" onClick="location='index.php?seed=<?=mktime()?>'">								</td>
							</tr>
						</table>
					  </form>						</td>
				</tr>
		<? }
		if(isset($_GET["new"])){
		?>
		<tr>
		<td colspan="4">
		<form name="frmAdd" action="index.php?savenew=yes" method="post" onSubmit="return Check()">
			<table border="0" cellpadding="2" cellspacing="0">
				<tr>
					<td colspan="3"><table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td><strong>Nama Trainer</strong></td>
                        <td><b>:</b></td>
                        <td><input type="text" name="ITITLE" size="40" maxlength="255" class="text" value=""></td>
                      </tr>
                      <tr>
                        <td><strong>Kelompok*</strong></td>
                        <td><b>:</b></td>
                        <td><input type="text" name="kelompok" size="40" maxlength="255" class="text" value=""></td>
                      </tr>
                    </table></td>
			    </tr>
				<tr>
				  <td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;<input type="submit" class="button" value="Save">&nbsp;
					<input type="button" class="button" value="Cancel" onClick="location='index.php?seed=<?=mktime()?>'">					</td>
				</tr>
			</table>
		  </form>			</td>
	</tr>
	<form>
		<? }
		 while ($mega_db->next()) { 
		 ?>
				<tr>
					<td valign="top" align="left"><?=$mega_db->currentRow()?>.</td>
				  <td valign="top"><a href="index.php?edit=yes&pgid=<?=rawurlencode($mega_db->row("template_id"))?>&auid=<?=rawurlencode($mega_db->row("train_uid"))?>&seed=<?=mktime()?>"><?=htmlentities($mega_db->row("ititle"))?></a></td>
					<td valign="top"><?=htmlentities($mega_db->row("kelompok"))?></td>
					<td valign="top"><?=htmlentities($mega_db->row("date_modified"))?></td>
	  </tr>
			
		<? }
		} ?>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td colspan="4">
			<input type="button" class="button" value="Add" onClick="location='index.php?new=yes&seed=<?=mktime()?>'">		</td>
	</tr>
	</form>
	<tr>
		<td colspan="7">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
</table>
</body>
</html>
<script>
function Check() {
     var errmsg='';
	 ITITLE=document.frmAdd.ITITLE.value;
	 if (ITITLE.length == 0) errmsg +='Trainer Tidak boleh Kosong!\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}
</script>