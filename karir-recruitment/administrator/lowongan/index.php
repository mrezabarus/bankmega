<? 
	require_once("../config.inc.php");
/////////////////////////////////////////////////
	$perhalaman = 10;     // tentukan jumlah data perhalaman
	
	// jika ada parameter halaman, ambil. jika tidak, isikan kosong
	$halaman = isset($_GET["page"]) ? $_GET["page"] : "0";
	
	// hitung posisi awal data (offset)
	$awal = $halaman * $perhalaman;
	$query = "select * from tbl_lowongan order by date_modified DESC limit $awal, $perhalaman";
	$query_jumlah = "select count(*) AS maxuser from tbl_lowongan";
	
	// ambil jumlah total data
	$rs_jumlah = mysql_query($query_jumlah);
	$r = mysql_fetch_row($rs_jumlah);
	
	$total_halaman = ceil($r[0] / $perhalaman);
	
	$halaman_str = "";  // kosongkan variabel
	if ($halaman > 1)
	   $halaman_str .= "<a href='?page=0' title='Halaman pertama'><b>First</b></a> ";
	if ($halaman > 0){
	   $page = $halaman - 1; 
	   $halaman_str .= "<a href='?page=$page' title='Halaman sebelumnya'>Prev</a> ";
	}

		$jumlah_link_hal = 5; 
		$a=$halaman-$jumlah_link_hal;
		$b=$halaman+$jumlah_link_hal+1;
		
		if ($a<1)$a=0;
		if ($b>$total_halaman)$b=$total_halaman;
		
		if ($halaman > $jumlah_link_hal){
			$halaman_str .= "...&nbsp;";
		}
		for ($i = $a; $i < $b; $i++){
			 $page = $i + 1;
			 if ($i == $halaman)
				 $halaman_str .= "<strong>$page </strong>";
			 else
				 $halaman_str .= "<a href='?".$url."&page=$i' title='Halaman $page' class='link_normal'>$page</a> ";
		}
		if ($halaman < $total_halaman-$jumlah_link_hal-1){
			$halaman_str .= "...&nbsp;";
		}

if ($halaman < ($total_halaman - 1)){
   $page = $halaman + 1; 
   $halaman_str .= "<a href='?page=$page' title='Halaman berikutnya'>Next</a> ";
}

if ($halaman < ($total_halaman - 2)){
   $page = $total_halaman - 1; 
   $halaman_str .= "<a href='?page=$page' title='Halaman terakhir'><b>Last</b></a> ";
}

$halaman_str = "<div style='width: 100%; background-color: #ddd'>$halaman_str</div>\n";
$rs = mysql_query($query);
	
//////////////////////////////////////////////////////////////////////////	
	if(isset($_GET["savenew"])){
		$qMaxID = cmsDB();
		$strSQL = "SELECT MAX(lowongan_uid) AS max_id FROM tbl_lowongan";
		$qMaxID->query($strSQL);
		$qMaxID->next();
		$max_id = $qMaxID->row("max_id") + 1;
		
		$idate = date("Y-m-d h:i:s");
		$ititle = trim(postParam("ITITLE",""));
		$iregion = trim(postParam("region",""));
		$ibranch = trim(postParam("branch",""));
		$lowongan_id = 'posisi_detail_'.$max_id;
		$isummary = str_replace('\"', '',trim(lowonganEncodePath(postParam("ISUMMARY",""),"www_img_url,www_embed_url,cms_url")));
		$isummary = str_replace("'", '',trim($isummary));
		
		$strSQL = "INSERT INTO tbl_lowongan (template_id,lowongan_id,idate,ikeyword,ititle,region,branch,isummary,date_created,date_modified) ";
		$strSQL .= "VALUES ('posisi_detail','".$lowongan_id."','".$idate."','-',";
		$strSQL .= "'".$ititle."','".$iregion."','".$ibranch."','".$isummary."','".$idate."','".$idate."')";
		$mega_db->query($strSQL);
		echo "<script>alert('Record Saved');location='index.php?ref=".mktime()."';</script>";
		die();
	}
	
	if(isset($_GET["saveedit"])){
		$idate = date("Y-m-d h:i:s");
		$ititle = trim(postParam("ITITLE",""));
		$iregion = trim(postParam("region",""));
		$ibranch = trim(postParam("branch",""));
		$isummary = str_replace('\"', '',trim(lowonganEncodePath(postParam("ISUMMARY",""),"www_img_url,www_embed_url,cms_url")));
		$isummary = str_replace("'", '',trim($isummary));
		
		$strSQL = "update tbl_lowongan set ititle='".$ititle."',region='".$iregion."',branch='".$ibranch."',isummary='".$isummary."',date_modified='".$idate."' where lowongan_uid=" . $_GET["auid"];
		$mega_db->query($strSQL);
		//echo $strSQL;
		echo "<script>alert('Record Updated');location='index.php?ref=".mktime()."';</script>";
		die();
	}
	
	if(isset($_GET["delete"])){
		$strSQL = "delete from tbl_lowongan where lowongan_uid= ".$_GET["auid"];
		$mega_db->query($strSQL);
		echo "<script>alert('Record Deleted');location='index.php?ref=".mktime()."';</script>";
		die();
	}
	
	$strSQL = "select * from tbl_lowongan where template_id='posisi_detail' order by lowongan_uid desc";
	$mega_db->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link href="../css/admin.css" rel="stylesheet" type="text/css">
