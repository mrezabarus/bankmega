<? 
	require_once("../config.inc.php");
	
	$strSQL = "select * from tadvertisement";
	$mega_db->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$FJR_VARS["admin_title"]?> -  Banner Manager</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<form name="frmtemplate" action="index.php" method="post">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="4" background="../images/depan.jpg"><b><font color="#FFFFFF">Banner Manager</font></b></td>
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
		<td colspan="4">
        <table border="0" cellpadding="0" cellspacing="2" width="100%">
          <tr>
            <td><b>ID</b></td>
            <td><b>Banner Name</b></td>
            <td><b>Banner</b></td>
            <td><b>Link</b></td>
          </tr>
          <tr>
            <td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>            </td>
          </tr>
	<? if ($mega_db->recordCount() == 0) { ?>
          <tr>
            <td colspan="4" align="center">No Banner Available...</td>
          </tr>
	<? } else { ?>
		<? while ($mega_db->next()) { ?>
          <tr>
            <td><?=$mega_db->row("ad_id")?></td>
            <td><a href="edit.php?ad_id=<?=rawurlencode($mega_db->row("ad_id"))?>&seed=<?=md5(date('m/d/y,h:m:s'))?>">
              <?=htmlentities($mega_db->row("ad_name"))?>
            </a></td>
            <td><img src='<?=$FJR_VARS["admin_url"]?>images/banner/<?=htmlentities($mega_db->row("ad_banner"))?>'></td>
            <td><?=htmlentities($mega_db->row("ad_link"))?></td>
          </tr>
		<? }
		} ?>
          <tr>
            <td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
            </td>
          </tr>
        </table></td>
	</tr>
	<tr>
		<td colspan="4"><input type="button" class="button" value="Add" onClick="location='add.php?seed=<?=md5(date('m/d/y,h:m:s'))?>'"></td>
	</tr>
</table>
</form>
</body>
</html>
