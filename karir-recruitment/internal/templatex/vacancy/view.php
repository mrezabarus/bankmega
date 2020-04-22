<?
	require_once("../../config.php");
	$vacant=cmsDB();
	$test = cmsDB();
	$strsql = "select tbl_branch_mpp_apply.*,tbl_branch.branch_name,tbl_region.region_name,
				tbl_golongan.name,tbl_position.position_name,tbl_region_mpp.year_date 
				from tbl_branch_mpp_apply 
				inner join tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id
				inner join tbl_region on tbl_branch.region_id=tbl_region.region_id  
				inner join tbl_golongan on tbl_golongan.gol_id=tbl_branch_mpp_apply.gol_id 
				inner join tbl_position on tbl_position.position_id=tbl_branch_mpp_apply.position_id 
				inner join tbl_region_mpp on tbl_region_mpp.hacc_id=tbl_branch_mpp_apply.hacc_id
				where tbl_branch_mpp_apply.mpppos_id=".$_GET["mpppos_id"];
	//echo $strsql;
	$vacant->query($strsql);
	$vacant->next();
?>
<BR>
<center>
<form action="" method="post" name="sample_form" id="sample_form">
<TABLE class=heading2 cellSpacing=0 cellPadding=5 width="50%" align=center border=0>
                     
                     <TR>
                       <TD class=tableheader>
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                           
                           <TR>
                            <TD class=tableheader>&nbsp;View Vacancy</TD>
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
	 <tr>
	 <td>
	 
	<table border="0" width="100%" cellspacing="0" cellpadding="3">
	<?
	if(isset($_GET["selregion"])){
		$selcomp = $_GET["selregion"];
	}else{
		$selcomp = 0;
	}
	$region=cmsDB();
	$region->query("select * from tbl_region");
	?>		
  <tr>
    <td vAlign="top" align="right" width="39%"><b>Region</b></td>
    <td vAlign="top" align="right" width="2%"><b>:</b></td>
    <td vAlign="top" width="59%">
	<?=$vacant->row("region_name")?></td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Cabang/Capem</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top"><?=$vacant->row("branch_name")?></td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>MPP Year</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top">
	<?=$vacant->row("year_date")?>	  </td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Position</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top"><?=$vacant->row("position_name")?></td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Grade</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top"><?=$vacant->row("name")?></td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Month Dateline</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top"><?=date("F",mktime (0,0,0,$vacant->row("month_dateline"),date("d"),  date("Y")))?></td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Requirement Description</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top"><?=$vacant->row("mpp_requirement")?></td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Test_type</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top">
	<?
	$test->query("select * from tbl_grouptest where grouptest_id=".$vacant->row("grouptest_id"));
	if($test->recordCount()){
		$test->next();
		echo $test->row("grouptest_name");
	}else{
		echo "-";
	}?>	</td>
  </tr>

  <tr>
    <td align="right" vAlign="top"><b>Vacant Qty</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top"><?=$vacant->row("qty")?> person(s)</td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Request Status</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top"><?=$vacant->row("position_status")?></td>
  </tr>
<tr>
    <td align="right" vAlign="top"><b>Employee Status</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top"><?=$vacant->row("employee_status")?></td>
  </tr>
	<TR>
                    <TD colspan="3">
                      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                        
                        <TR>
                        <TD style="HEIGHT: 1px">
			   		<IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%">			   </TD>
			   </TR>
                        <TR>
                        	<TD style="HEIGHT: 1px">
					<IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%">				</TD>
				</TR>
				</TABLE>			</TD>
	</TR>
                    
	<tr>
		<td colspan="3" align="right">
		<?if(listFind($_SESSION["ss_id" . date("mdY")],"9")){?>
		<input type="button" value="Edit" onclick="get_method('templates/vacancy/edit.php?mpppos_id=<?=$_GET["mpppos_id"]?>')">
		<?}?>
		&nbsp;<input type="Button" value="Cancel" onclick="get_method('templates/vacancy/index.php')"></td>
	</tr>			
	</table>
		</td></tr>
                   
                    
					
					 
					
                    
                   
</table>
</form>
</center>