<?
	require_once("../../config.php");
	if(isset($_POST["save"])){
			//echo ." + save + " . ;die();
			$comp_name=cmsDB();
			$strsql = "insert into tbl_region_mpp(year_date,budget,hacc_val_apply,hacc_val_approve,region_id,user_id,insert_date) values('".postParam("txtyear")."','".postParam("txtbudget")."',0,0,'".postParam("selregion")."',".$_SESSION["user_id" . date("mdY")].",'".date("Y-m-d H:i:s")."')";
			$comp_name->query($strsql);
			header("Location: index.php"); 	
			die();
			//echo $strsql;die();
	}
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<SCRIPT language=JavaScript src="<?=$ANOM_VARS["www_js_url"]?>js_button.js" type=text/javascript></SCRIPT>
<SCRIPT language=JavaScript src="<?=$ANOM_VARS["www_js_url"]?>jswarehouse.js" type=text/javascript></SCRIPT>
<br />
<center>
	 <form action="" method="post" name="sample_form" id="sample_form">
<TABLE class=heading2 cellSpacing=0 cellPadding="2" width="50%" align=center border=0>
                     
                     <TR>
                       <TD class=tableheader>
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                           
                           <TR>
                            <TD class=tableheader>&nbsp;Man Power Planing - New </TD>
                           </TR>
			
			</TABLE>
		</TD>
	  </TR>
                     <TR>
                       <TD>
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                           
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></TD></TR>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></TD></TR>
			
		  </TABLE>
		</TD>
	</TR>
	 <tr><td colspan="3">
			<table width="100%" cellpadding="2" cellspacing="0" border="0">
                <tr>
					<td width="26%" align="right"><b>Year</b></td>
					<td width="1%" align="right"><b>:</b></td>
					<td width="73%"><input type="Text" name="txtyear" width="5" maxlength="4" value=""></td>
				</tr>
				<tr>
					<td align="right"><b>Region</b></td>
					<td align="right"><b>:</b></td>
					<td>
					<?
						$region=cmsDB();
						$region->query("select * from tbl_region");
					?>
					<select name="selregion">
						<?
							while($region->next()){
								echo "<option value=\"".$region->row("region_id")."\">".$region->row("region_name")."</option>";
							}
						?>
					</select></td>
				</tr>
				<tr>
					<td align="right"><b>Budget</b></td>
					<td align="right"><b>:</b></td>
				  <td><input type="Text" name="txtbudget" maxlength="255" value="0"></td>
				</tr>
				
				<TR>
                       <TD colspan="3">
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                           
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></TD></TR>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></TD></TR></TABLE></TD></TR>
                     <TR>
				<tr>
					<td colspan="3"align="right">
					<input type="button" value="Save" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.txtyear,sample_form.txtbudget,sample_form.selregion','save=yes&refresh=<?=md5("mdYHis")?>')">
					&nbsp;<input type="Button" value="Cancel" onclick="get_method('templates/mpp/index.php')"></td>
				</tr>			
			</table>
		</td></tr>
</table>
</form>
</center>