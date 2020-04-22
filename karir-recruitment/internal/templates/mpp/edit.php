<?
	require_once("../../config.php");
	$comp_name=cmsDB();
	if(isset($_POST["save"])){
			$strsql = "UPDATE tbl_region_mpp SET year_date='".postParam("txtyear")."',budget='".postParam("txtbudget")."',
			                  region_id='".postParam("selregion")."',user_id=".$_SESSION["user_id" . date("mdY")].",
							  insert_date='".date("Y-m-d H:i:s")."' 
					   WHERE hacc_id=".$_POST["hacc_id"];
			$comp_name->query($strsql);
			header("Location: index.php"); 	
			die();
			//echo $strsql;die();
	}
	$strsql = "select tbl_region_mpp.*,tbl_region.region_name,tbl_hrm_user.full_name 
	  			from tbl_region_mpp 
				inner join tbl_region on tbl_region_mpp.region_id=tbl_region.region_id 
				inner join tbl_hrm_user on tbl_region_mpp.user_id=tbl_hrm_user.user_id 
				where tbl_region_mpp.hacc_id=".$_GET["hacc_id"];
	$comp_name->query($strsql);
	$comp_name->next();
?>
<br />
<center>
<form action="" method="post" name="sample_form" id="sample_form">
<TABLE class=heading2 cellSpacing=0 cellPadding=4 width="50%" align=center border=0>
                     
                     <TR>
                       <TD class=tableheader>
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                           
                           <TR>
                            <TD class=tableheader>&nbsp;Man Power Planing - Edit </TD>
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
					<td width="33%" align="right"><b>Year</b></td>
					<td width="1%" align="right"><b>:</b></td>
					<td width="66%"><input type="Text" name="txtyear" width="5" maxlength="4" value="<?=$comp_name->row("year_date")?>"></td>
				</tr>
				<tr>
					<td width="33%" align="right"><b>Region</b></td>
					<td width="1%" align="right"><b>:</b></td>
					<td>
					<?
						$region=cmsDB();
						$region->query("select * from tbl_region");
					?>
					<select name="selregion">
						<?
							while($region->next()){
								echo "<option value=\"".$region->row("region_id")."\"";
								if($region->row("region_id")==$comp_name->row("region_id")){
									echo " selected";
								}
								echo ">".$region->row("region_name")."</option>";
							}
						?>
					</select>					</td>
				</tr>
				<tr>
					<td width="33%" align="right"><b>Man Power Apply</b></td>
					<td width="1%" align="right"><b>:</b></td>
					<td><?=$comp_name->row("hacc_val_apply")?></td>
				</tr>
				<tr>
					<td width="33%" align="right"><b>Man Power Approved</b></td>
					<td width="1%" align="right"><b>:</b></td>
					<td><?=$comp_name->row("hacc_val_approve")?></td>
				</tr>
				<tr>
					<td width="33%" align="right"><strong>Budget</strong></td>
				  <td width="1%" align="right"><b>:</b></td>
					<td><input type="Text" name="txtbudget" maxlength="255" value="<?=number_format($comp_name->row("budget"),0, '.', ',')?>"></td>
				</tr>
				<tr>
					<td width="33%" align="right"><b>Insert by</b></td>
					<td width="1%" align="right"><b>:</b></td>
					<td><?=$comp_name->row("full_name")?></td>
				</tr>
				<tr>
					<td width="33%" align="right"><b>Insert Date</b></td>
					<td width="1%" align="right"><b>:</b></td>
					<td><?=$comp_name->row("insert_date")?></td>
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
					<input type="button" value="Update" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.txtyear,sample_form.txtbudget,sample_form.selregion','hacc_id=<?=$comp_name->row("hacc_id")?>&save=yes&refresh=<?=md5("mdYHis")?>')">
					&nbsp;<input type="Button" value="Cancel" onclick="get_method('templates/mpp/index.php')"></td>
				</tr>			
			</table>
		</td></tr>
</table>
</form>
</center>