<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<?
	require_once("../config.inc.php");
	$quser = cmsDB();
	$quser->query("SELECT * FROM tadmin WHERE admin_id <> ".$_COOKIE[$FJR_VARS["admin_cookie"]]);
	
	$SQL = "SELECT *, DATE_FORMAT(msg_datetime,'".$cms_article["datetime_format"]."') AS Msg_Date 
	        FROM tmessage
	        WHERE msg_id = ".uriParam("msgid");
	$mega_db->query($SQL);
	$mega_db->next();
?>

<body>

<table width="100%" border="0" cellpadding="2" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmreply" action="qsendmsg.php" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Reply Message</font></b></td>
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
			<table border="0" cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td colspan="2">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td valign="top" width="11%">Subject</td>
								<td width="2%">:</td>
								<td colspan="3"><input size="60" type="Text" name="SUBJECT" value="RE :<?=$mega_db->row("msg_subject");?>" maxlength="60"></td>
						    </tr>
							<tr>
								<td width="11%">To</td>
								<td width="2%" valign="top">:</td>
								<td width="5%"><input type="Radio" name="rdTO" value="1"></td>
							    <td colspan="2">All Users</td>
						    </tr>
							<tr>
							  <td>&nbsp;</td>
							  <td valign="top">:</td>
							  <td valign="top"><input type="Radio" name="rdTO" value="2" checked></td>
							  <td width="10%"><select size="5" multiple name="ULIST" style="width:150">
                                <?while ($quser->next()){?>
                                <option value="<?=$quser->row("admin_id")?>" <? if($mega_db->row("msg_sender_id") == $quser->row("admin_id")){ ?>selected<? } ?>>
                                <?=$quser->row("username")?>
                                <? } ?>
                              </select></td>
							  <td width="72%" valign="top"><input type="Checkbox" name="HIGHPRI" class="text">
High Priority</td>
						  </tr>
							<tr>
							  <td>Message</td>
							  <td colspan="4" valign="top">&nbsp;</td>
						  </tr>
							<tr>
							  <td colspan="5"><textarea rows="10" cols="60" name="MSGTEXT"><?=$mega_db->row("msg_text");?></textarea></td>
						  </tr>
						</table>
				  </td>
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
			<input type="submit" class="button" value="    Send    ">&nbsp;&nbsp;
			<input type="Button" class="button" value="    Cancel    " onClick="location='index.php?seed<?=mktime();?>'">
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
