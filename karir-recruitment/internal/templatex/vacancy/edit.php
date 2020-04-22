<?
	require_once("../../config.php");
	$vacant=cmsDB();
	if(isset($_POST["save"])){
			$vacant->query("select year_date from tbl_region_mpp where hacc_id=".postParam("selhcc"));
			$vacant->next();
			$year_date = $vacant->row("year_date");
			$vacant->query("select * from tbl_branch_mpp_apply where mpppos_id=".$_POST["mpppos_id"]);
			$vacant->next();
			$old_qty=$vacant->row("qty");
			$new_qty=postParam("txtqty");
			$vacant->query("update tbl_region_mpp set hacc_val_apply=hacc_val_apply-".$old_qty." where hacc_id=". postParam("selhcc"));
			$vacant->query("update tbl_region_mpp set hacc_val_apply=hacc_val_apply+".$new_qty." where hacc_id=". postParam("selhcc"));
			
			$strsql = "update tbl_branch_mpp_apply set position_id=".postParam("selposition").",
						mpp_requirement='".postParam("txtreq")."',
						qty=".postParam("txtqty").",
						gol_id=".postParam("selgol").",
						month_dateline=".postParam("txtdateline").",
						user_id=".$_SESSION["user_id" . date("mdY")].",
						grouptest_id=".postParam("seltest").",
						formula='".postParam("txttestformula")."',
						position_status='".postParam("selstatus")."',
						apply_date='".date("Y-m-d H:i:s")."', 
						employee_status='".postParam("selemp_status")."' 
						where mpppos_id=".$_POST["mpppos_id"];
			//echo $strsql;
			$vacant->query($strsql);
			$vacant->query("update tbl_position_vacant set pos_desc='".postParam("txtreq")."',pos_sdate='".date("Y-m-d H:i:s")."',pos_edate='".$year_date."-".postParam("txtdateline")."-".date("d H:i:s")."' where mpppos_id=".$_POST["mpppos_id"]);
			
			header("Location: index.php"); 	
			die();
			//echo $strsql;die();
	}
	if(isset($_POST["approved"])){
			$vacant->query("select * from tbl_branch_mpp_apply where mpppos_id=".$_POST["mpppos_id"]);
			$vacant->next();
			$old_qty=$vacant->row("qty");
			$new_qty=postParam("txtqty");
			$vacant->query("update tbl_region_mpp set hacc_val_apply=hacc_val_apply-".$old_qty." where hacc_id=". postParam("selhcc"));
			$vacant->query("update tbl_region_mpp set hacc_val_apply=hacc_val_apply+".$new_qty." where hacc_id=". postParam("selhcc"));
			$vacant->query("update tbl_region_mpp set hacc_val_approve=hacc_val_approve+".$new_qty." where hacc_id=". postParam("selhcc"));
			
			$strsql = "update tbl_branch_mpp_apply set position_id=".postParam("selposition").",
						mpp_requirement='".postParam("txtreq")."',
						qty=".postParam("txtqty").",
						gol_id=".postParam("selgol").",
						month_dateline=".postParam("txtdateline").",
						grouptest_id=".postParam("seltest").",
						formula='".postParam("txttestformula")."',
						position_status='".postParam("selstatus")."',
						request_status='approved',
						approve_date='".date("Y-m-d H:i:s")."',
						approve_by=".$_SESSION["user_id" . date("mdY")].", 
						employee_status='".postParam("selemp_status")."' 
						where mpppos_id=".$_POST["mpppos_id"];
			//echo $strsql;
			$vacant->query($strsql);
			header("Location: index.php"); 	
			die();
			//echo $strsql;die();
	}
	
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
                            <TD class=tableheader>&nbsp;Edit Vacancy</TD>
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
	 <tr>
    <td vAlign="top" align="right" width="36%"><b>Region</b></td>
    <td vAlign="top" align="right" width="2%"><b>:</b></td>
    <td vAlign="top" width="62%">
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
    <td vAlign="top"><?=$vacant->row("year_date")?>
	<input name="selhcc" type="Hidden" value="<?=$vacant->row("hacc_id")?>">	  </td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Position</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top">
	<?
		$position=cmsDB();
		$position->query("select * from tbl_position");
	?>
			<?if($vacant->row("request_status")=="approved"){?>
				<select size="1" name="selposition" disabled>
				<?while($position->next()){?>
					<option value="<?=$position->row("position_id")?>" <?if($position->row("position_id")==$vacant->row("position_id")){ echo" selected";}?>><?=$position->row("position_name")?></option>
				<?}?>
			  </select>
			<?}else{?>
				<select size="1" name="selposition">
				<?while($position->next()){?>
					<option value="<?=$position->row("position_id")?>" <?if($position->row("position_id")==$vacant->row("position_id")){ echo" selected";}?>><?=$position->row("position_name")?></option>
				<?}?>
			  </select>
			<?}?>	</td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Grade</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top"><?
		$golongan=cmsDB();
		$golongan->query("select * from tbl_golongan order by name");
	?>
			<? if($vacant->row("request_status")=="approved"){?>
				<select size="1" name="selgol" disabled>
				<? while($golongan->next()){?>
					<option value="<?=$golongan->row("gol_id")?>" <? if($golongan->row("gol_id")==$vacant->row("gol_id")){ echo" selected";}?>><?=$golongan->row("name")?></option>
				<? } ?>
			  </select>
			<? }else{ ?>
				<select size="1" name="selgol">
				<? while($golongan->next()){ ?>
					<option value="<?=$golongan->row("gol_id")?>" <? if($golongan->row("gol_id")==$vacant->row("gol_id")){ echo" selected";}?>><?=$golongan->row("name")?></option>
				<?}?>
			  </select>
			<?}?>	</td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Month Dateline</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top">
		<? if($vacant->row("request_status")=="approved"){?>
				<select name="txtdateline" disabled>
					<option value="1"<? if($vacant->row("month_dateline")==1){ echo" selected";}?>>January</option>
					<option value="2"<? if($vacant->row("month_dateline")==2){ echo" selected";}?>>February</option>
					<option value="3"<? if($vacant->row("month_dateline")==3){ echo" selected";}?>>March</option>
					<option value="4"<? if($vacant->row("month_dateline")==4){ echo" selected";}?>>April</option>
					<option value="5"<? if($vacant->row("month_dateline")==5){ echo" selected";}?>>May</option>
					<option value="6"<? if($vacant->row("month_dateline")==6){ echo" selected";}?>>June</option>
					<option value="7"<? if($vacant->row("month_dateline")==7){ echo" selected";}?>>July</option>
					<option value="8"<? if($vacant->row("month_dateline")==8){ echo" selected";}?>>August</option>
					<option value="9"<? if($vacant->row("month_dateline")==9){ echo" selected";}?>>September</option>
					<option value="10"<? if($vacant->row("month_dateline")==10){ echo" selected";}?>>October</option>
					<option value="11"<? if($vacant->row("month_dateline")==11){ echo" selected";}?>>November</option>
					<option value="12"<? if($vacant->row("month_dateline")==12){ echo" selected";}?>>December</option>
				</select>
			<?}else{?>
				<select name="txtdateline">
					<option value="1"<? if($vacant->row("month_dateline")==1){ echo" selected";}?>>January</option>
					<option value="2"<? if($vacant->row("month_dateline")==2){ echo" selected";}?>>February</option>
					<option value="3"<? if($vacant->row("month_dateline")==3){ echo" selected";}?>>March</option>
					<option value="4"<? if($vacant->row("month_dateline")==4){ echo" selected";}?>>April</option>
					<option value="5"<? if($vacant->row("month_dateline")==5){ echo" selected";}?>>May</option>
					<option value="6"<? if($vacant->row("month_dateline")==6){ echo" selected";}?>>June</option>
					<option value="7"<? if($vacant->row("month_dateline")==7){ echo" selected";}?>>July</option>
					<option value="8"<? if($vacant->row("month_dateline")==8){ echo" selected";}?>>August</option>
					<option value="9"<? if($vacant->row("month_dateline")==9){ echo" selected";}?>>September</option>
					<option value="10"<? if($vacant->row("month_dateline")==10){ echo" selected";}?>>October</option>
					<option value="11"<? if($vacant->row("month_dateline")==11){ echo" selected";}?>>November</option>
					<option value="12"<? if($vacant->row("month_dateline")==12){ echo" selected";}?>>December</option>
				</select>
			<?}?>  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Requirement Description</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top"><textarea name="txtreq" rows="4" cols="46"><?=$vacant->row("mpp_requirement")?></textarea></td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Test_type</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top">
	<?
		$test->query("select * from tbl_grouptest order by grouptest_name asc");
	?>
	<? if($vacant->row("request_status")=="approved"){?>
		<select size="1" name="seltest" disabled>
			<option value="0"<? if($vacant->row("grouptest_id")==0){ echo" selected";}?>>Select Test Type</option>
        <? while($test->next()){?>
			<option value="<?=$test->row("grouptest_id")?>"<?if($test->row("grouptest_id")==$vacant->row("grouptest_id")){ echo" selected";}?>><?=$test->row("grouptest_name")?></option>
		<? } ?>
      </select>
	<? }else{ ?>
		<select size="1" name="seltest">
			<option value="0"<?if($vacant->row("grouptest_id")==0){ echo" selected";}?>>Select Test Type</option>
        <? while($test->next()){?>
			<option value="<?=$test->row("grouptest_id")?>"<? if($test->row("grouptest_id")==$vacant->row("grouptest_id")){ echo" selected";}?>><?=$test->row("grouptest_name")?></option>
		<? } ?>
      </select>
	<? } ?>	</td>
  </tr>
   <input type="hidden" name="txttestformula" value="">
  <tr>
    <td align="right" vAlign="top"><b>Vacant Qty</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top">
	<? if($vacant->row("request_status")=="approved"){?>
				<input size="8" name="txtqty" value="<?=$vacant->row("qty")?>" readonly="">
			<? }else{ ?>
				<input size="8" name="txtqty" value="<?=$vacant->row("qty")?>">
			<? } ?>
	 person(s)</td>
  </tr>
  <tr>
    <td align="right" vAlign="top"><b>Request Status</b></td>
    <td align="right" vAlign="top"><b>:</b></td>
    <td vAlign="top">
    	<? if($vacant->row("request_status")=="approved"){?>

	<select size="1" name="selstatus" disabled>
        <option value="new hire" <? if(trim($vacant->row("position_status"))=="new hire"){echo " selected";}?>>New Hire</option>
        <option value="rehire"<? if(trim($vacant->row("position_status"))=="rehire"){echo " selected";}?>>ReHire</option>
        <option value="replacement"<? if(trim($vacant->row("position_status"))=="replacement"){echo " selected";}?>>Replacement</option>
      </select>
		<? }else{ ?>
	<select size="1" name="selstatus">
        <option value="new hire" <? if(trim($vacant->row("position_status"))=="new hire"){echo " selected";}?>>New Hire</option>
        <option value="rehire"<? if(trim($vacant->row("position_status"))=="rehire"){echo " selected";}?>>ReHire</option>
        <option value="replacement"<? if(trim($vacant->row("position_status"))=="replacement"){echo " selected";}?>>Replacement</option>
      </select>
      <? } ?></td>
  </tr>
	<tr>
	    <td align="right" vAlign="top"><b>Employee Status</b></td>
	    <td align="right" vAlign="top"><b>:</b></td>
	    <td vAlign="top">
        <? if($vacant->row("request_status")=="approved"){?>
        <select size="1" name="selemp_status" disabled>
	        <option value="permanent" <? if(trim($vacant->row("employee_status"))=="permanent"){echo " selected";}?>>Permanent</option>
	        <option value="contract" <? if(trim($vacant->row("employee_status"))=="contract"){echo " selected";}?>>Contract</option>
	        <option value="contract1" <? if(trim($vacant->row("employee_status"))=="contract1"){echo " selected";}?>>Contract 1</option>
			<option value="outsource" <? if(trim($vacant->row("employee_status"))=="outsource"){echo " selected";}?>>Outsource</option>
			<option value="probation" <? if(trim($vacant->row("employee_status"))=="probation"){echo " selected";}?>>Probation</option>
          </select>
          <? }else{ ?>
          <select size="1" name="selemp_status">
	        <option value="permanent" <? if(trim($vacant->row("employee_status"))=="permanent"){echo " selected";}?>>Permanent</option>
	        <option value="contract" <? if(trim($vacant->row("employee_status"))=="contract"){echo " selected";}?>>Contract</option>
	        <option value="contract1" <? if(trim($vacant->row("employee_status"))=="contract1"){echo " selected";}?>>Contract 1</option>
			<option value="outsource" <? if(trim($vacant->row("employee_status"))=="outsource"){echo " selected";}?>>Outsource</option>
			<option value="probation" <? if(trim($vacant->row("employee_status"))=="probation"){echo " selected";}?>>Probation</option>
	      </select>
          <? } ?></td>
	  </tr>
	  <? if(listFind($_SESSION["ss_id" . date("mdY")],"39")){?>
			<? if($vacant->row("request_status")<>"approved"){?>
    <tr>
		<td colspan="3" align="center" class="heading2"><iframe src="templates/vacancy/file_attached.php?mpppos_id=<?=$_GET["mpppos_id"]?>" scrolling="No" frameborder="0" width="100%" height="32"></iframe></td>
	</tr>                
	<? }else{?>
    <tr>
		<td colspan="3" align="center" class="heading2"><iframe src="templates/vacancy/file_attached.php?mpppos_id=<?=$_GET["mpppos_id"]?>" scrolling="No" frameborder="0" width="100%" height="32"></iframe></td>
	</tr>                
	  <? }
	 } ?>
	<tr>
      <td colspan="3" class="heading2"><hr size="1" width="100%"></TD>
	</tr>
	
	<tr>
		<td colspan="3" align="right">
		<input type="button" value="update" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.selhcc,sample_form.selposition,sample_form.selgol,sample_form.txtdateline,sample_form.txtreq,sample_form.seltest,sample_form.txttestformula,sample_form.txtqty,sample_form.selstatus,sample_form.selemp_status','save=yes&mpppos_id=<?=$_GET["mpppos_id"]?>&refresh=<?=md5("mdYHis")?>')">
		<?if(listFind($_SESSION["ss_id" . date("mdY")],"10")){?>
			<? if($vacant->row("request_status")=="approved"){?>
				&nbsp;<input type="button" value="Delete" disabled>
			<? }else{?>
				&nbsp;<input type="button" value="Delete" onclick="get_method('templates/vacancy/delete.php?hacc_id=<?=$vacant->row("hacc_id")?>&mpppos_id=<?=$_GET["mpppos_id"]?>')">
		<? }
		} ?>
		<? if(listFind($_SESSION["ss_id" . date("mdY")],"39")){?>
			<? if($vacant->row("request_status")=="approved"){?>
				&nbsp;<input disabled type="button" value="Approved" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.selhcc,sample_form.selposition,sample_form.selgol,sample_form.txtdateline,sample_form.txtreq,sample_form.seltest,sample_form.txttestformula,sample_form.txtqty,sample_form.selstatus,sample_form.selemp_status','approved=yes&mpppos_id=<?=$_GET["mpppos_id"]?>&refresh=<?=md5("mdYHis")?>')">
			<? }else{ ?>
				&nbsp;<input type="button" value="Approved" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.selhcc,sample_form.selposition,sample_form.selgol,sample_form.txtdateline,sample_form.txtreq,sample_form.seltest,sample_form.txttestformula,sample_form.txtqty,sample_form.selstatus,sample_form.selemp_status','approved=yes&mpppos_id=<?=$_GET["mpppos_id"]?>&refresh=<?=md5("mdYHis")?>')">
			<? }
		} ?>
		&nbsp;<input type="Button" value="Cancel" onclick="get_method('templates/vacancy/index.php')"></td>
	</tr>			
	</table>
		</td></tr>
</table>
</form>
</center>