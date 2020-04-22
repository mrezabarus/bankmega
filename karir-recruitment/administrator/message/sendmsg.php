<?
	require_once("../config.inc.php");
	$quser = cmsDB();
	$quser->query("SELECT * FROM tadmin WHERE admin_id <> ".$_COOKIE[$FJR_VARS["admin_cookie"]]);
	
	$SUBJECT = postParam("SUBJECT","");
	$rdTO = postParam("rdTO","1");
	$INPUSER = postParam("INPUSER","");
	$HIGHPRI = postParam("HIGHPRI","0");
	$MSGTEXT = postParam("MSGTEXT","0");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<script>
		function getUser(sel,inp){
			var arr = new Array();
			for(i=0;i<sel.options.length;i++){
				if(sel.options[i].selected)
					arr[arr.length] = sel.options[i].value;
			}
			inp.value = arr.length > 0 ? arr.join(",") : "";
		}
	</script>
</head>
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmreply" action="qsendmsg.php" method="post">
	<tr>
		<td background="../images/depan.jpg"><b><font color="#FFFFFF">Send Message</font></b></td>
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
			<table width="100%" border="0" cellpadding="2" cellspacing="0">
				<?
					if(isset($err)){
						echo "<tr><td colspan=\"2\" class=\"err\">";
						if($err == 1) echo "Subject Wajib Disi";
						if($err == 2) echo "Pilih User mana yg akan di kirim Messege";
						if($err == 3) echo "Message text wajib diisi";
						echo "</td></tr>";
						echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
					}
				?>
		  <tr>
					<td colspan="2">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td width="42" valign="top" <?if(isset($err) and $err == 2){?>class="err"<?}?>>Subject</td>
								<td width="4" valign="top">:</td>
								<td colspan="3"><input size="50" type="Text" name="SUBJECT" value="<?=$SUBJECT;?>" maxlength="60"></td>
							</tr>
							<tr>
								<td>To</td>
								<td>:</td>
								<td width="20" valign="top"><input type="Radio" name="rdTO" value="1" <? if($rdTO == 1){?>checked<? } ?>></td>
								<td colspan="2">All Users</td>
						    </tr>
							<tr>
							  <td colspan="2">&nbsp;</td>
							  <td valign="top"><input type="Radio" name="rdTO" value="2" <? if($rdTO == 2){ ?>checked<? } ?>></td>
							  <td width="80"><?
										$arrU = array();
										if(strlen(trim($INPUSER))){
											foreach(split(",",$INPUSER) as $UID){
												$arrU[$UID] = array();
											}
										}
									?>
                                <select size="5" multiple name="ULIST" style="width:150" onChange="getUser(this,INPUSER)">
                                  <? while ($quser->next()){?>
                                  <option value="<?=$quser->row("admin_id")?>" <? if(array_key_exists($quser->row("admin_id"),$arrU)){ ?>selected<? } ?>>
                                    <?=$quser->row("username")?>
                                  <? } ?>
                                  </select>
                                <input type="HIDDEN" name="INPUSER" value="<?=$INPUSER;?>"></td>
						      <td width="233" valign="top"><input type="Checkbox" name="HIGHPRI" value="1" class="text" <? if($HIGHPRI == 1){ ?>checked<? } ?>>
High Priority</td>
						  </tr>
							<tr>
							  <td colspan="2" <? if(isset($err) and $err == 3){ ?>class="err"<? } ?>>Message</td>
							  <td colspan="3">:</td>
						  </tr>
							<tr>
							  <td colspan="5"><textarea rows="10" cols="60" name="MSGTEXT"></textarea></td>
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
