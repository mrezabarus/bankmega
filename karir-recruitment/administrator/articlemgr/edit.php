<? 
	require_once("../config.inc.php");
	//echo "Masuk";
	$template_id = templateValidateID(uriParam("pgid",""));
	$article_uid = articleValidateID(uriParam("auid",""));
	
	$qtemplate = cmsDB();
	$strSQL = "SELECT template_id, template_type, template_group, custom_charset, ttemplate.language_id, tlanguage.charset, isindex, ttemplate.display_name as tempDName,  tlanguage.display_name as langDName";
	$strSQL .= ",edition_id FROM (ttemplate LEFT OUTER JOIN tlanguage ON ttemplate.language_id = tlanguage.language_id) WHERE template_id = '".$template_id."'";
	$qtemplate->query($strSQL);
	
	if ($qtemplate->recordCount() != 1) {
		jsAlert("Template doesn't exists!");
		die();
	}
	
	$qtemplate->next();
	
	$strSQL = "SELECT article_uid, article_id, DATE_FORMAT(idate,'".$cms_article["datetime_format"]."') as adate, ikeyword, ititle, isummary, icontent";
	$strSQL .= ",edition_id FROM tarticle WHERE template_id = '".$riau_db->safeSQL($qtemplate->row("template_id"))."' AND article_uid = ".$riau_db->safeSQL($article_uid);
	$riau_db->query($strSQL);

	if ($riau_db->recordCount() != 1) {
		jsAlertAndNavigate("Article doesn't exists!","index.php?pgid=".$template_id,true);
		die();
	}
	
	$riau_db->next();

	$article_uid = trim($riau_db->row("article_uid"));
	$article_id = trim($riau_db->row("article_id"));
	$idate = trim($riau_db->row("adate"));
	$ititle = trim($riau_db->row("ititle"));
	$edition_id = trim($riau_db->row("edition_id"));
	$ikeyword = trim($riau_db->row("ikeyword"));
	$isummary = trim(articleDecodePath($riau_db->row("isummary"),"www_img_url,www_embed_url,cms_url"));
	$icontent = trim(articleDecodePath($riau_db->row("icontent"),"www_img_url,www_embed_url,cms_url"));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$CMS_VARS["admin_title"]?> -  Add Article for <?=htmlentities($qtemplate->row("template_id"))?>&nbsp;:&nbsp;<?=htmlentities($qtemplate->row("tempDName"))?></title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<? if ($qtemplate->row("charset") != "") { ?>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$qtemplate->row("charset")?>">
	<? } else if ($riau_db->row("custom_charset") != "") { ?>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$qtemplate->row("custom_charset")?>">
	<? } ?>
	<SCRIPT LANGUAGE="JavaScript" SRC="../js/taeditor.js" TYPE="text/javascript"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" SRC="../js/misc.js" TYPE="text/javascript"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
	<!--
		var t_summary;
		var t_detail;
		function bodyOnLoad() {
			t_summary = new taEditor(document,document.frmAdd.ISUMMARY);
			t_detail = new taEditor(document,document.frmAdd.ICONTENT);
		}
		
		/*function winOpen(src,dest,name,w,h) {
			dest = dest == 1 ? escape('frmedit.summary') : escape('frmedit.detail');
			window.open('../inc/'+src+'?frm='+dest,name,'width='+w+',height='+h+',scrollbars=no,resizable=no,status=no,toolbar=no');
		}*/
	//-->
	</SCRIPT>
	<script>
	 function _editor(x){
  		window.open('editor/editor.php?&pgid=<?=$template_id?>&auid=<?=$article_uid?>&field='+ x +'&refresh=<?=urlencode(date("m d y h i s"))?>','frmeditor','width=800,height=600,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
		void null;
  }
  </SCRIPT>
</head>

<body onLoad="bodyOnLoad()">
<table border="0" cellpadding="4" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmAdd" action="qedit.php?edition_id=<?=$_GET["edition_id"]?>" method="post">
	<input type="Hidden" name="PGID" value="<?=$template_id?>">
	<input type="Hidden" name="AUID" value="<?=$article_uid?>">
	<tr>
		<td bgcolor="#000000" background="../images/depan.jpg"  height="25" valign="middle"><font color="#FFFFFF"><b>Add Article for <?=htmlentities($qtemplate->row("template_id"))?>&nbsp;:&nbsp;<?=htmlentities($qtemplate->row("tempDName"))?></b></font></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="0" width="100%">
				<tr>
					<td>Article ID :</td>
					<td><input type="text" name="AID" size="20" maxlength="255" class="text" value="<?=htmlentities($article_id)?>"></td>
				</tr>
				<tr>
					<td>Article Title :</td>
					<td><input type="text" name="ITITLE" size="20" maxlength="255" class="text" value="<?=htmlentities($ititle)?>"></td>
				</tr>
				<tr>
					<td>Article Date (MM/DD/YYYY (HH:MM:SS)) :</td>
					<td ><input type="text" name="IDATE" size="20" maxlength="19" class="text" value="<?=htmlentities($idate)?>"></td>
				</tr>
				<tr>
					<td>Article Keyword :</td>
					<td ><input type="text" name="IKEYWORD" size="20" maxlength="255" class="text" value="<?=htmlentities($ikeyword)?>"></td>
				</tr>
				<tr>
					<td>Edition ID :</td>
					<td >
					<select name="seledition">
					<?
						$qedition=cmsDB();
						$strSQL = "select * from tbl_editiondefault";
						$qedition->query($strSQL);
						while ($qedition->next()) {
							echo "<option value='".htmlentities($qedition->row("edition_id"))."'";
							if(htmlentities($qedition->row("edition_id"))==$edition_id){
								echo "selected";
							}
							echo " >".htmlentities($qedition->row("edition_name"))."</option>";
						}
					?>
					</select>
					</td>
				</tr>
				
					<tr>
					<td colspan="2">Article Summary :
					&nbsp;&nbsp;&nbsp;<a href="javascript:_editor('ISUMMARY')">[ Wysiwyg Editor ]</a>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="ISUMMARY" cols="80" rows="8" class="textarea" wrap="off"><?=htmlentities($isummary)?></textarea>
						
					</td>
				</tr>
<tr>
					<td colspan="2">Article Content :
					&nbsp;&nbsp;&nbsp;<a href="javascript:_editor('ICONTENT')">[ Wysiwyg Editor ]</a></td>
				</tr>
				
				<tr>
					<td colspan="2">
					<textarea name="ICONTENT" cols="80" rows="20" class="textarea" wrap="off"><?=htmlentities($icontent)?></textarea>
					
				</td>
				</tr>
				
			</table>
</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
			<input type="submit" class="button" value="Update"> 
			<input type="button" class="button" value="Delete" onClick="if (confirm('Are you sure you want to delete this Article?')) location='qdelete.php?pgid=<?=$template_id?>&edition_id=<?=$_GET["edition_id"]?>&auid=<?=$article_uid?>&seed=<?=mktime()?>'"> 
			<input type="button" class="button" value="Back" onClick="location='index.php?pgid=<?=$template_id?>&edition_id=<?=$_GET["edition_id"]?>&seed=<?=mktime()?>'">
		</td>
	</tr>
<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	</form>
</table>
</body>
</html>