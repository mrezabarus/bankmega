<? 
	require_once("../config.inc.php");
	
	$strSQL = "select * from tbl_menu order by menu_id asc";
	$mega_db->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$FJR_VARS["admin_title"]?> -  DHTML Menu Manager</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<form name="frmtemplate" action="index.php" method="post">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
	<td colspan="3" background="../images/depan.jpg"><b><font color="#FFFFFF">Menu Manager</font></b></td>
	</tr>
	<tr>
		<td colspan="6">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="100%" height="1"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left"><b>Menu ID</b></td>
	  <td><b>Menu Name</b></td>
		
	</tr>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<? if ($mega_db->recordCount() == 0) { ?>
	<tr>
		<td colspan="6" align="center">No Menu Available...</td>
	</tr>
	<? } else { ?>
		<? while ($mega_db->next()) { ?>
			<tr>
					<td valign="top" align="left"><?=$mega_db->row("menu_id")?>.</td>
			  <td valign="top"><a href="authorization.php?menu_id=<?=rawurlencode($mega_db->row("menu_id"))?>&seed=<?=md5(date('m/d/y,h:m:s'))?>"><?=htmlentities($mega_db->row("menu_title"))?></a></td>
			</tr>
			
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td colspan="6"><input type="button" class="button" value="    Add    " onClick="location='authorization.php?seed=<?=md5(date('m/d/y,h:m:s'))?>'"></td>
	</tr>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1"></td>
            </tr>
            </table>
		</td>
	</tr>
</table>
</form>
</body>
</html>