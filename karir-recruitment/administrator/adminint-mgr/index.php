<?
	require_once("../config.inc.php");
	$mega_db = cmsDB2();
	$mega_db->query("SELECT * FROM tbl_hrm_user_new ORDER BY rgb_id DESC, user_name ASC");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#DEDEDE">
	<tr>
		<td colspan="3" background="../images/depan.jpg"><b><font color="#FFFFFF">Internal HRM User</font></b></td>
  </tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>            </td>
	</tr>
	<tr>
		<td width="8%" align="left"><b>No.</b></td>
	  <td width="58%"><b>User Name</b></td>
	  <td><b>Right & Permission</b></td>
	</tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>            </td>
	</tr>
	<? if($mega_db->recordCount() == 0){ ?>
	<tr>
		<td colspan="3" align="center">No member Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<? while($mega_db->next()){ ?>
			<tr>
				<td align="left"><?=$mega_db->currentRow();?>.</td>
			  <td><a href="edit.php?aid=<?=$mega_db->row("user_id");?>"><?=$mega_db->row("user_name");?></a></td>
			  <td width="34%"><? if($mega_db->row("rgb_id") == "1") echo "Super Administrator";?></td>
			</tr>
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>            </td>
	</tr>
	<tr>
		<td colspan="3"><input type="button" class="button" value="    Add User    " onClick="location='add.php?seed=<?=mktime()?>'"></td>
	</tr>
	</form>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>            </td>
	</tr>
</table>
</body>
</html>
