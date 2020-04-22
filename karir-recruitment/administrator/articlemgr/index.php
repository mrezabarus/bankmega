<? 
	require_once("../config.inc.php");
	
	$qeditiondefault = cmsDB();
	$strSQL = "select edition_id from tbl_editiondefault where default_site=1";
	$qeditiondefault->query($strSQL);
	$qeditiondefault->next();
	if (isset($_POST["seledition"])){
		$edition_id=$_POST["seledition"];
	}elseif($_GET["edition_id"]){
		$edition_id=$_GET["edition_id"];
	}else{
		$edition_id=$qeditiondefault->row("edition_id");
	}
	
	$template_id = templateValidateID(uriParam("pgid",""));
	
	$qtemplate = cmsDB();
	$strSQL = "SELECT template_id, template_type, template_group, custom_charset, ttemplate.language_id, tlanguage.charset, isindex, ttemplate.display_name as tempDName,  tlanguage.display_name as langDName";
	$strSQL .= " FROM (ttemplate LEFT OUTER JOIN tlanguage ON ttemplate.language_id = tlanguage.language_id) WHERE template_id = '".$template_id."'";
	$qtemplate->query($strSQL);
	
	if ($qtemplate->recordCount() != 1) {
		jsAlert("Template doesn't exists!");
		die();
	}
	echo "test";die();
	$qtemplate->next();
	
	$strSQL = "SELECT article_uid, article_id, template_id, isindex, DATE_FORMAT(date_modified,'".$cms_article["date_format"]."') as mod_date, DATE_FORMAT(date_created,'".$cms_article["date_format"]."') as crea_date, ititle";
	$strSQL .= " FROM tarticle WHERE template_id = '".$riau_db->safeSQL($qtemplate->row("template_id"))."' and edition_id=".$edition_id." ORDER BY article_id, ititle";
	$riau_db->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title><?=$CMS_VARS["admin_title"]?> -  Article Manager for <?=htmlentities($qtemplate->row("template_id"))?>&nbsp;:&nbsp;<?=htmlentities($qtemplate->row("tempDName"))?></title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<? if ($qtemplate->row("charset") != "") { ?>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$qtemplate->row("charset")?>">
<? } else if ($riau_db->row("custom_charset") != "") { ?>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$qtemplate->row("custom_charset")?>">
<? } ?>
</head>

<body>
<table border="0" cellpadding="5" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="6" bgcolor="#000000" background="../images/depan.jpg"  height="25" valign="middle"><font color="#FFFFFF"><b>Article Manager for <?=htmlentities($qtemplate->row("template_id"))?>&nbsp;:&nbsp;<?=htmlentities($qtemplate->row("tempDName"))?></b></font></td>
	</tr>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td width="20" align="right"><b>No.</b></td>
		<td><b>Article ID</b></td>
		<td><b>Title</b></td>
		<td><b>Date Created</b></td>
		<td><b>Date Last Modified</b></td>
		<td align="center"><b>Index Article</b></td>
	</tr>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<? if ($riau_db->recordCount() == 0) { ?>
	<tr>
		<td colspan="6" align="center">No Article Available...</td>
	</tr>
	<form>
	<? } else { ?>
		<? while ($riau_db->next()) { ?>
			
				<tr>
					<td valign="top" align="right"><?=$riau_db->currentRow()?>.</td>
					<td valign="top"><a href="edit.php?edition_id=<?=$edition_id?>&pgid=<?=rawurlencode($riau_db->row("template_id"))?>&auid=<?=rawurlencode($riau_db->row("article_uid"))?>&seed=<?=mktime()?>"><?=htmlentities($riau_db->row("article_id"))?></a></td>
					<td valign="top"><?=htmlentities($riau_db->row("ititle"))?></td>
					<td valign="top"><?=htmlentities($riau_db->row("mod_date"))?></td>
					<td valign="top"><?=htmlentities($riau_db->row("crea_date"))?></td>
					<td valign="top" align="center"><input type="Radio" name="ISINDEX"<?=$riau_db->row("isindex")==1?" checked":""?> onClick="location='qupdateindex.php?pgid=<?=rawurlencode($riau_db->row("template_id"))?>&auid=<?=rawurlencode($riau_db->row("article_uid"))?>&edition_id=<?=$edition_id?>&seed=<?=mktime()?>'"></td>
				</tr>
			
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td colspan="6">
			<input type="button" class="button" value="Add" onClick="location='add.php?pgid=<?=$template_id?>&edition_id=<?=$edition_id?>&seed=<?=mktime()?>'"> 
			<input type="button" class="button" value="Remove Index" onClick="location='qupdateindex.php?pgid=<?=$template_id?>&edition_id=<?=$edition_id?>&auid=0&seed=<?=mktime()?>'">
			
		</td>
	</tr>
	</form>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
</table>
</body>
</html>
