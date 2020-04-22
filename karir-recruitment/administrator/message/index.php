<? 
	require_once("../config.inc.php");
	/*
	echo $_COOKIE[$FJR_VARS["admin_cookie"]]; die();
	$SQL = "SELECT Msg.*, DATE_FORMAT(Msg.msg_datetime,'".$cms_article["datetime_format"]."') AS Msg_Date, U.username 
	        FROM tmessage AS Msg, tadmin AS U
	        WHERE Msg.msg_sender_id = U.admin_id 
			AND (Msg.msg_receiver_id = 0 
			OR Msg.msg_receiver_id = ".$_COOKIE[$FJR_VARS["admin_cookie"]].")
	        ORDER BY Msg.msg_datetime DESC";
	*/	
	
	//echo getAdminCookie(); die();
	$SQL = "SELECT Msg.*, DATE_FORMAT(Msg.msg_datetime,'".$cms_article["datetime_format"]."') AS Msg_Date, U.username 
	        FROM tmessage AS Msg, tadmin AS U
	        WHERE Msg.msg_sender_id = U.admin_id 
			AND (Msg.msg_receiver_id = 0 
			OR Msg.msg_receiver_id = ".getAdminCookie().")
	        ORDER BY Msg.msg_datetime DESC";	
	
	$mega_db->query($SQL);
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title><?=$FJR_VARS["admin_title"]?> -  Messages</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css"></head>

<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td width="3%" background="../images/depan.jpg"><strong><font color="#FFFFFF"><img src="../images/forums.gif" width="19" height="17"></font></strong></td>
        <td background="../images/depan.jpg"><strong><font color="#FFFFFF">Internal Mail</font></strong></td>
  </tr>
	<tr>
		<td colspan="2">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="right">&nbsp;</td>
		<td><img src="../images/_docs.gif" width="20" height="22" border="0" alt="High Priority"></td>
		<td><b>Sender</b></td>
		<td><b>Subject</b></td>
		<td><b>Date/Time</b></td>
	</tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<? if ($mega_db->recordCount() > 0) {?>
		<? while($mega_db->next()) { ?>
			<tr>
				<td align="right"><?=$mega_db->currentRow();?>.</td>
				<td><?if($mega_db->row("highpriority") == 1){?><img src="../images/checkinout.gif" width="20" height="22" border="0" alt="High Priority"><? } else echo "&nbsp;";?></td>
				<td><?=$mega_db->row("username");?></td>
				<td><a href="readmsg.php?msgid=<?=$mega_db->row("msg_id");?>" <? if ($mega_db->row("isread") == 1){?> style="color:#000000"<? } ?>> <?=substr($mega_db->row("msg_subject"),0,50);?> <? if(strlen($mega_db->row("msg_subject")) > 50) echo "...";?></a></td>
				<td><?=$mega_db->row("Msg_Date");?></td>
			</tr>
		<? } ?>
	<? } else {?>
	<tr>
	  <td colspan="5" align="center">No Messages...</td>
	</tr>
	<? } ?>
    </table>		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="button" class="button" value="Compose" onClick="location='sendmsg.php?seed=<?=mktime();?>'"></td>
	</tr>
	</form>
</table>
</body>
</html>
