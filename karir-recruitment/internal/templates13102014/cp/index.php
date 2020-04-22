<?
	require_once("../../config.php");

	$cp = cmsDB();
	$cp->query("SELECT * FROM tbl_hrm_user_new WHERE user_id = '".$_SESSION["user_id" . date("mdY")]."'");
	$cp->next();
	$user_name = $cp->row("user_name");
	$full_name = $cp->row("full_name");
	$PWD = postParam("PWD",$cp->row("pwd"));
	
	/*
	if(isset($_POST["save"])){

			$strsql = "UPDATE tbl_hrm_user SET
			           pwd='".postParam("PWD",$cp->row("pwd"))."' 
					   WHERE user_id = ".$_SESSION["user_id" . date("mdY")]."";
			
			$cp->query($strsql);
			header("Location: index.php"); 	
			die();

	} 
	*/
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
				  <td><input type="password" name="PWD" size="30" disabled></td>
				</tr>
				<tr>
					<td align="right"><b>Retype Password</b></td>
				  <td><b>:</b></td>
					<td><input type="password" name="CONFPWD" size="30" disabled></td>
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
					<?if(listFind($_SESSION["ss_id" . date("mdY")],"42")){?>
						&nbsp;<input type="Button" value="Edit" onclick="get_method('templates/cp/view.php?user_id=<?=$cp->row("user_id")?>')">
					<?}?>
</td>
				</tr>			
			</table>
		</td></tr></table>
</form>
</center>