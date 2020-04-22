<? 
	require_once("../config.inc.php");
	
	$qlang = cmsDB();
	$qgroup = cmsDB();
	$qedition = cmsDB();
	
	$strSQL = "SELECT * from tlanguage";
	$qlang->query($strSQL);
	$strSQL = "SELECT DISTINCT template_group 
	           FROM ttemplate 
			   WHERE template_group <> ''";
	$qgroup->query($strSQL);
	
	$template_id = trim(postParam("PGID",""));
	$template_type = trim(postParam("TYPE",""));
	$display_name = trim(postParam("DNAME",""));
	$description = trim(postParam("DESC",""));
	$template_group = trim(postParam("GROUP","")) == ""?"":trim(postParam("GROUP",""));
	$template_newgroup = trim(postParam("NEWGROUP","")) == ""?"":trim(postParam("NEWGROUP",""));
	$language_id = postParam("LANGID","")?postParam("LANGID",""):0;
	$custom_charset = trim(postParam("CCHARSET",""));
	$fcontent = postParam("CONTENT","");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$FJR_VARS["admin_title"]?> - Template Manager - Add Template</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<SCRIPT LANGUAGE="JavaScript" SRC="../js/taeditor.js" TYPE="text/javascript"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
  	var oContent;
		function editorInit() {
			oContent = new taEditor(document,document.frmAdd.CONTENT);
		}
  //-->
 
  function _editor(){
  		window.open('editor/editor.php?refresh=<?=urlencode(date("m d y h i s"))?>','frmeditor','width=800,height=600,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
		void null;
  }
  </script>
</head>

<body onLoad="editorInit()">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmAdd" action="qadd.php" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Template Manager - Add Template</font></b></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1"></td>
            </tr>
          </table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="2" cellspacing="0">
				<tr>
					<td>Template ID</td>
					<td>:</td>
					<td><input type="text" name="PGID" size="20" maxlength="255" class="text" value="<?=htmlentities($template_id)?>">
					  <!--select name="seledition">
					<?
						$strSQL = "select * from tbl_editiondefault";
						$qedition->query($strSQL);
						while ($qedition->next()) {
							echo "<option value='".htmlentities($qedition->row("edition_id"))."'>".htmlentities($qedition->row("edition_name"))."</option>";
						}
					?>
					</select-->                    </td>
					</tr>
				<tr>
					<td>Template Type</td>
					<td>:</td>
					<td><select name="TYPE" class="select">
						<? foreach ($cms_template["type"] as $el) { ?>
							<option value="<?=$el["value"]?>" <?=$template_type==$el["value"]?"selected":""?>><?=htmlentities($el["name"])?>
						<? } ?>
					</select></td>
				</tr>
				<tr>
					<td>Display Name</td>
					<td>:</td>
					<td><input type="text" name="DNAME" size="20" maxlength="255" class="text" value="<?=htmlentities($display_name)?>"></td>
				</tr>
				<tr>
					<td>Description</td>
					<td>:</td>
					<td><input type="text" name="DESC" size="20" maxlength="255" class="text" value="<?=htmlentities($description)?>"></td>
				</tr>
				<tr>
					<td>New Group</td>
					<td>:</td>
					<td><input type="text" name="NEWGROUP" size="20" maxlength="255" class="text" value="<?=htmlentities($template_newgroup)?>"></td>
			    </tr>
				<tr>
					<td>Group</td>
				    <td>:</td>
			      <td><select name="GROUP" class="select">
                    <option value="">New Group
                      <? while ($qgroup->next()) { ?>
                    <option value="<?=htmlentities($qgroup->row("template_group"))?>" <?=strtolower($qgroup->row("template_group")) == strtolower($template_group)?"selected":""?>>
                      <?=htmlentities($qgroup->row("template_group"))?>
                    <? } ?>
                  </select></td>
			    </tr>
				<tr>
					<td colspan="3">Template Content :
					&nbsp;&nbsp;&nbsp;<a href="javascript:_editor('ISUMMARY')">[ Wysiwyg Editor ]</a>					<input type="hidden" name="CCHARSET" size="20" maxlength="255" value="<?=htmlentities($custom_charset)?>" class="text"></td>
				</tr>
				<tr>
					<td colspan="3"><textarea name="CONTENT" cols="66" rows="30" class="textarea" wrap="off"><?=htmlentities($fcontent)?></textarea></td>
				</tr>
			</table>
	  </td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1"></td>
            </tr>
          </table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<input type="submit" class="button" value="Save"> <input type="button" class="button" value="  Cancel  " onClick="location='index.php?seed=<?=mktime()?>'"></td>
	</tr>
  </form>
</table>
</body>
</html>