<link href="../css/tiny_mce.css" rel="stylesheet" type="text/css">
<title><?=$FJR_VARS["admin_title"]?></title>
<script language="javascript">
function makeObject(){
	var x; 
	var browser = navigator.appName; 
	if(browser == "Microsoft Internet Explorer"){
		x = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		x = new XMLHttpRequest();
	}
	return x;
}

var request = makeObject();

function get_method(addr){
	var data = addr;
	request.open('get', 'load.php?id='+data);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = output; 
	request.send('');
}

function output(){
	if(request.readyState == 1){
		document.getElementById('sample_form').innerHTML = 'Load...';
	}
	if(request.readyState == 4){
		var data = request.responseText;
		document.getElementById('sample_form').innerHTML = data;
	}
}
</script>
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
</script></head>
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="4" background="../images/depan.jpg"><strong><font color="#FFFFFF">Vacancy</font></strong></td>
  </tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
	  <td><b>Posisi</b></td>
	  <td><b>Region</b></td>
	  <td><b>Branch</b></td>
		<td><b>Created</b></td>
  </tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<? if ($mega_db->recordCount() == 0) { ?>
	<tr>
		<td colspan="4" align="center">Belum ada lowongan terisi...</td>
	</tr>
	
	<? } else {
		  if(isset($_GET["edit"])){
			$lowongan_id = $_GET["auid"];
			$editDB= cmsDB();
			$strSQL = "select * from tbl_lowongan where lowongan_uid=".$lowongan_id;
			$editDB->query($strSQL);
			$editDB->next();
		?>
			<tr>
					<td colspan="4">
					<form name="frmAdd" action="index.php?saveedit=yes&auid=<?=$lowongan_id?>" method="post" onSubmit="return Check()">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
							  <td colspan="3"><table width="0%" border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                  <td align="right"><b>Update Posisi</b></td>
                                  <td><b>:</b></td>
                                  <td><input type="text" name="ITITLE" size="40" maxlength="255" class="text" value="<?=$editDB->row("ititle")?>"></td>
                                </tr>
  <?
	if(isset($_GET["selregion"])){
		$selcomp = $_GET["selregion"];
	}else{
		$selcomp = 0;
	}
	$region=cmsDB();
	$region->query("select * from tbl_region");
	?>
					  <tr>
                        <td align="right"><b>Update Region</b></td>
                        <td><b>:</b></td>
                        <td><select size="1" name="select">
                          <option value="0">Select Region</option>
                          <?
				$firstcomp=0;
				while($region->next()){?>
                          <option onClick="get_method('<?=$region->row("region_id")?>');" value="<?=$region->row("region_id")?>"<? if($selcomp==$region->row("region_id")){ echo " selected";}?>>
                          <?=$region->row("region_name")?>
                          </option>
                          <?}?>
                        </select></td>
                      </tr>
                      <tr>
                        <td align="right"><b>Update Branch</b></td>
                        <td><b>:</b></td>
                        <td><div id="sample_form">Pilih Region dahulu...</div></td>
                      </tr>
                              </table></td>
							</tr>
							<tr>
							  <td colspan="3">&nbsp;</td>
							</tr>
							<tr>
							  <td colspan="3">
								  <table border="0" cellspacing="0" cellpadding="2">
                                    <tr>
                                      <td><b>Update Descriptions</b></td>
                                      <td><b>:</b></td>
                                    </tr>
                                  </table></td>
							</tr>
							<tr>
							  <td colspan="3"><textarea name="ISUMMARY" cols="65" rows="20" class="textarea" wrap="off"><?=$editDB->row("isummary")?></textarea></td>
						  </tr>
						<tr>
								<td colspan="3">&nbsp;
								<input type="submit" class="button" value="Update">&nbsp;
								<input type="button" class="button" value="Delete" onClick="location='index.php?delete=yes&auid=<?=$lowongan_id?>&seed=<?=mktime()?>'"> 
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
		<form name="frmAdd" action="index.php?savenew=yes" id="frmAdd" method="post" onSubmit="return Check()">
			<table border="0" cellpadding="2" cellspacing="0">
				<tr>
					<td colspan="3">
					<table border="0" align="left" cellpadding="2" cellspacing="0">
                      <tr>
                        <td align="right"><b>Posisi</b></td>
                        <td align="right"><b>:</b></td>
                        <td><input type="text" name="ITITLE" size="40" maxlength="255" class="text" value=""></td>
                      </tr>
  <?
	if(isset($_GET["selregion"])){
		$selcomp = $_GET["selregion"];
	}else{
		$selcomp = 0;
	}
	$region=cmsDB();
	$region->query("select * from tbl_region");
	?>
  <tr>
    <td align="right"><b>Region</b></td>
    <td><b>:</b></td>
    <td><select size="1" name="selregion">
      <option value="0">Select Region</option>
      <?
				$firstcomp=0;
				while($region->next()){?>
      <option onClick="get_method('<?=$region->row("region_id")?>');" value="<?=$region->row("region_id")?>"<? if($selcomp==$region->row("region_id")){ echo " selected";}?>>
        <?=$region->row("region_name")?>
        </option>
      <?}?>
    </select>
	</td>
  </tr>
  <tr>
    <td align="right"><b>Branch</b></td>
    <td align="right"><b>:</b></td>
    <td><div id="sample_form">Pilih Region dahulu...</div></td>
  </tr>
                  </table></td>
			    </tr>
				<tr>
				  <td colspan="3">&nbsp;</td>
				</tr>
				<tr>
				  <td colspan="3">
					  <table width="0%" border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td><b>Description Posisi</b></td>
                          <td><b>:</b></td>
                        </tr>
                      </table></td>
				</tr>
				<tr>
				  <td colspan="3"><textarea name="ISUMMARY" cols="65" rows="20" class="textarea" wrap="off"></textarea></td>
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
		 while ($r = mysql_fetch_array($rs)) {
		$conter = $r[$mega_db->currentRow()];
		$date = explode('-',$r[date_modified]);
		$day = explode(" ",$date[2]);
		$date_modified = $day[0].'-'.$date[1].'-'.$date[0];
		 ?>
				<tr>
				  <td valign="top"><a href="index.php?edit=yes&pgid=<?=rawurlencode($r[template_id]);?>&auid=<?=rawurlencode($r[lowongan_uid])?>&seed=<?=mktime()?>"><?=htmlentities($r[ititle])?></a></td>
					<td valign="top"><?=htmlentities($r[region])?></td>
					<td valign="top"><?=htmlentities($r[branch])?></td>
					<td valign="top"><?=htmlentities($date_modified)?></td>
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
		<td colspan="3">
			<input type="button" class="button" value="Add" onClick="location='index.php?new=yes&seed=<?=mktime()?>'">		</td>
	    <td align="right"><?=$halaman_str?></td>
	</tr>
	</form>
	<tr>
		<td colspan="6">
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
	 if (ITITLE.length == 0) errmsg +='Posisi Tidak boleh Kosong!\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}
</script>