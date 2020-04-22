<? 
	require_once("../config.inc.php");
	
	$strSQL = "SELECT COUNT(*) AS maxuser";
	$strSQL .= " FROM erecruitment.tbl_jobseeker";
	$mega_db->query($strSQL);
	
	$mega_db->next();
	$maxuser = $mega_db->row("maxuser");
	$page = is_numeric(uriParam("page",1))?uriParam("page",1):1;
	$maxrow = 50;
	$maxpage = floor($maxuser / $maxrow) + 1;
	if ($page < 1) $page = 1;
	if ($page > $maxpage) $page = $maxpage;
	$startrow = $maxrow * ($page - 1);
	
	$strSQL = "SELECT *";
	$strSQL .= " FROM erecruitment.tbl_jobseeker ORDER BY id_no LIMIT ".$startrow.",".$maxrow;
	$mega_db->query($strSQL);
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$FJR_VARS["admin_title"]?> -  Shared Template Part Manager</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css"></head>
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form>
	<tr>
		<td colspan="7" background="../images/depan.jpg"><b><font color="#FFFFFF">Member(s)
		      Employee Manager</font></b></td>
	</tr>
	<tr>
		<td colspan="7">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1"></td>
            </tr>
            </table>		</td>
	</tr>
	<tr>
		<td><b>No</b></td>
		<td><b>UserName</b></td>
		<td><b>ID KTP</b></td>
	  	<td><b>Tanggal Lahir</b></td>
		<td><b>email</b></td>
		<td><b>join date</b></td>
	</tr>
	<tr>
		<td colspan="7">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1" bgcolor="#000000"></td>
            </tr>
            </table>		</td>
	</tr>
	<? if ($mega_db->recordCount() == 0) { ?>
	<tr>
		<td colspan="7" align="center">No Member Pelamar Available...</td>
	</tr>
	<? } else { ?>
	<? 
		$i = $startrow;
		$qtrans = cmsDB();
		while ($mega_db->next()) { 
			$i++;
		$date1 = explode('-',$mega_db->row("date_of_birth"));
		$day1 = explode(" ",$date1[2]);
		$date_of_birth = $day1[0].'-'.$date1[1].'-'.$date1[0];
		
		$date2 = explode('-',$mega_db->row("join_date"));
		$day2 = explode(" ",$date2[2]);
		$join_date = $day2[0].'-'.$date2[1].'-'.$date2[0];
	
	?>
	<tr>
		<td valign="top" align="left"><?=$i?>.</td>
		<td valign="top"><a href="profile_edit.php?js_id=<?=rawurlencode($mega_db->row("js_id"))?>&seed=<?=mktime()?>"><?=trim($mega_db->row("user_name")) != "" ?htmlentities($mega_db->row("user_name")):"<font color=red>N/A</font>"?></a></td>
		<td valign="top"><?=$mega_db->row("id_no")?></td>
		<td valign="top"><?=$date_of_birth;?></td>
		<td valign="top"><a href="mailto:<?=$mega_db->row("email")?>"><?=htmlentities($mega_db->row("email"))?></a></td>
		<td valign="top"><?=$join_date;?></td>
	</tr>
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="7">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1" bgcolor="#000000"></td>
            </tr>
            </table>		</td>
	</tr>
	<tr>
		<td colspan="7">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td width="100%" height="1">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="100%" align="left">&nbsp;</td>
				</tr>
				</table>
                </td>
			</tr>
			</table>		</td>
	</tr>
	</form>
</table>
</body>
</html>