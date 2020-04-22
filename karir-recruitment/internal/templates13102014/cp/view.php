<?
	require_once("../../config.php");

	$cp = cmsDB();
	$cp->query("SELECT * FROM tbl_hrm_user_new WHERE user_id = ".$_SESSION["user_id" . date("mdY")]."");
	$cp->next();
	$user_name = $cp->row("user_name");
	$full_name = $cp->row("full_name");
	$PWD = postParam("PWD",$cp->row("pwd"));
	//$PWD = base64_encode(base64_encode($PWD));

	    function createSalt()
	    {
			$text = md5(uniqid(rand(), true));
			return substr($text, 0, 3);
	    }
	     
	    $salt = createSalt();
	    $newpwd = hash('sha256', $salt . $PWD);

	if(isset($_POST["save"])){
	/*
			$strsql = "UPDATE tbl_hrm_user SET
			           pwd='".$newpwd."', salt='".$salt."' 
					   WHERE user_id = ".$_SESSION["user_id" . date("mdY")].""; */
			$strsql = "UPDATE tbl_hrm_user_new SET
			           pwd='".$newpwd."', salt='".$salt."' 
					   WHERE user_name = '".$user_name."'";
			$cp->query($strsql);
			header("Location: index.php"); 	
			die();
			//echo $strsql;die();
	}
?>
<BR>
<center>
	 <form action="" method="post" name="sample_form" id="sample_form">
<TABLE class=heading2 cellSpacing=0 cellPadding="2" align=center border=0>
<TR>
                       <TD class=tableheader>
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TR>
                            <TD class=tableheader>&nbsp;<b>Change Password</b></TD>
                           </TR></TABLE>
		</TD>
	  </TR>
                     <TR>
                       <TD>
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></TD></TR>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></TD></TR></TABLE>
		</TD>
	</TR>
	 <tr><td colspan="3">
			<table cellpadding="2" cellspacing="0" border="0">
				
<tr>
					<td align="right"><b>Full name</b></td>
					<td><b>:</b></td>
			  <td><?=$full_name;?></td>
			  </tr>
				<tr>
					<td align="right"><b>User ID</b></td>
					<td><b>:</b></td>
					<td><b><?=$user_name;?></b></td>
			  </tr>
				<tr>
					<td align="right"><b>Password</b></td>
				  <td><b>:</b></td>
				  <td><input type="password" name="PWD" size="30" value="<?=$PWD;?>"></td>
				</tr>
				<tr>
					<td align="right"><b>Retype Password</b></td>
				  <td><b>:</b></td>
					<td><input type="password" name="CONFPWD" size="30" value="<?=$PWD;?>"></td>
				</tr>
				<TR>
                       <TD colspan="3">
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></TD></TR>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></TD></TR></TBODY></TABLE></TD></TR>
                     <TR>
				<tr>
					<td colspan="3"align="center">
						<input type="button" value="Update" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.PWD,sample_form.CONFPWD','save=yes&user_id=<?=uriParam("user_id")?>&refresh=<?=md5("mdYHis")?>')"></td>
				</tr>			
			</table>
		</td></tr></table>
</form>
</center>