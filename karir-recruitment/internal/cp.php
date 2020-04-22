<?
		require_once("config.php");
		
//		session_unregister("ss_id" . date("mdY"));
//		session_unregister("user_id" . date("mdY"));
//		session_unregister("user_name" . date("mdY"));
//		session_unregister("full_name" . date("mdY"));
//		session_unregister("ssbranch_id" . date("mdY"));

	$userpw = cmsDB();
	$userpw->query("SELECT * FROM tbl_hrm_user_serper WHERE user_id = ".$_SESSION["user_id" . date("mdY")]."");
	$userpw->next();
	$user_name = $userpw->row("user_name");
	$full_name = $userpw->row("full_name");
	$PWD = postParam("PWD",$userpw->row("pwd"));

	$userpw=cmsDB();
	$userpw->query("UPDATE tbl_hrm_user SET
	                pwd='".postParam("PWD",$userpw->row("pwd"))."'
					WHERE user_id = ".$_SESSION["user_id" . date("mdY")]."");
	$userpw->next();
?>
<form method="post" name="sample_form" action="<?=$_SERVER["SCRIPT_NAME"]?>?save=yes" enctype="multipart/form-data">
    <table align="center" width="0" border="0" cellspacing="0" cellpadding="2">
				<?
					if(isset($err)){
					echo "<tr><td class=\"errtxt\">";
						echo "Error when add Member !!<br />";
						if($err == 1) echo "User Name is Required";
						if($err == 2) echo "Password is Required";
						if($err == 3) echo "Please Re-Type The Password";
						if($err == 4) echo "Password is not match with Re-Type Password";
						if($err == 5) echo "User Name has Existed";
					echo "</td></tr>";
					echo "<tr><td>&nbsp;</td></tr>";
					}
				?>
      <tr>
        <td colspan="5">Kolom Ganti Password</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Nama User</td>
        <td>:</td>
        <td colspan="3"><b><?=$user_name;?></b></td>
      </tr>
      <tr>
        <td>Nama Lengkap</td>
        <td>:</td>
        <td colspan="3"><?=$full_name;?></td>
      </tr>
      <tr>
        <td <? if(isset($err) and ($err == 2 or $err == 4)){ ?>class="errtxt"<? } ?>>Password</td>
        <td <? if(isset($err) and ($err == 2 or $err == 4)){ ?>class="errtxt"<? } ?>>:</td>
        <td><input type="password" name="PWD" size="20" maxlength="50" class="text" value="<?=$PWD;?>"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td <? if(isset($err) and $err == 3){ ?>class="errtxt"<? } ?>>Retype Password</td>
        <td <? if(isset($err) and $err == 3){ ?>class="errtxt"<? } ?>>:</td>
        <td colspan="3"><input type="password" name="CONFPWD" size="20" maxlength="50" class="text" value="<?=$PWD;?>"></td>
      </tr>
      <tr>
        <td <? if(isset($err) and $err == 3){ ?>class="errtxt"<? } ?>>&nbsp;</td>
        <td <? if(isset($err) and $err == 3){ ?>class="errtxt"<? } ?>>&nbsp;</td>
        <td colspan="3"><input type="submit" class="button" value="Update"></td>
      </tr>
    </table>
    </form>
