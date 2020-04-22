<? 
	require_once("../config.inc.php");
	
	$qeditiondefault = cmsDB();
	$strSQL = "select edition_id from tbl_editiondefault where default_site=1";
	$qeditiondefault->query($strSQL);
	$qeditiondefault->next();
	if (isset($_POST["seledition"])){
		$edition_id=$_POST["seledition"];
	}elseif(isset($_GET["edition_id"])){
		$edition_id=$_GET["edition_id"];
	}else{
		$edition_id=$qeditiondefault->row("edition_id");
	}
	
	$strSQL = "SELECT template_id,template_type,template_group,custom_charset,
	                  ttemplate.language_id,isindex, ttemplate.display_name as tempDName,
					  tlanguage.display_name as langDName
			   FROM ttemplate 
			   LEFT JOIN tlanguage ON ttemplate.language_id = tlanguage.language_id  
			   ORDER BY template_group, template_id";
	$mega_db->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title><?=$FJR_VARS["admin_title"]?> -  Template Manager</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body>
<table border="0" cellpadding="3" width="100%" bgcolor="#DEDEDE" cellspacing="0">
<form name="frmtemplate" action="index.php" method="post">
	<tr>
		<td colspan="5" background="../images/depan.jpg"><b><font color="#FFFFFF">Template Manager</font></b></td>
	</tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="100%" height="1"></td>
			</tr>
			</table>
            </td>
	</tr>
	<tr>
		<td width="20" align="left"><b>No.</b></td>
		<td><b>Group</b></td>
		<td><b>Template ID</b></td>
		<td><b>Display Name</b></td>
		<td align="center"><b>Index Page</b></td>
	</tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1" bgcolor="#000000"></td>
            </tr>
            </table>
            </td>
	</tr>
	<? if ($mega_db->recordCount() == 0) { ?>
	<tr>
		<td colspan="5" align="center">No Template Available...</td>
	</tr>
	<? } else { ?>
		<? while ($mega_db->next()) { ?>
			<tr>
					<td valign="top" align="left"><?=$mega_db->currentRow()?>.</td>
					<td valign="top"><?=htmlentities($mega_db->row("template_group"))?></td>
					<td valign="top"><a href="edit.php?edition_id=<?=$edition_id?>&pgid=<?=rawurlencode($mega_db->row("template_id"))?>&seed=<?=mktime()?>"><?=htmlentities($mega_db->row("template_id"))?></a></td>
					<td valign="top"><?=htmlentities($mega_db->row("tempDName"))?></td>
					<td valign="top" align="center"><input type="Radio" name="ISINDEX"<?=$mega_db->row("isindex")==1?" checked":""?> onClick="location='qupdateindex.php?pgid=<?=rawurlencode($mega_db->row("template_id"))?>&seed=<?=mktime()?>'"></td>
				</tr>
			
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1" bgcolor="#000000"></td>
            </tr>
            </table>
        </td>
	</tr>
	<tr>
		<td colspan="5"><input type="button" class="button" value="Add" onClick="location='add.php?seed=<?=mktime()?>'"></td>
	</tr>
</form>
</table>
</body>
</html>