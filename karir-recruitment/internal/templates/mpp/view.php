<?
	require_once("../../config.php");
	$comp_name=cmsDB();
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
                            <TD width="91%" class=tableheader>&nbsp;Man Power Planing - View</TD>
                            <TD width="9%" align="right" class=tableheader><!-- input type="button" value="Print MPP" onclick="location='templates/mpp/printmpp_pdf.php?js_id=<? "".$_GET["hacc_id"].""?>'" / --></TD>
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
					<td width="66%"><?=$comp_name->row("year_date")?></td>
				</tr>
				<tr>
					<td width="33%" align="right"><b>Region</b></td>
					<td width="1%" align="right"><b>:</b></td>
					<td><?=$comp_name->row("region_name")?></td>
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
					<td width="33%" align="right"><b>Budget</b></td>
					<td width="1%" align="right"><b>:</b></td>
					<td><?=number_format($comp_name->row("budget"),0, '.', ',')?></td>
				</tr>
				<tr>
					<td width="33%" align="right"><b>Insert by</b></td>
					<td width="1%" align="right"><b>:</b></td>
					<td><?=$comp_name->row("full_name")?></td>
				</tr>
				<tr>
					<td width="33%" align="right"><b>Insert Date</b></td>
					<td width="1%" align="right"><b>:</b></td>
					<td><?=datesql2date($comp_name->row("insert_date"))?> <?=listGetAt($comp_name->row("insert_date"),2," ")?>					</td>
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
                <tr>
					<td colspan="3"align="right">
					<?if(listFind($_SESSION["ss_id" . date("mdY")],"3")){?>
					<input type="button" value="Edit" onclick="get_method('templates/mpp/edit.php?hacc_id=<?=$comp_name->row("hacc_id")?>')">
					<?}?>
					<?if(listFind($_SESSION["ss_id" . date("mdY")],"5")){?>
					<input type="button" value="Delete" onclick="get_method('templates/mpp/delete.php?hacc_id=<?=$comp_name->row("hacc_id")?>')">
					<?}?>
					&nbsp;<input type="Button" value="Cancel" onclick="get_method('templates/mpp/index.php')"></td>
				</tr>			
			</table>
		</td></tr>
</table>
</form>
</center>