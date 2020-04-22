<?
	require_once("../../config.php");
	$ol = cmsDB();
	$ol->query("select * from tbl_offering_letter where ol_id=".uriParam("ol_id"));
	$ol->next();
?>
<BR>
<center>
	 <form action="" method="post" name="sample_form" id="sample_form">
<TABLE class=heading2 cellSpacing="1" cellPadding="2" width="60%" align=center border=0>
                     
                     <TR>
                       <TD class=tableheader>
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                           
                           <TR>
                            <TD class=tableheader>&nbsp;<b>Offering Letter - Preview</b></TD>
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
					<td width="40%" align="right"><strong>Ijin Prinsip </strong></td>
				  <td width="1%" align="right"><strong>:</strong></td>
				  <td width="59%">
				  <?
						$ip=cmsDB();
						$ip->query("select * from tbl_ijin_prinsip where ip_id=".$ol->row("ip_id"));
						$ip->next();
						echo $ip->row("ip_no");
					?></td>
			  </tr>
				<tr>
					<td width="40%" align="right"><strong>OL/KKWT Template</strong></td>
				  <td width="1%" align="right"><strong>:</strong></td>
				  <td>
					<?
						$tempol=cmsDB();
						$tempol->query("select * from tbl_offering_letter_template where templateol_id=".$ol->row("templateol_id"));
						$tempol->next();
						echo $tempol->row("template_name")
					?></td>
				</tr>
				<tr>
					<td width="40%" align="right"><strong>OL/KKWT No.</strong></td>
				  <td width="1%" align="right"><strong>:</strong></td>
				  <td><?=$ol->row("ol_no")?></td>
				</tr>
				<tr>
					<td width="40%" align="right"><strong>Status</strong></td>
				  <td width="1%" align="right"><strong>:</strong></td>
				  <td><b><?
					if($ol->row("is_approved")=='no'){
						echo "<font color=\"brown\"><blink>Pending</blink></font>";
					}elseif($ol->row("is_approved")=='yes'){
						echo "<font color=\"green\">Berhasil</font>";
					}else{
						echo "<font color=\"red\">Batal</font>";
					}
					?></b></td>
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
					<td colspan="3"align="center">
					<?if(listFind($_SESSION["ss_id" . date("mdY")],"34")){?>
						&nbsp;<input type="Button" value="Edit" onclick="get_method('templates/ol/edit.php?ol_id=<?=$ol->row("ol_id")?>')">
					<?}?>
					&nbsp;<input type="Button" value="Preview" onclick="preview_ol2(<?=$ol->row("ol_id")?>)">
					&nbsp;<input type="Button" value="Cancel" onclick="get_method('templates/ol/index.php')"></td>
				</tr>			
			</table>
		</td></tr>
</table>
</form>
</center>