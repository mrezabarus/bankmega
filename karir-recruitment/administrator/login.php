<? 
	session_start();
	require_once("config.inc.php");
	
	/*
	setcookie($FJR_VARS["admin_cookie"], "", time() - 3600);
	setcookie("group_auth", "", time() - 3600);
	setcookie("template_auth", "", time() - 3600);
	setcookie("module_auth", "", time() - 3600);
	*/
	
	/*
	$_SESSION[$FJR_VARS["admin_cookie"]]="";
	$_SESSION["group_auth"]="";
	$_SESSION["template_auth"]="";
	$_SESSION["issuperadmin"]="";
	$_SESSION["module_auth"]="";
	*/
	
	$err = uriParam("err",0);
	$tries = uriParam("tries",0);
	$ref = uriParam("ref","index.php?seed=".md5(date('m/d/y,h:m:s')));
	$max_tries = 3;
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title><?=$FJR_VARS["admin_title"]?> - Administrator Login</title>
<link rel="stylesheet" type="text/css" href="css/admin.css">
<link rel="shortcut icon" href="images/fav.ico" />
<script language="javascript" type="text/javascript">
	function setFocus() {
		document.frmlogin.usrname.select();
		document.frmlogin.usrname.focus();
	}
</script>
</head>
<body onLoad="document.frmlogin.ADMINID.focus()">
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="80%">
  <tr>
    <td width="100%" align="center">
      <table border="0" cellpadding="0" cellspacing="0" width="400">
        <tr>
          <td class="login" bgcolor="#808080" align="left" valign="top">
            <table border="0" cellpadding="0" width="100%" height="132">
              <tr>
                <td class="login" bgcolor="#FFFFFF" height="130" align="center">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="loginlogo" colspan="3" align="left"><img src="images/logo-mega.png" alt="Login" /><br /><br /><br /></td>
                    </tr>
                  </table>
				  <table border="0" cellpadding="2" cellspacing="0">
                <form action="qlogin.php" method="post" name="frmlogin">
                <input type="Hidden" name="REF" value="<?=htmlentities($ref)?>">
                <input type="Hidden" name="TRIES" value="<?=htmlentities($tries)?>">
                    <? if ($err > 0) { ?>
                    <tr class="login">
                      <td colspan="2">&nbsp;</td>
                      <td><b><font color="#FF0000">
                					<? if ($err == 1) { ?>
                					nama user Tidak ada!<br />
                					<? } elseif ($err == 2) { ?>
                					Password Salah, Coba lagi... <br />
                					<? } elseif ($err == 4) { session_destroy(); ?>
                					Terima Kasih...<? } ?>
                      </font></b></td>
                    </tr>
				<? } ?>
				<? if ($tries < $max_tries) { ?>
                    <tr class="login">
                      <td><b>Username</b></td>
                      <td>:</td>
                      <td><input type="text" autocomplete="off" name="ADMINID" size="20" class="text"></td>
                    </tr>
                    <tr>
                      <td><b>Password</b></td>
                      <td>:</td>
                      <td><input type="password" autocomplete="off" name="ADMINPWD" size="20" class="text"></td>
                    </tr>
                    <tr>
                      <td colspan="2"></td>
                      <td><input type="submit" value="Submit" class="button"></td>
                    </tr>
										<? } else { ?>
										<tr>
											<td colspan="3" align="center"><a href="login.php?ref=<?=md5(date('m/d/y,h:m:s'))?>"><b><font color="#FF0000"><?=$max_tries?>x
											        Kesalahan... Klik disini
											        untuk Reload....</font></b></a></td>
										</tr>
										<? } ?>
										</form>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
