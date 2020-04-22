<? 
	require_once("../config.inc.php");
	
	$qlang = cmsDB();
	$qgroup = cmsDB();
	$qedition = cmsDB();

	$template_id = templateValidateID(uriParam("pgid",""));
	
	$strSQL = "SELECT template_id,template_type,template_group,custom_charset,
	                  ttemplate.language_id, tlanguage.charset, isindex,
					  ttemplate.display_name as tempDName,tlanguage.display_name as langDName,
					  edition_id 
			   FROM ttemplate 
			   LEFT JOIN tlanguage ON ttemplate.language_id = tlanguage.language_id 
			   WHERE template_id = '".$template_id."'";
	$mega_db->query($strSQL);
	
	if ($mega_db->recordCount() == 0) 
		jsAlertAndNavigate("Record doesn't exists","index.php?seed=".mktime());
	
	$strSQL = "SELECT * from tlanguage";
	$qlang->query($strSQL);
	$strSQL = "SELECT DISTINCT template_group 
	           FROM ttemplate 
			   WHERE template_group <> ''";
	$qgroup->query($strSQL);
	
	$mega_db->next();
	
	$fd = @fopen(templateFullPath($mega_db->row("template_id")), "r");
	$fcontent = @fread($fd, filesize(templateFullPath($mega_db->row("template_id"))));
	@fclose($fd);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Template Manager - Edit Template</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<? if ($mega_db->row("charset") != "") { ?>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$mega_db->row("charset")?>">
	<? } else if ($mega_db->row("custom_charset") != "") { ?>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$mega_db->row("custom_charset")?>">
	<? } ?>
	<SCRIPT LANGUAGE="JavaScript" SRC="../js/misc.js" TYPE="text/javascript"></SCRIPT>
	<script>
	function _editor(){
  		window.open('editor/editor.php?function=edit&pgid=<?=$template_id?>&refresh=<?=urlencode(date("m d y h i s"))?>','frmeditor','width=800,height=600,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
		void null;
  }
	</script>
</head>

<body>
<table border="0" cellpadding="4" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmEdit" action="qedit.php" method="post">
	<input type="hidden" name="PGID" value="<?=htmlentities($template_id)?>">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Template Manager - Edit Template</font></b></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="0">
				<tr>
					<td>Template ID</td>
					<td>:</td>
					<td><?=htmlentities($mega_db->row("template_id"))?></td>
					<td>&nbsp;</td>
				  <td>
					<select name="seledition">
					<?
						$strSQL = "select * from tbl_editiondefault";
						$qedition->query($strSQL);
						while ($qedition->next()) {
							echo "<option value='".htmlentities($qedition->row("edition_id"))."'";
							if(htmlentities($qedition->row("edition_id"))==$mega_db->row("edition_id")){
								echo "selected";
							}
							echo " >".htmlentities($qedition->row("edition_name"))."</option>";
						}
					?>
					</select>					</td>
				</tr>
				<tr>
					<td>Index Page</td>
					<td>:</td>
					<td colspan="3"><?=$mega_db->row("isindex") == "0"?"No":"Yes"?></td>
				</tr>
				<tr>
					<td>Template Type</td>
					<td>:</td>
					<td colspan="3"><select name="TYPE" class="select">
						<? foreach ($cms_template["type"] as $el) { ?>
						<option value="<?=$el["value"]?>" <?=$mega_db->row("template_type") == $el["value"]?"selected":""?>><?=htmlentities($el["name"])?>
						<? } ?></select></td>
				</tr>
				<tr>
					<td>Display Name</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="DNAME" size="20" maxlength="255" value="<?=htmlentities($mega_db->row("tempDName"))?>" class="text"></td>
				</tr>
				<tr>
					<td>Description</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="DESC" size="20" maxlength="255" value="<?=htmlentities($mega_db->row("description"))?>" class="text"></td>
				</tr>
				<tr>
					<td>New Group</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="NEWGROUP" size="20" maxlength="255" class="text"></td>
				</tr>
				<tr>
					<td>Grou</td>
					<td>:</td>
					<td><select name="GROUP" class="select">
                      <option value="" <?=strtolower(trim($qgroup->row("template_group"))) == ""?"selected":""?>>New
                      Group
                        <? while ($qgroup->next()) { ?>
                      <option value="<?=htmlentities($qgroup->row("template_group"))?>" <?=strtolower(trim($qgroup->row("template_group"))) == strtolower(trim($mega_db->row("template_group")))?"selected":""?>>
                        <?=htmlentities($qgroup->row("template_group"))?>
                      <? } ?>
                  </select></td>
					<td colspan="2"><input type="hidden" name="CCHARSET" size="20" maxlength="255" value="<?=htmlentities($mega_db->row("custom_charset"))?>" class="text"></td>
				</tr>
				<tr>
					<td colspan="5">Template Content :
					&nbsp;&nbsp;&nbsp;<a href="javascript:_editor('ISUMMARY')">[ Wysiwyg Editor ]</a>					</td>
				</tr>
				<tr>
					<td colspan="5"><textarea name="CONTENT" wrap="off" cols="66" rows="30" class="textarea"><?=htmlentities($fcontent)?></textarea></td>
				</tr>
			</table>
	  </td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1" bgcolor="#000000"></td>
            </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
			<input type="submit" class="button" value="Update"> 
			<input type="button" class="button" value="Preview" onClick="winOpen('<?=$FJR_VARS["www_url"]?>index.php?pgid=<?=$template_id?>','previewwin',screen.width-50,screen.height-50,'toolbar=0,scrollbars=1,resizable=1')"> 
			<input type="button" class="button" value="Delete" onClick="if (confirm('Are you sure you want to delete this Template?')) location='qdelete.php?pgid=<?=$template_id?>&seed=<?=mktime()?>';"> 
			<input type="Button" class="button" value="Publish"> 
			<input type="button" class="button" value="Back" onClick="location='index.php?edition_id=<?=$_GET["edition_id"]?>&seed=<?=mktime()?>'"></td>
	</tr>
	</form>
</table>
</body>
</html>
