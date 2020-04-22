<? 
	require_once("../config.inc.php");
	$SQL = "SELECT Msg.*, DATE_FORMAT(Msg.msg_datetime,'".$cms_article["datetime_format"]."') AS Msg_Date, U.username 
			FROM tmessage AS Msg, tadmin AS U
	        WHERE Msg.msg_sender_id = U.admin_id AND Msg.msg_id = ".uriParam("msgid");
	$mega_db->query($SQL);
	$mega_db->next();
	$touser = "";
	if($mega_db->row("msg_receiver_id") > 0) {
		$qto = cmsDB();
		$qto->query("SELECT U.username, Msg.msg_receiver_id 
		             FROM tadmin AS U, tmessage AS Msg 
					 WHERE U.admin_id = Msg.msg_receiver_id AND Msg.msg_id = ".uriParam("msgid"));
		while($qto->next()) {
			$touser .= $qto->row("username")."";
		}
		$qto->query("UPDATE tmessage SET isread = 1 WHERE msg_id = ".uriParam("msgid"));
?>
		<script>parent.nav.location.reload();</script>
<?
	} else
		$touser = "All Users";
?>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body>

<table border="0" cellpadding="4" width="70%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmedit" action="qedit.php" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Read Message</font></b></td>
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
					<td>Sent Date </td>
					<td>:</td>
					<td><b><?=$mega_db->row("Msg_Date");?></b></td>
				</tr>
				<tr>
					<td width="98">Sender From</td>
					<td width="4">:</td>
					<td width="280"><b><?=$mega_db->row("username");?></b></td>
				</tr>
				<tr>
					<td>Subject </td>
					<td>:</td>
					<td><b><?=$mega_db->row("msg_subject");?></b></td>
				</tr>
				<tr>
					<td>To </td>
					<td>:</td>
					<td><b>
					  <?=$touser;?>
					</b></td>
			  </tr>
				<tr>
					<td>High Priority</td>
					<td>:</td>
					<td><? if($mega_db->row("highpriority") == 1){ ?><img src="../images/checkinout.gif" width="20" height="22" border="0" alt="High Priority"><? }else echo "<b>normal</b>";?></td>
				</tr>
				<tr>
					<td colspan="3">Message</td>
			    </tr>
				<tr>
					<td colspan="3"><textarea rows="10" cols="60"><?=$mega_db->row("msg_text");?></textarea></td>
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
		<td>&nbsp;
			<input type="button" class="button" value="    Back    " onClick="location='index.php?seed=<?=mktime();?>'">&nbsp;&nbsp;
			<input type="Button" class="button" value="    Reply    " onClick="location='replymsg.php?msgid=<?=uriParam("msgid")?>&seed<?=mktime();?>'">&nbsp;&nbsp;
			<? if(($mega_db->row("msg_receiver_id") > 0 and $mega_db->row("msg_receiver_id") == $_COOKIE[$FJR_VARS["admin_cookie"]]) or ($mega_db->row("msg_receiver_id") == 0 and $mega_db->row("msg_sender_id") == $_COOKIE[$FJR_VARS["admin_cookie"]])){?>
				<input type="Button" class="button" value="    Delete    " onClick="location='qdelmsg.php?msgid=<?=uriParam("msgid")?>&seed<?=mktime();?>'">
			<? } ?>
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
	</form>
</table>
</body>
</html>